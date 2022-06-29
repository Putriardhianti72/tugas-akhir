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
        $this->validate($request, [
            'bank_id' => ['required', 'exists:banks,id'],
        ]);

        $order = Order::create([
            'invoice_no' => Order::generateInvoiceNo(),
            'user_hash' => member_auth()->hash(),
            'expired_at' => Carbon::now()->addMinutes(1),
        ]);

        $orderProducts = [];
        $carts = Cart::where('user_hash', member_auth()->hash())->get();

        foreach ($carts as $cart) {
            $orderProduct = $order->products()->create([
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->product_name,
                'domain' => $cart->domain,
                'category_id' => $cart->product->category_id,
                'desc' => $cart->product->desc,
                'price' => $cart->product->price,
                'pict' => $cart->product->pict,
            ]);
            $product = $cart->product;
            $product->in_stock = 0;
            $product->save();
        }

        $member = member_auth()->user()->toArray();
        $member['user_hash'] = member_auth()->hash();
        $order->member()->create($member);
        $order->payment()->create([
            'destination_bank_id' => $request->bank_id,
        ]);

        Cart::where('user_hash', member_auth()->hash())->delete();

        $order->load('member', 'products');

        //redirect to index
        return redirect()->route('orders.index', $order->id)->with(['success' => 'Order!']);
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
            'bank' => $order->payment->destinationBank,
        ];

        if ($order->status == Order::STATUS_PENDING) {
            return view('User.payment', $data);
        }

        return view('User.order', $data);
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
    public function pay(Request $request, $id)
    {
        $data = $request->validate([
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required',
        ]);
        $order = Order::findOrFail($id);

        $payment = $order->payment;
        $payment->bank_name = $request->bank_name;
        $payment->acc_owner = $request->acc_owner;
        $payment->acc_number = $request->acc_number;

        $totalPrice = 0;

        foreach ($order->products as $product) {
            $totalPrice += $product->price;
        }

        $payment->total_price = $totalPrice;

        if ($request->payment_proof) {
            $this->validate($request, [
                'payment_proof'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            Storage::delete('public/payment-proof/'. $payment->payment_proof);

            //upload image
            $paymentProof = $request->file('payment_proof');
            $paymentProofHashName = $paymentProof->hashName();
            $paymentProof->storeAs('public/payment-proof', $paymentProofHashName);

            $payment->payment_proof = $paymentProofHashName;
        }

        $payment->save();

        $order->status = Order::STATUS_PENDING_REVIEW;
        $order->save();

        return redirect()->route('orders.show', $order->id);
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
        $orderProduct = OrderProduct::where('domain', $request->domain)->count();

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
