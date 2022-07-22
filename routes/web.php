<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RetailOrderController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\MemberAreaHomeController;

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

Route::group([
    'domain' => '{domain}.tugasakhir.loc',
    'where' => ['domain' => 'sailent|templatlain|templatelain2'],
    'as' => 'template.',
], function () {
    include __DIR__ . DIRECTORY_SEPARATOR . 'template.php';
});

//Route::get('/', function () {
////    return view('Layouts.index','$products');
//    return view('Account.login');
//});
// Route::get('/', function () {
//    return view('User.listproduct');
// });
Route::get('/',[\App\Http\Controllers\LandingController::class,'index']);
Route::get('/products',[\App\Http\Controllers\ProductsController::class,'index'])->name('products.index');
Route::get('/products/{id}',[\App\Http\Controllers\ProductsController::class,'show'])->name('products.show');
Route::get('/services',[\App\Http\Controllers\LandingController::class,'services']);
Route::get('/about-us',[\App\Http\Controllers\LandingController::class,'about_us']);

Route::group(['prefix' => 'admin-area', 'as' => 'admin.'], function () {
    Route::get('login',[\App\Http\Controllers\AdminAuthController::class, 'index'])->name('login');
    Route::post('login', [App\Http\Controllers\AdminAuthController::class,'login_submit']);
    Route::get('logout',[\App\Http\Controllers\AdminAuthController::class,'logout'])->name('logout');

    Route::group(['middleware' => 'partner_auth:admin'], function () {
        Route::get('/', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\AdminCategoriesController::class);
        Route::resource('products', \App\Http\Controllers\AdminProductsController::class);
        Route::resource('retail-rewards', \App\Http\Controllers\AdminRetailRewardsController::class);

        Route::resource('retail-orders', \App\Http\Controllers\AdminRetailOrdersController::class);
        Route::get('sales-recap/export', [\App\Http\Controllers\AdminSalesRecapController::class,'export'])->name('sales-recap.export');
        Route::resource('sales-recap', \App\Http\Controllers\AdminSalesRecapController::class);
        Route::patch('/retail-order/{retail_order}/shipping', [\App\Http\Controllers\AdminRetailOrdersController::class, 'updateShipping'])->name('retail-orders.update.shipping');
        Route::patch('/retail-order/{retail_order}/payment-status', [\App\Http\Controllers\AdminRetailOrdersController::class, 'updatePaymentStatus'])->name('retail-orders.update.payment-status');
        Route::patch('/retail-order/{retail_order}/commission', [\App\Http\Controllers\AdminRetailOrdersController::class, 'updateCommission'])->name('retail-orders.update.commission');
        //order
        Route::resource('orders', \App\Http\Controllers\AdminOrdersController::class);
        Route::patch('/order/{order}/payment-status', [\App\Http\Controllers\AdminOrdersController::class, 'updatePaymentStatus'])->name('orders.update.payment-status');
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

    Route::get('member-area/{domain?}', [MemberAreaHomeController::class, 'index'])->name('member-area.index');
    Route::get('member-area/{domain}/order/{id}', [MemberAreaHomeController::class, 'show'])->name('member-area.show');

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

Route::group(['prefix' => 'payment-callback', 'as' => 'payment-callback.'], function () {
    Route::match(['get','post'], '/success', [PaymentCallbackController::class, 'success'])->name('success');
    Route::match(['get','post'], '/pending', [PaymentCallbackController::class, 'pending'])->name('pending');
    Route::match(['get','post'], '/error', [PaymentCallbackController::class, 'error'])->name('error');
    Route::match(['get','post'], '/notification', [PaymentCallbackController::class, 'notification'])->name('notification');
    Route::match(['get','post'], '/paid', [PaymentCallbackController::class, 'paid'])->name('paid');
});


Route::get('/mailable', function () {
    $invoice = App\Models\RetailOrder::find(4);

    return new App\Mail\SendRetailOrderCompleted($invoice);
});

Route::get('/get-data-log', [\App\Http\Controllers\LandingController::class, 'dataLog']);

// Route::group([
//     'prefix' => '{domain}',
//     'where' => ['domain' => 'sailent|templatlain|templatelain2'],
//     'as' => 'template.',
// ], function () {
//     include __DIR__ . DIRECTORY_SEPARATOR . 'template.php';
// });
