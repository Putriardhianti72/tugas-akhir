<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RetailOrderController;

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
////    return view('Layouts.index','$products');
//    return view('Account.login');
//});
// Route::get('/', function () {
//    return view('User.listproduct');
// });
Route::get('/',[\App\Http\Controllers\LandingController::class,'index']);
Route::get('/products',[\App\Http\Controllers\ProductsController::class,'index']);

Route::group(['prefix' => 'admin-area', 'as' => 'admin.'], function () {
    Route::get('login',[\App\Http\Controllers\AdminAuthController::class, 'index'])->name('login');
    Route::post('login', [App\Http\Controllers\AdminAuthController::class,'login_submit']);
    Route::get('logout',[\App\Http\Controllers\AdminAuthController::class,'logout'])->name('logout');

    Route::group(['middleware' => 'partner_auth:admin'], function () {
        Route::get('/', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\AdminCategoriesController::class);
        Route::resource('products', \App\Http\Controllers\AdminProductsController::class);
        Route::resource('retail-products', \App\Http\Controllers\AdminRetailProductsController::class);
        Route::resource('retail-orders', \App\Http\Controllers\AdminRetailOrdersController::class);
        Route::resource('banks', \App\Http\Controllers\AdminBanksController::class);
        Route::resource('orders', \App\Http\Controllers\AdminOrdersController::class);
    });
});

//Route::resource('categories', \App\Http\Controllers\AdminCategoriesController::class);
//Route::resource('products', \App\Http\Controllers\ProductsController::class);
//Route::get('/', [\App\Http\Controllers\ProductsController::class, 'index']);




//Route::post('login',[\App\Http\Controllers\CustomAuthController::class,'login_submit'])->name('login.submit');
Route::get('login',[\App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('login', [App\Http\Controllers\CustomAuthController::class,'login_submit'])->name('login.submit');
Route::get('logout',[\App\Http\Controllers\CustomAuthController::class,'logout'])->name('logout');
//Route::get('categories', [AdminCategoriesController::class,'index']);

Route::group(['middleware' => 'partner_auth:member'], function () {
    //cart
    Route::get('/profile', function () {return view('User.auth.profile'); });
    Route::post('/cart/add/{id}', [CartController::class,'AddCart']);
    Route::get('/cart/hapus/{id}', [\App\Http\Controllers\CartController::class,'destroy']);
    Route::resource('carts', \App\Http\Controllers\CartController::class)->except([
        'update'
    ]);
    Route::patch('/carts', [CartController::class,'update'])->name('carts.update');
    Route::get('/checkout', [CartController::class,'checkout'])->name('carts.checkout');
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::post('/orders/pay/{id}', [OrderController::class,'pay'])->name('orders.pay');

    Route::group(['prefix' => 'ajax'], function () {
        Route::get('/cart', [\App\Http\Controllers\CartController::class, 'ajaxIndex']);
        Route::post('/cart/add/{id}', [\App\Http\Controllers\CartController::class, 'ajaxAddToCart']);
        Route::post('/order/check-domain', [\App\Http\Controllers\OrderController::class, 'ajaxCheckDomain']);
    });
});

Route::group(['prefix' => 'retail', 'as' => 'retail.'], function () {
    Route::post('/orders', [RetailOrderController::class,'store'])->name('orders.store');
    Route::post('/orders/pay/{id}', [RetailOrderController::class,'pay'])->name('orders.pay');
});


Route::group([
    'prefix' => '{template}',
    'where' => ['template' => 'sailent|testtemplate'],
    'as' => 'template.',
], function () {
    include __DIR__ . DIRECTORY_SEPARATOR . 'template.php';
});
