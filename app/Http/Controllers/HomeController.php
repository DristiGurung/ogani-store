<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::limit(11)->get();

        return view('home', [
            'categories' => $categories
        ]);

    }
}