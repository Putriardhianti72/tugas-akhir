<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RetailHomeController;
use App\Http\Controllers\RetailOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [RetailHomeController::class, 'index'])->name('home');

Route::post('/carts/checkout', [\App\Http\Controllers\RetailCartController::class, 'checkout'])->name('carts.checkout');
Route::resource('carts', \App\Http\Controllers\RetailCartController::class);
Route::resource('checkout', \App\Http\Controllers\RetailCheckoutController::class);

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('/{id}', [RetailOrderController::class,'show'])->name('show');
    Route::post('/', [RetailOrderController::class,'store'])->name('store');
    Route::post('/pay/{id}', [RetailOrderController::class,'pay'])->name('pay');
});

Route::group(['prefix' => 'ajax'], function () {
    Route::get('/shipping/city', [\App\Http\Controllers\ShippingController::class, 'ajaxGetCity']);
    Route::get('/shipping/subdistrict', [\App\Http\Controllers\ShippingController::class, 'ajaxGetSubdistrict']);
    Route::get('/shipping/cost', [\App\Http\Controllers\ShippingController::class, 'ajaxGetCost']);
});
