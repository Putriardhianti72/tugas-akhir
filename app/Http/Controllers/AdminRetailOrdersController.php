<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RetailOrder;
use App\Mail\SendRetailOrderCreated;
use App\Mail\SendRetailOrderPaid;
use App\Mail\SendRetailOrderDelivered;
use App\Mail\SendRetailOrderCompleted;
use App\Mail\SendRetailOrderCancelled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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
            RetailOrder::STATUS_PAID => 'Paid',
            RetailOrder::STATUS_DELIVERY => 'Out for Delivery',
            RetailOrder::STATUS_COMPLETED => 'Completed',
            RetailOrder::STATUS_CANCELLED => 'Cancelled',
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

        return view('admin.retail-order.detail', compact('order', 'orderStatuses', 'paymentStatuses'));
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
            'status' => ['required'],
        ]);

        $isDirty = $order->status != $request->status;
        $order->status = $request->status;
        $order->save();

        if ($isDirty) {
            if ($order->status == RetailOrder::STATUS_PAID) {
                Mail::to($order->customer->email)->send(new SendRetailOrderPaid($order));
            } else if ($order->status == RetailOrder::STATUS_DELIVERY) {
                Mail::to($order->customer->email)->send(new SendRetailOrderDelivered($order));
            } else if ($order->status == RetailOrder::STATUS_COMPLETED) {
                Mail::to($order->customer->email)->send(new SendRetailOrderCompleted($order));
            } else if ($order->status == RetailOrder::STATUS_CANCELLED) {
                Mail::to($order->customer->email)->send(new SendRetailOrderCancelled($order));
            }
        }

        //redirect to index
        return redirect()->back()->with([
            'alert_success' => 'Data berhasil disimpan!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateShipping(Request $request, $id)
    {
        $order = RetailOrder::findOrFail($id);

        //validate form
        $this->validate($request, [
            'status' => ['sometimes', 'nullable'],
            'tracking_no' => ['sometimes', 'nullable'],
        ]);

        $shipping = $order->shipping;
        $shipping->tracking_no = $request->tracking_no;
        $shipping->status = $request->status;
        $shipping->save();

        if ($shipping->tracking_no && $order->status == RetailOrder::STATUS_PAID) {
            $order->status = RetailOrder::STATUS_DELIVERY;
            $order->save();
        }

        return redirect()->back()->with([
            'alert_success' => 'Data pengiriman berhasil diubah!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $order = RetailOrder::findOrFail($id);

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

        return redirect()->back()->with([
            'alert_success' => 'Data pembayaran berhasil diubah!'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCommission(Request $request, $id)
    {
        $order = RetailOrder::findOrFail($id);

        if ($order->status != RetailOrder::STATUS_COMPLETED) {
            return abort(403);
        }

        //validate form
        $this->validate($request, [
            'commission' => 'required',
        ]);

        $order->commission = $request->commission;
        $order->save();

        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
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
