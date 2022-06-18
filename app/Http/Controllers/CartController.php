<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
//        dd(session("cart"));
        $cart = session("cart") ?: [];
//        session_destroy($cart);
//        unset();
//        dd($cart);
        return view('User.cart')->with("cart",$cart);
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
        Databank::create([
            'bank_name' => $request->bank_name,
            'acc_owner' => $request->acc_owner,
            'acc_number' => $request->acc_number
        ]);

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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxAddToCart($id)
    {
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

        return response()->json([
           'status' => 'success',
            'data' => [
                'total' => count($cart),
                'cart' => $cart,
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
        $cart = session('cart') ?: [];

        return response()->json([
            'status' => 'success',
            'data' => [
                'total' => count($cart),
                'cart' => $cart,
            ]
        ]);
    }
}

//namespace App\Http\Controllers;
//
//use App\Models\Product;
//use Illuminate\Http\Request;
//
//class CartController extends Controller
//{
//    public function index()
//    {
//        $products = Product::all();
//    }
//
//    public function AddCart()
//    {
//        return view("Layouts.user.cart");
////        dd($id);
//        $cart= session("cart");
//        $product=Product::detail_product($id);
//        $cart["id"]=[
//          "pict" => $product->pict,
//          "product_name" => $product->product_name,
//          "price" => $product->price,
//        ];
//        session(["cart" => $cart]);
//        return redirect("/cart");
//    }
//
//    public function cart(){
//        $cart= session("cart");
//        return view("Layouts.user.cart")->with("cart", $cart);
//    }
//}
