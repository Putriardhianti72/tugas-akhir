<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(session("cart"));
        $cart = session("cart") ?: [];
//        session_destroy($cart);
//        unset();
//        dd($cart);
        return view('Layouts.user.cart')->with("cart",$cart);
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
            'products' => ['required', 'array'],
            'products.*.id' => ['required'],
            'products.*.domain' => ['required'],
        ]);

        $order = Order::create([]);
        $orderProducts = [];
        $carts = session('cart') ?: [];

        foreach ($carts as $cart) {
            $cart['product_id'] = $cart['id'];

            $product = Product::findOrFail($cart['id']);
            $cart['category_id'] = $product->category_id;
            $cart['desc'] = $product->desc;
            $cart['price'] = $product->price;
            $cart['pict'] = $product->pict;
            $cart['product_name'] = $product->product_name;

            foreach ($request->products as $value) {
                if ($value['id'] == $cart['id']) {
                    $cart['domain'] = $value['domain'];
                    break;
                }
            }

            $orderProduct = $order->products()->create($cart);
        }

        $member = member_auth()->user()->toArray();
        $member['token'] = member_auth()->token();
        $order->member()->create($member);

        session()->forget('cart');
        $order->load('member', 'products');
        dd($order);

        //redirect to index
        return redirect()->route('orders.index')->with(['success' => 'Order!']);
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
