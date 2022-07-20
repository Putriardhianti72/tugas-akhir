<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\RetailOrder;
use App\Models\RetailOrderProduct;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use App\Services\Partner\Auth;


use Illuminate\Support\Facades\Http;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalOrderComplete = Order::where('status', Order::STATUS_COMPLETED)->count();
        $totalOrderPaid = Order::where('status', Order::STATUS_PAID)->count();
        $totalOrderProcessing = Order::where('status', Order::STATUS_PROCESSING)->count();
        $totalRetailOrderComplete = RetailOrder::where('status', RetailOrder::STATUS_COMPLETED)->count();
        $totalRetailOrderPaid = RetailOrder::where('status', RetailOrder::STATUS_PAID)->count();
        $totalRetailOrderDelivery = RetailOrder::where('status', RetailOrder::STATUS_DELIVERY)->count();
        $totalProductSales = RetailOrderProduct::selectRaw("SUM(qty) total_qty, retail_order_products.*")->whereHas('order', function ($q) {
            $q->where('status', RetailOrder::STATUS_COMPLETED);
        })->groupBy('code')->get();

        return view('Admin.dashboard.index', compact('totalOrderComplete','totalOrderProcessing','totalOrderPaid', 'totalRetailOrderComplete','totalRetailOrderDelivery','totalRetailOrderPaid', 'totalProductSales'));
    }
}
