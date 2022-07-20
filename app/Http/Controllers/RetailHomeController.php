<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\OrderMember;
use App\Models\RetailOrder;
use App\Models\RetailOrderProduct;
use App\Models\Order;
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
        $template = $this->getTemplateName($request);

        $response = Rajaongkir::setEndpoint('province')
            ->setBase(env("RAJAONGKIR_TYPE"))
            ->setQuery([])
            ->get();

        $provinces = $response['rajaongkir']['results'] ?? [];

        $product = $this->getApiProduct($request, 'PFLAVO');

        return view('Template.' . $template . '.Pages.home', [
            'domain' => $request->domain,
            'provinces' => $provinces,
            'product' => $product,
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
