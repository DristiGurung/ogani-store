<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    dd("Welcome");
    return view('welcome');
});

Route::get('/login', function(){
  return view('login');
});

Route::post('/login', [LoginController::class,'authenticate']);
Route::get('/home', [HomeController::class,'index']);
Route::get ('/products',[ProductController::class,'index']);   
Route::get ('/product/{slug}',[ProductController::class,'show']);   
Route::get('/about', function () {
    return view('about');
});

Route::get('/categories', [CategoryController::class,'getAction']);

