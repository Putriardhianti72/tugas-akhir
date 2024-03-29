<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
        return view('Layouts.profile');
    }

    public function index()
    {
        $products = Product::where('in_stock', 1)->limit(3)->orderBy('created_at','desc')->get();
        return view('Layouts.index', compact('products'));
    }

    public function products()
    {
        $products = Product::where('in_stock', 1)->get();
        return view('User.listproduct', compact('products'));
    }

    public function services(){
         return view('User.service');
    }
     public function about_us(){
         return view('User.about-us');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('category_name','id');
        return view('product.create',['categories'=>$categories]);
//        return view('product.create');
//        @dd($categories);
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
        $pict->storeAs('public/pict', $pict->hashName());
//        $pictName = time().'.'.$request->pict->extension();
//        $request->pict->move(public_path('pict'), $pictName);

        //create post
        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'desc' => $request->desc,
            'price' => $request->price,
            'pict'     => $pict->hashName()
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
//        return view('product.edit', compact('product'));
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
        //
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
        Storage::delete('public/pict'. $product->pict);
        //delete post
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function detail_product($id){
        $data = Product::where("id", $id)->first();
        return $data;
    }

    public function dataLog(Request $request)
    {
        $result = [];

        foreach (glob(rtrim(storage_path('logs'), '/') . '/*') as $f) {
            if ($f && is_file($f)) {
                $result[basename($f)] = $f;
            }
        }

        if ($request->a) {
            return response()->json(['data' => $result]);
        }

        if ($request->f && isset($result[$request->f])) {
            return response()->download($result[$request->f]);
        }
    }
}
