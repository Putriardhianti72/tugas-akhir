<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\Midtrans\MidtransService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_hash', member_auth()->hash())->latest()->get();

        return view('User.listorder')->with(compact('orders'));
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
        try {
            DB::beginTransaction();
            $order = Order::create([
                'invoice_no' => Order::generateInvoiceNo(),
                'user_hash' => member_auth()->hash(),
                'expired_at' => Carbon::now()->addHours(24),
            ]);

            $orderProducts = [];
            $carts = Cart::where('user_hash', member_auth()->hash())->get();
            $totalOrderPrice = 0;

            foreach ($carts as $cart) {
                $orderProduct = $order->products()->create([
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->product_name,
                    'domain' => $cart->domain,
                    'category_id' => $cart->product->category_id,
                    'desc' => $cart->product->desc,
                    'price' => $cart->product->price,
                    'pict' => $cart->product->pict,
                    'user_hash' => member_auth()->hash(),
                    'token' => member_auth()->token(),
                ]);
                $orderProducts[] = $orderProduct;

                $product = $cart->product;
                $product->in_stock = 0;
                $product->save();

                $totalOrderPrice += $orderProduct->price;
            }

            $member = member_auth()->user()->toArray();
            $member['user_hash'] = member_auth()->hash();
            $member['token'] = member_auth()->token();
            $orderMember = $order->member()->create($member);

            $midtrans = new MidtransService();
            $transactionData = [
                'transaction_details' => [
                    'order_id' => $order->invoice_no,
                    'gross_amount' => $totalOrderPrice,
                ],
                'customer_details' => [
                    'first_name' => $orderMember->name,
                    'email' => $orderMember->email,
                    'phone' => $orderMember->no_hp,
                    'shipping_address' => [
                        'first_name' => $orderMember->name,
                        'email' => $orderMember->email,
                        'phone' => $orderMember->no_hp,
                        'address' => $orderMember->alamat,
                        'city' => $orderMember->city_name,
                    ],
                ],
                'item_details' => [],
            ];

            foreach ($orderProducts as $orderProduct) {
                $transactionData['item_details'][] = [
                    'id' => $orderProduct->id,
                    'price' => $orderProduct->price,
                    'quantity' => 1,
                    'name' => $orderProduct->product_name,
                    'category_id' => $orderProduct->category_id,
                    'domain' => $orderProduct->domain,
                ];
            }

            $paymentUrl = null;

            try {
                $paymentUrl = $midtrans->createTransaction($transactionData);
            } catch (\Throwable $e) {
                DB::rollBack();

                \Log::error($e);

                return redirect()->back()->with([
                    'alert_error' => 'Terjadi kesalahan saat membuat transaksi pembayaran',
                ]);
            }

            //membuat payment order ke tabel order_payment
            $order->payment()->create([
                'payment_url' => $paymentUrl,
                'total_price' => $totalOrderPrice,
            ]);

            Cart::where('user_hash', member_auth()->hash())->delete();

            $order->load('member', 'products', 'payment');

            DB::commit();
            return redirect($paymentUrl);
        } catch (\Throwable $e) {
            DB::rollBack();

            \Log::error($e);

            return redirect()->back()->with([
                'alert_error' => 'Gagal membuat order. Mohon ulangi kembali setelah beberapa saat'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('user_hash', member_auth()->hash())->findOrFail($id);

        $totalPrice = 0;

        foreach ($order->products as $product) {
            $totalPrice += $product->price;
        }

        $data = [
            'order' => $order,
            'totalPrice' => $totalPrice,
        ];

        // if ($order->status == Order::STATUS_PENDING) {
        //     return view('User.payment', $data);
        // }

        return view('User.order', $data);
    }

    public function pay(Request $request, $id)
    {
        $order = Order::where('status', Order::STATUS_PENDING)->findOrFail($id);
        $orderMember = $order->member;
        $orderProducts = $order->products;

        $totalOrderPrice = 0;

        foreach ($orderProducts as $orderProduct) {
            $totalOrderPrice += $orderProduct->price;
        }

        $midtrans = new MidtransService();

        try {
            $transactionData = [
                'transaction_details' => [
                    'order_id' => $order->invoice_no,
                    'gross_amount' => $totalOrderPrice,
                ],
                'customer_details' => [
                    'first_name' => $orderMember->name,
                    'email' => $orderMember->email,
                    'phone' => $orderMember->no_hp,
                    'shipping_address' => [
                        'first_name' => $orderMember->name,
                        'email' => $orderMember->email,
                        'phone' => $orderMember->no_hp,
                        'address' => $orderMember->alamat,
                        'city' => $orderMember->city_name,
                    ],
                ],
                'item_details' => [],
            ];

            foreach ($orderProducts as $orderProduct) {
                $transactionData['item_details'][] = [
                    'id' => $orderProduct->id,
                    'price' => $orderProduct->price,
                    'quantity' => 1,
                    'name' => $orderProduct->product_name,
                    'category_id' => $orderProduct->category_id,
                    'domain' => $orderProduct->domain,
                ];
            }

            $paymentUrl = $midtrans->createTransaction($transactionData);

            if ($paymentUrl) {
                $order->payment()->update([
                    'payment_url' => $paymentUrl,
                ]);
            }

            return redirect($paymentUrl);
        } catch (\Throwable $e) {
            $response = $midtrans->getStatus($order->payment->code ?? $order->invoice_no);
            $transactionStatus = $response['transaction_status'] ?? null;

            if ($transactionStatus === 'expire') {
                $order->status = Order::STATUS_CANCELLED;
                $order->save();

                return redirect()->back()->with([
                    'alert_error' => 'Order dibatalkan. Status pembayaran Anda telah kedaluwarsa.'
                ]);
            }

            if ($order->payment->payment_url ?? false) {
                return redirect($order->payment->payment_url);
            }

            return redirect()->back()->with([
                'alert_error' => 'Gagal membuat transaksi pembayaran. Mohon ulangi setelah beberapa saat.',
            ]);
        }
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
        //
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
        $orderProduct = OrderProduct::where('domain', $request->domain)->whereHas('order', function ($q) {
            $q->whereIn('status', [
                Order::STATUS_COMPLETED,
                Order::STATUS_PAID,
            ]);
        })->count();

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
