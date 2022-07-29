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
            'pict' => 'required|array',
            // 'pict.*'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //create post
        $product = Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'desc' => $request->desc,
            'price' => $request->price,
        ]);


        foreach ($request->pict as $pict) {
            //upload image
            $pictHashName = $pict->hashName();
            $pict->storeAs('public/pict', $pictHashName);
            //$pictName = time().'.'.$request->pict->extension();
            //$request->pict->move(public_path('pict'), $pictName);
            $product->images()->create(['pict' => $pictHashName]);
        }

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
        // dd($request->all());
        $product = Product::findOrFail($id);

        //validate form
        $this->validate($request, [
            'product_name' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
        ]);
        $oldPict = [];

        if ($request->pict) {
            // $this->validate($request, [
            //     'pict'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            // ]);
            $pictIdToKeep = [];

            foreach ($request->pict as $pict) {
                if (is_numeric($pict)) {
                    $img = $product->images()->where('id', $pict)->first();
                    $oldPict[] = [
                        'value' => $pict,
                        'image' => $img->pict_url ?? '',
                        'name' => $img->pict ?? '',
                    ];
                    $pictIdToKeep[] = $pict;
                } else {
                    $oldPict[] = [
                        'value' => null,
                        'image' => 'data:' . $pict->getClientMimeType() . ';base64,' . base64_encode(file_get_contents($pict)),
                        'name' => $pict->getClientOriginalName(),
                    ];
                }
            }

            foreach ($product->images as $image) {
                if (in_array($image->id, $pictIdToKeep)) {
                    Storage::delete('public/pict/'. $image->pict);
                }
            }

            $product->images()->delete();

            foreach ($request->pict as $i => $pict) {
                if (is_numeric($pict)) {
                    $product->images()->create([
                        'pict' => $oldPict[$i]['name'],
                    ]);
                } else {
                    $pictHashName = $pict->hashName();
                    $pict->storeAs('public/pict', $pictHashName);

                    $product->images()->create(['pict' => $pictHashName]);
                }
            }
        }

        $product->fill($request->except(['pict']));
        $product->save();

        //redirect to index
        return redirect()->route('admin.products.index')->with([
            'alert_success' => 'Data produk berhasil disimpan!',
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
