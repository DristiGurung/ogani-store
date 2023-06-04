<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::limit(11)->get();
        $products = Product::all();
        return view('products.list', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        dd($product->categories->toArray());
        return view('products.show', [
            'product' => $product,
        ]);
    }
}