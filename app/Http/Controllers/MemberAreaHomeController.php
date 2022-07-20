<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\OrderMember;
use App\Models\Order;
use App\Models\RetailOrder;
use App\Models\RetailOrderProduct;
use App\Services\Midtrans\MidtransService;
use Carbon\Carbon;
use App\Services\Partner\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRetailOrderCreated;

class MemberAreaHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $domain = null)
    {
        $orderProducts = OrderProduct::whereHas('order', function ($q) {
            $q->where('orders.status', Order::STATUS_COMPLETED);

            $q->whereHas('member', function ($q) {
                $q->where('user_hash', member_auth()->hash());
            });
        })->get();
        $domains = $orderProducts->pluck('domain')->toArray();
        $orders = RetailOrder::whereIn('domain', $domains)->latest()->get();

        if (! $domain) {
            $domain = $orderProducts->first();

            if (!$domain) {
                return redirect('/');
            }

            return redirect()->route('member-area.index', $domain->domain);
        }

        $foundDomain = null;

        foreach ($orderProducts as $product) {
            if ($product->domain == $domain) {
                $foundDomain = $domain;
                break;
            }
        }

        if (! $foundDomain) {
            abort(404);
        }

        $totalOrder = RetailOrder::whereIn('domain', $domains)->where('status', RetailOrder::STATUS_COMPLETED)->count('id');
        $totalCommission = RetailOrder::whereIn('domain', $domains)->where('status', RetailOrder::STATUS_COMPLETED)->sum('commission');

        return view('User.memberarea')->with(compact('orderProducts', 'orders', 'domain', 'totalOrder', 'totalCommission'));
    }


    protected function getApiProduct(Request $request, $code)
    {
        $api = new Api();

        return $api->getProduct($this->getTemplateToken($request), $code) ?: [];
    }

    protected function getTemplateName(Request $request)
    {
        if ($request->template === env('SAILENT_DOMAIN')) {
            return 'sailent';
        }
    }

    protected function getTemplateToken(Request $request)
    {
        $domain = $request->template;

        if ($domain) {
            $product = OrderProduct::where('domain', $domain)->whereHas('order', function ($q) {
                $q->where('orders.status', Order::STATUS_COMPLETED);
            })->first();
            return $product->token;
        }
    }

    protected function getCarts(Request $request)
    {
        $carts = session('retail_cart.' . $request->template);

        if (is_array($carts)) {
            foreach ($carts as $i => $cart) {
                if (! $cart['codeProduct']) {
                    unset($carts[$i]);
                }

                $cart['product'] = $this->getApiProduct($request, $cart['codeProduct']);
                $cart['qty'] = $cart['qty'] ?? 1;
                $carts[$i] = $cart;
            }
            return $carts;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $domain, $id)
    {
        $order = RetailOrder::findOrFail($id);

        $orderStatuses = [
            RetailOrder::STATUS_PENDING => 'Pending',
            RetailOrder::STATUS_PAID => 'Paid',
            RetailOrder::STATUS_DELIVERY => 'Out for Delivery',
            RetailOrder::STATUS_COMPLETED => 'Completed',
            RetailOrder::STATUS_CANCELLED => 'Cancelled',
        ];

        $paymentStatuses = [
            'pending' => 'Pending',
            // 'capture' => 'Capture',
            'settlement' => 'Settlement',
            // 'deny' => 'Deny',
            'cancel' => 'Cancel',
            'expire' => 'Expire',
            'failure' => 'Failure',
            'refund' => 'Refund',
            // 'chargeback' => 'Chargeback',
            // 'partial_refund' => 'Partial Refund',
            // 'partial_chargeback' => 'Partial Chargeback',
            // 'authorize' => 'Authorize',
        ];

        return view('User.retailorder')->with(compact('order', 'orderStatuses', 'paymentStatuses', 'domain'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd($id);
        $cart= session("cart") ?: [];
        $product = Product::findOrFail($id);

        $exists = false;
        foreach ($cart as $value) {
            if ($value['id'] == $product->id) {
                $exists = true;
                break;
            }
        }

        if (! $exists) {
            $cart[] = [
                "id" => $product->id,
                "pict" => $product->pict,
                "product_name" => $product->product_name,
                "price" => $product->price,
            ];
            session(["cart" => $cart]);
        }

        session()->flash('force_redirect', '/carts');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);
        $category = DB::table('databanks')
            ->where('id', $id)
            ->update([
                'bank_name' => $request->bank_name,
                'acc_owner' => $request->acc_owner,
                'acc_number' => $request->acc_number,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return redirect('banks');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart= session("cart") ?: [];

        $product = Product::findOrFail($id);

        foreach ($cart as $i => $value) {
            if ($value['id'] == $product->id) {
                unset($cart[$i]);
            }
        }

        $cart = array_values($cart);
        session(["cart" => $cart]);

        return redirect("/carts");

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxCheckDomain(Request $request)
    {
        $orderProduct = RetailOrderProduct::where('domain', $request->domain)->count();

        if ($orderProduct) {
            return response()->json([
                'status' => 'error',
                'message' => 'Domain tidak tersedia',
            ], 422);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Domain tersedia',
        ]);
    }
}
