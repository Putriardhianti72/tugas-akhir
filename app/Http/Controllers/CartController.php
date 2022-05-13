<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::all();
    }

    public function AddCart($id)
    {
        $cart= session("cart");
        $product=Product::detail_product($id);
        $cart["id"]=[
          "pict" => $product->pict,
          "product_name" => $product->product_name,
          "price" => $product->price,
        ];
        session(["cart"=>$cart]);
        return redirect("/cart");
    }

    public function cart(){
        $cart= session("cart");
        return view("Layouts.user.cart")->with("cart", $cart);
    }
}
