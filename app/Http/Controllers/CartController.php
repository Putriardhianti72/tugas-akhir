<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_hash', member_auth()->hash())->get();
        $totalCartPrice = 0;

        foreach ($carts as $cart) {
            $totalCartPrice += $cart->product->price;
        }

        return view('User.cart')->with("carts", $carts)->with('totalCartPrice', $totalCartPrice)->with('totalCart', count($carts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        dd($id);
//        return view("Layouts.user.cart");
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
            'bank_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);

        dd('hancur');

        //redirect to index
        return redirect()->route('banks.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $carts = Cart::where('user_hash', member_auth()->hash())->get();
        $totalCartPrice = 0;

        if (! count($carts)) {
            return redirect()->route('carts.index');
        }

        foreach ($carts as $cart) {
            if (! isset($cart['domain'])) {
                return redirect()->route('carts.index');
            }
            $totalCartPrice += $cart->product->price;
        }

        $totalCart = count($carts);

        $banks = Bank::all();

        return view('User.checkout', ['cart' => $carts, 'banks' => $banks, 'totalCartPrice' => $totalCartPrice, 'totalCart' => $totalCart]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('in_stock', 1)->findOrFail($id);
        $cart = Cart::where('user_hash', member_auth()->hash())->where('product_id', $product->id)->first();

        if (! $cart) {
            $cart = Cart::create([
                'product_id' => $product->id,
                'token' => member_auth()->hash(),
            ]);
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'carts' => ['required', 'array'],
            'carts.*.id' => ['required'],
            'carts.*.domain' => ['required'],
        ]);

        $orderProducts = [];
        $carts = Cart::where('user_hash', member_auth()->hash())->get();

        foreach ($request->carts as $value) {
            foreach ($carts as $cart) {
                if ($value['id'] == $cart->id) {
                    $cart->domain = $value['domain'];
                    $cart->save();
                    break;
                }
            }
        }

        //redirect to index
        return redirect()->route('carts.checkout');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where('user_hash', member_auth()->hash())->findOrFail($id);
        $cart->delete();
        return redirect("/carts");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxAddToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = Cart::where('user_hash', member_auth()->hash())->where('product_id', $product->id)->first();

        if (! $cart) {
            $cart = Cart::create([
                'product_id' => $product->id,
                'user_hash' => member_auth()->hash(),
            ]);
        }

        $carts = Cart::where('user_hash', member_auth()->hash())->get();

        return response()->json([
           'status' => 'success',
            'data' => [
                'total' => count($carts),
                'cart' => $carts,
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxIndex()
    {
        $carts = Cart::where('user_hash', member_auth()->hash())->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'total' => count($carts),
                'cart' => $carts,
            ]
        ]);
    }
}
