<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filterCategorySlug = $request->get('category');
        $categories = Category::take(11)->get();
        $category = Category::where('slug', $filterCategorySlug)->first();

        if ($category) {
            $products = $category->products()->orderBy('created_at','desc')->get();
        } else {
            $products = Product::orderBy('created_at','desc')->get();
        }


        return view('products.list', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        // dd($product->categories->toArray());
        return view('products.show', [
            'product' => $product,
        ]);
    }
}