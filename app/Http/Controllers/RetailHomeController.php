<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderMember;
use App\Models\RetailOrder;
use App\Models\RetailOrderProduct;
use App\Services\Partner\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rajaongkir;

class RetailHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $template = $request->template;

        $response = Rajaongkir::setEndpoint('province')
            ->setBase(env("RAJAONGKIR_TYPE"))
            ->setQuery([])
            ->get();

        $provinces = $response['rajaongkir']['results'] ?? [];

        $product = $this->getApiProduct($request, 'PFLAVO');

        return view('Template.' . $template . '.Pages.home', [
            'template' => $template,
            'provinces' => $provinces,
            'product' => $product,
        ]);
    }

    protected function getApiProduct(Request $request, $code)
    {
        $api = new Api();

        return $api->getProduct($this->getTemplateToken($request), $code) ?: [];
    }

    protected function getTemplateToken(Request $request)
    {
        $hash = null;

        if ($request->template === 'sailent') {
            $hash = env('SAILENT_USER_HASH');
        }

        if ($hash) {
            $member = OrderMember::where('user_hash', $hash)->first();
            return $member->token;
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
            'destination_bank_id' => ['sometimes', 'nullable', 'exists:banks,id'],
            'user_hash' => ['required', 'exists:orders,user_hash'],
            'retail_product_id' => ['required', 'exists:retail_products,id'],
            'qty' => ['required', 'min:1'],
            'customer' => ['required', 'array'],
            'customer.name' => ['required'],
            'customer.email' => ['required', 'email'],
            'customer.no_hp' => ['required'],
            'customer.alamat' => ['required'],
        ]);

        $product = RetailProduct::findOrFail($request->retail_product_id);

        $order = RetailOrder::create([
            'invoice_no' => RetailOrder::generateInvoiceNo(),
            'user_hash' => $request->user_hash,
            'qty' => $request->qty,
        ]);

        $orderProduct = $order->product()->create([
            'product_name' => $product->product_name,
            'price' => $product->price,
            'desc' => $product->desc,
            'qty' => $request->qty,
        ]);

        $order->customer()->create($request->customer);

        $order->payment()->create([
            'destination_bank_id' => $request->destination_bank_id,
            'total_price' => $orderProduct->total_price,
        ]);

        $order->load('customer', 'product', 'payment', 'owner');

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'data' => $order,
            ]);
        }

        //redirect to index
        return redirect()->route('orders.show', $order->id)->with(['success' => 'RetailOrder!']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = RetailOrder::where('user_hash', member_auth()->hash())->findOrFail($id);

        $totalPrice = 0;

        foreach ($order->products as $product) {
            $totalPrice += $product->price;
        }

        $data = [
            'order' => $order,
            'totalPrice' => $totalPrice,
            'bank' => $order->payment->destinationBank,
        ];

        if ($order->status == RetailOrder::STATUS_PENDING) {
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
        $order = RetailOrder::findOrFail($id);

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

        $order->status = RetailOrder::STATUS_PENDING_REVIEW;
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
