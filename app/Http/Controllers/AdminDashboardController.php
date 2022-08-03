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
        $orderProducts = RetailOrderProduct::selectRaw('retail_order_products.*, sum(retail_order_products.qty) total_qty')
                                    ->join('retail_orders', 'retail_orders.id', '=', 'retail_order_products.retail_order_id')
                                    ->whereIn('retail_orders.status',[RetailOrder::STATUS_PAID, RetailOrder::STATUS_DELIVERY, RetailOrder::STATUS_COMPLETED])
                                    ->whereNull('retail_orders.deleted_at')
                                    ->groupBy('retail_order_products.code')
                                    ->get();

        $productSales = [];
        foreach (get_all_retail_products() as $product) {
            $data = $orderProducts->first(function ($item) use ($product) {
                return $item->code == $product['code'];
            });

            $product['total_qty'] = $data ? $data->total_qty : 0;
            $productSales[] = $product;
        }


        return view('Admin.dashboard.index', compact('totalOrderComplete','totalOrderProcessing','totalOrderPaid', 'totalRetailOrderComplete','totalRetailOrderDelivery','totalRetailOrderPaid', 'productSales'));
    }
}
