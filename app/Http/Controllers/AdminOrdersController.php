<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\SendOrderCreated;
use App\Mail\SendOrderPaid;
use App\Mail\SendOrderProcessing;
use App\Mail\SendOrderCompleted;
use App\Mail\SendOrderCancelled;
use Illuminate\Support\Facades\Mail;

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
        //
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
            Order::STATUS_PAID => 'Paid',
            Order::STATUS_PROCESSING => 'Processing',
            Order::STATUS_COMPLETED => 'Completed',
            Order::STATUS_CANCELLED => 'Cancelled',
        ];

        $paymentStatuses = [
            'pending' => 'Pending',
            // 'capture' => 'Capture',
            'settlement' => 'Settlement',
            // 'deny' => 'Deny',
            'cancel' => 'Cancel',
            'expire' => 'Expire',
            'failure' => 'Failure',
            'refund' => 'Refund',
            // 'chargeback' => 'Chargeback',
            // 'partial_refund' => 'Partial Refund',
            // 'partial_chargeback' => 'Partial Chargeback',
            // 'authorize' => 'Authorize',
        ];


        return view('admin.order.detail', compact('order', 'orderStatuses','paymentStatuses'));
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
        $isDirty = $order->status != $request->status;
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

        if ($isDirty) {
            if ($order->status == Order::STATUS_PAID) {
                Mail::to($order->member->email)->send(new SendOrderPaid($order));
            } else if ($order->status == Order::STATUS_PROCESSING) {
                Mail::to($order->member->email)->send(new SendOrderProcessing($order));
            } else if ($order->status == Order::STATUS_COMPLETED) {
                Mail::to($order->member->email)->send(new SendOrderCompleted($order));
            } else if ($order->status == Order::STATUS_CANCELLED) {
                Mail::to($order->member->email)->send(new SendOrderCancelled($order));
            }
        }
        $order->save();

        return redirect()->back();


    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        //validate form
        $this->validate($request, [
            'transaction_status' => 'required',
        ]);

        $payment = $order->payment;
        $payment->transaction_status = $request->transaction_status;
        $payment->save();

        // if ($payment->status === 'pending') {
        //     $order->status = RetailOrder::STATUS_PENDING;
        //     $order->save();
        // } else if ($payment->status === 'settlement') {
        //     $order->status = RetailOrder::STATUS_PAID;
        //     $order->save();
        // } else if ($payment->status === 'cancel') {
        //     $order->status = RetailOrder::STATUS_PENDING;
        //     $order->save();
        // } else if ($payment->status === 'expire') {
        //     $order->status = RetailOrder::STATUS_PENDING;
        //     $order->save();
        // } else if ($payment->status === 'failure') {
        //     $order->status = RetailOrder::STATUS_PENDING;
        //     $order->save();
        // } else if ($payment->status === 'refund') {
        //     $order->status = RetailOrder::STATUS_CANCELLED;
        //     $order->save();
        // }

        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
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
