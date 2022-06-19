<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RetailProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRetailProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = RetailProduct::all();
        return view('Admin.retail-product.index', compact('products'));
    }

    public function categori(){

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new RetailProduct();
        return view('Admin.retail-product.form', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'product_name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'pict'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //upload image
        $pict = $request->file('pict');
        $pictHashName = $pict->hashName();
        $pict->storeAs('public/retail-pict', $pictHashName);
//        $pictName = time().'.'.$request->pict->extension();
//        $request->pict->move(public_path('pict'), $pictName);

        //create post
        RetailProduct::create([
            'product_name' => $request->product_name,
            'desc' => $request->desc,
            'price' => $request->price,
            'stock' => $request->stock,
            'pict'     => $pictHashName,
        ]);

        //redirect to index
        return redirect()->route('admin.retail-products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = RetailProduct::findOrFail($id);
        return view('Admin.retail-product.form', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = RetailProduct::findOrFail($id);

        //validate form
        $this->validate($request, [
            'product_name' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($request->pict) {
            $this->validate($request, [
                'pict'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            Storage::delete('public/retail-pict/'. $product->pict);

            //upload image
            $pict = $request->file('pict');
            $pictHashName = $pict->hashName();
            $pict->storeAs('public/retail-pict', $pictHashName);

            $product->pict = $pictHashName;
        }

        $product->fill($request->except(['pict']));
        $product->save();

        //redirect to index
        return redirect()->route('admin.retail-products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetailProduct $product)
    {
        //delete image
//        Storage::delete('public/pict/'. $product->pict);
        Storage::delete('public/retail-pict/'. $product->pict);
        //delete post
        $product->delete();

        //redirect to index
        return redirect()->route('admin.retail-products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function detail_product($id){
        $data = RetailProduct::where("id", $id)->first();
        return $data;
    }
}
