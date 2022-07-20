<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\RetailOrder;
use App\Models\RetailOrderProduct;
use App\Models\RetailReward;
use App\Services\Midtrans\MidtransService;
use Carbon\Carbon;
use App\Services\Partner\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRetailOrderCreated;

class RetailOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $template = $this->getTemplateName($request);
        $order = RetailOrder::where('user_hash', member_auth()->hash())->latest()->get();

        return view('Template.' . $template . '.Pages.home', [
            'domain' => $request->domain,
            'order' => $order,
        ]);
    }


    protected function getApiProduct(Request $request, $code)
    {
        $api = new Api();

        return $api->getProduct($this->getTemplateToken($request), $code) ?: [];
    }

    protected function getTemplateName(Request $request)
    {
        if ($request->domain === env('SAILENT_DOMAIN')) {
            return 'sailent';
        }
    }

    protected function getTemplateToken(Request $request)
    {
        $domain = $request->domain;

        if ($domain) {
            $product = OrderProduct::where('domain', $domain)->whereHas('order', function ($q) {
                $q->where('orders.status', Order::STATUS_COMPLETED);
            })->first();
            return $product->token;
        }
    }

    protected function getCarts(Request $request)
    {
        $carts = session('retail_cart.' . $request->domain);

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
        $this->validate($request, [
            'domain' => ['required', 'exists:order_products,domain'],
            'customer' => ['required', 'array'],
            'customer.name' => ['required'],
            'customer.email' => ['required', 'email'],
            'customer.no_hp' => ['required'],
            'customer.alamat' => ['required'],
            'customer.province_id' => ['required'],
            'customer.province_name' => ['required'],
            'customer.city_id' => ['required'],
            'customer.city_name' => ['required'],
            'customer.subdistrict_id' => ['required'],
            'customer.subdistrict_name' => ['required'],
            'shipping.name' => ['required'],
            'shipping.code' => ['required'],
            'shipping.price' => ['required'],
            'shipping.weight' => ['required'],
            'shipping.etd' => ['sometimes', 'nullable'],
        ]);

        $order = RetailOrder::create([
            'invoice_no' => RetailOrder::generateInvoiceNo(),
            'domain' => $request->domain,
        ]);

        $carts = $this->getCarts($request);
        $totalOrderPrice = 0;
        $orderProduct = null;

        foreach ($carts as $cart) {
            $orderProduct = $order->product()->create([
                'code' => $cart['product']['codeProduct'],
                'product_name' => $cart['product']['nama'],
                'desc' => $cart['product']['deskripsi'],
                'price' => $cart['product']['harga'],
                'qty' => $cart['qty'],
                'weight' => $cart['product']['berat'],
            ]);

            $totalOrderPrice += $orderProduct->total_price;
        }

        $orderCustomer = $order->customer()->create($request->customer);

        $orderShipping = $order->shipping()->create($request->shipping);

        session()->forget('retail_cart.' . $request->domain);

        $midtrans = new MidtransService();
        $paymentUrl = null;

        try {
            $paymentUrl = $midtrans->createTransaction([
                'transaction_details' => [
                    'order_id' => $order->invoice_no,
                    'gross_amount' => $totalOrderPrice,
                ],
                'customer_details' => [
                    'first_name' => $orderCustomer->name,
                    'email' => $orderCustomer->email,
                    'phone' => $orderCustomer->no_hp,
                    'shipping_address' => [
                        'first_name' => $orderCustomer->name,
                        'email' => $orderCustomer->email,
                        'phone' => $orderCustomer->no_hp,
                        'address' => $orderCustomer->alamat,
                        'city' => $orderCustomer->city_name,
                    ],
                ],
                'item_details' => [
                    [
                        'id' => $orderProduct->code,
                        'price' => $orderProduct->price,
                        'quantity' => $orderProduct->qty,
                        'name' => $orderProduct->product_name,
                    ]
                ],
            ]);
        } catch (\Throwable $e) {
            \Log::error($e);
            return redirect()->back();
        }

        $order->payment()->create([
            'payment_url' => $paymentUrl,
            'total_price' => $totalOrderPrice,
        ]);

        $order->commission = RetailReward::where('code', $orderProduct->code)->first()->reward ?? 0;
        $order->save();

        $order->load('customer', 'shipping', 'product', 'owner');

        Mail::to($order->customer->email)->send(new SendRetailOrderCreated($order));

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'data' => [
                    'order' => $order,
                    'payment_url' => $paymentUrl,
                ],
            ]);
        }

        return redirect($paymentUrl);

        // return redirect()->route('template.orders.show', [
        //     'domain' => $request->domain,
        //     'id' => $order->id,
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $template = $this->getTemplateName($request);

        $order = RetailOrder::findOrFail($request->id);

        return view('Template.' . $template . '.Pages.order', [
            'domain' => $request->domain,
            'order' => $order,
        ]);
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
