<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RetailOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRetailOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = RetailOrder::all();
        return view('Admin.retail-order.index', compact('orders'));
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
        $order = new RetailOrder();
        return view('Admin.retail-order.form', compact('order'));
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
            'order_name' => 'required',
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
        RetailOrder::create([
            'order_name' => $request->order_name,
            'desc' => $request->desc,
            'price' => $request->price,
            'stock' => $request->stock,
            'pict'     => $pictHashName,
        ]);

        //redirect to index
        return redirect()->route('admin.retail-orders.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = RetailOrder::findOrFail($id);

        $orderStatuses = [
            RetailOrder::STATUS_PENDING => 'Pending',
            RetailOrder::STATUS_COMPLETED => 'Completed',
            RetailOrder::STATUS_PAID => 'Paid',
            RetailOrder::STATUS_PENDING_REVIEW => 'Pending Review',
            RetailOrder::STATUS_CANCELLED => 'Cancelled',
        ];

        return view('admin.retail-order.detail', compact('order', 'orderStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = RetailOrder::findOrFail($id);
        return view('Admin.retail-order.form', compact('order'));
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
        $order = RetailOrder::findOrFail($id);

        //validate form
        $this->validate($request, [
            'order_name' => 'required',
            'category_id' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($request->pict) {
            $this->validate($request, [
                'pict'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            Storage::delete('public/retail-pict/'. $order->pict);

            //upload image
            $pict = $request->file('pict');
            $pictHashName = $pict->hashName();
            $pict->storeAs('public/retail-pict', $pictHashName);

            $order->pict = $pictHashName;
        }

        $order->fill($request->except(['pict']));
        $order->save();

        //redirect to index
        return redirect()->route('admin.retail-orders.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetailOrder $order)
    {
        //delete image
//        Storage::delete('public/pict/'. $order->pict);
        Storage::delete('public/retail-pict/'. $order->pict);
        //delete post
        $order->delete();

        //redirect to index
        return redirect()->route('admin.retail-orders.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function detail_order($id){
        $data = RetailOrder::where("id", $id)->first();
        return $data;
    }
}
