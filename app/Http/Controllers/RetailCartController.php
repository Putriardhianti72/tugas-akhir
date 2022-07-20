<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderMember;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Order;
use App\Services\Partner\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class RetailCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $template = $this->getTemplateName($request);
        $carts = $this->getCarts($request);

        if (! $carts) {
            return redirect()->route('template.home', $template);
        }

        $totalCartPrice = 0;

        foreach ($carts as $cart) {
            $harga = $cart['product']['harga'] * $cart['qty'];
            $totalCartPrice += $harga;
        }

        return view('Template.' . $template . '.Pages.cart', [
            'domain' => $request->domain,
            'carts' => $carts,
            'totalCartPrice' => $totalCartPrice,
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
        $carts = session('retail_cart.' . $request->domain) ?: [];

        $exists = false;

        foreach ($carts as $cart) {
            if ($cart['codeProduct'] == $request->codeProduct) {
                $exists = true;
                break;
            }
        }

        if (! $exists) {
            $carts[] = [
                'codeProduct' => $request->codeProduct,
                'qty' => $request->qty ?: 1,
                'user_hash' => $request->user_hash,
            ];

            session(['retail_cart.' . $request->domain => $carts]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'data' => $carts,
            ]);
        }

        return redirect()->route('template.carts.index', $request->domain);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $carts = $this->getCarts($request);

        foreach ($carts as $i => $cart) {
            foreach ($request->carts as $codeProduct => $input) {
                if ($codeProduct == $cart['codeProduct']) {
                    $carts[$i]['qty'] = $input['qty'] ?? 1;
                }
            }
        }

        session(['retail_cart.' . $request->domain => $carts]);

        return redirect()->route('template.checkout.index', $request->domain);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $carts = session('retail_cart.' . $request->domain);

        if (is_array($carts)) {
            foreach ($carts as $i => $cart) {
                if ($cart['codeProduct'] == $request->codeProduct) {
                    unset($carts[$i]);
                }
            }

            session(['retail_cart.' . $request->domain => $carts]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'data' => $carts,
            ]);
        }

        return redirect()->route('template.carts.index', $request->domain);
    }
}
