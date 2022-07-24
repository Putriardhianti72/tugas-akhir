<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('Admin.product.index', compact('products'));
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
        $categories = Category::pluck('category_name','id');
        $product = new Product();
        return view('Admin.product.form', compact('product', 'categories'));
    }

    public function list(){
        $products = Product::all();
        return view('Layouts.index', compact('products'));

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
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'pict'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //upload image
        $pict = $request->file('pict');
        $pictHashName = $pict->hashName();
        $pict->storeAs('public/pict', $pictHashName);
//        $pictName = time().'.'.$request->pict->extension();
//        $request->pict->move(public_path('pict'), $pictName);

        //create post
        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'desc' => $request->desc,
            'price' => $request->price,
            'pict'     => $pictHashName,
        ]);

        //redirect to index
        return redirect()->route('admin.products.index')->with([
            'alert_success' => 'Data produk berhasil disimpan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Admin.product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('category_name','id');
        $product = Product::findOrFail($id);
        return view('Admin.product.form', compact('product', 'categories'));
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
        $product = Product::findOrFail($id);

        //validate form
        $this->validate($request, [
            'product_name' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
        ]);

        if ($request->pict) {
            $this->validate($request, [
                'pict'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            Storage::delete('public/pict/'. $product->pict);

            //upload image
            $pict = $request->file('pict');
            $pictHashName = $pict->hashName();
            $pict->storeAs('public/pict', $pictHashName);

            $product->pict = $pictHashName;
        }

        $product->fill($request->except(['pict']));
        $product->save();

        //redirect to index
        return redirect()->route('admin.products.index')->with([
            'alert_success' => 'Data produk berhasil disimpan!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete image
//        Storage::delete('public/pict/'. $product->pict);
        Storage::delete('public/pict/'. $product->pict);
        //delete post
        $product->delete();

        //redirect to index
        return redirect()->route('admin.products.index')->with([
            'alert_success' => 'Data produk berhasil dihapus!'
        ]);
    }

    public function detail_product($id){
        $data = Product::where("id", $id)->first();
        return $data;
    }
}
