<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('Layouts.index','$products');
//});


Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
Route::resource('products', \App\Http\Controllers\ProductsController::class);
Route::get('/', [\App\Http\Controllers\ProductsController::class, 'index']);

//cart
Route::post('/cart/add/{{id}}', [CartController::class,'AddCart']);
Route::get('/cart', [\App\Http\Controllers\CartController::class,'Cart']);
Route::resource('banks', \App\Http\Controllers\DatabanksController::class);
Route::resource('carts', \App\Http\Controllers\CartController::class);
//Route::get('categories', [CategoriesController::class,'index']);
