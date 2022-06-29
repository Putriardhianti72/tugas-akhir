<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('Admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'order_name' => 'required',
            'acc_owner' => 'required',
            'acc_number' => 'required'
        ]);
        Order::create([
            'order_name' => $request->order_name,
            'acc_owner' => $request->acc_owner,
            'acc_number' => $request->acc_number
        ]);

        //redirect to index
        return redirect()->route('admin.orders.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        $orderStatuses = [
            Order::STATUS_PENDING => 'Pending',
            Order::STATUS_COMPLETED => 'Completed',
            Order::STATUS_PAID => 'Paid',
            Order::STATUS_PENDING_REVIEW => 'Pending Review',
            Order::STATUS_CANCELLED => 'Cancelled',
        ];

        return view('admin.order.detail', compact('order', 'orderStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $order = DB::table('orders')
//            ->select ('*')
//            ->where ('id', $id)
//            ->first();
        $order = Order::findOrFail($id);
        return view('admin.order.edit',compact('order'));
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
        $order = Order::findOrFail($id);
        $data = $request->validate([
            'status' => 'required',
        ]);

        $order->fill($request->all());

        if ($request->status == Order::STATUS_COMPLETED) {
            foreach ($order->products as $orderProduct) {
                    $product = $orderProduct->product;
                    $product->in_stock = 0;
                    $product->save();
            }
        } else if ($request->status == Order::STATUS_CANCELLED) {
                            foreach ($order->products as $orderProduct) {
                    $product = $orderProduct->product;
                    $product->in_stock = 1;
                    $product->save();
                }
        }

        $order->save();

        return redirect()->route('admin.orders.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Order::find($id);
        $data->delete();
        return redirect()->route('admin.orders.index');
    }
}
