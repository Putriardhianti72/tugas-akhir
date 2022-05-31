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

Route::get('/', function () {
//    return view('Layouts.index','$products');
    return view('Account.login');
});


Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
Route::resource('products', \App\Http\Controllers\ProductsController::class);
//Route::get('/', [\App\Http\Controllers\ProductsController::class, 'index']);

//cart
Route::post('/cart/add/{{id}}', [CartController::class,'AddCart']);
Route::get('/cart/hapus/{id}', [\App\Http\Controllers\CartController::class,'destroy']);
Route::resource('banks', \App\Http\Controllers\DatabanksController::class);
Route::resource('carts', \App\Http\Controllers\CartController::class);
Route::get('login',[\App\Http\Controllers\CustomAuthController::class,'index']);
//Route::get('categories', [CategoriesController::class,'index']);
