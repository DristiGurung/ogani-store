<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAction(){
        $categories = Category::limit(11)->get();
        return view('home' , [
            'categories' => $categories
        ]);
    }
}
