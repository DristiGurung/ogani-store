<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        $shoppingCart = Cart::name('shopping');
        $shoppingCart->addItem([
            'id' => $product->id,
            'title' => $product->name,
            'quantity' => (int) $request->quantity,
            'price' => $product->price / 100
        ]);
        return back();

    }
    public function show(){
        return view('cart');
    }
}