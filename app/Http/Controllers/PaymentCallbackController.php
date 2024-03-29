<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderMember;
use App\Models\RetailOrder;
use App\Models\Order;
use App\Models\RetailOrderProduct;
use App\Mail\SendRetailOrderCreated;
use App\Mail\SendRetailOrderPaid;
use App\Mail\SendRetailOrderDelivered;
use App\Mail\SendRetailOrderCompleted;
use App\Mail\SendRetailOrderCancelled;
use App\Mail\SendOrderPaid;
use App\Mail\SendOrderCompleted;
use App\Mail\SendOrderCancelled;
use App\Mail\SendOrderProcessing;
use Carbon\Carbon;
use App\Services\Partner\Api;
use App\Services\Midtrans\MidtransService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class PaymentCallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, $redirect = true)
    {
        // "order_id" => "[1134192013, "RINV000000008"]"
        //   "status_code" => "201"
        //   "transaction_status" => "pending"

        // settlement, pending, expire, expired, cancel, deny

        $request->validate([
            'order_id' => ['required'],
            'transaction_status' => ['required'],
        ]);

        $orderInput = json_decode($request->order_id, true);

        if ($orderInput && isset($orderInput[1])) {
            $orderId = $orderInput[1];
        } else {
            $orderId = $request->order_id;
        }
        $code = $request->order_id;

        $midtrans = new MidtransService();
        $response = $midtrans->getStatus($code);

        unset($response['order_id']);
        $response['code'] = $code;
        $response['transaction_status'] = $request->transaction_status;

        if (isset($response['va_numbers'], $response['va_numbers'][0])) {
            $response['bank'] = $response['va_numbers'][0]['bank'];
            $response['va_number'] = $response['va_numbers'][0]['va_number'];
        }

        if (stripos($orderId, 'RINV') !== false) {
            $order = RetailOrder::where('invoice_no', $orderId)->first();

            if ($order) {
                if ($request->transaction_status == 'settlement') {
                    $order->status = RetailOrder::STATUS_PAID;
                    Mail::to($order->customer->email)->send(new SendRetailOrderPaid($order));
                } else if ($request->transaction_status == 'pending') {
                    $order->status = RetailOrder::STATUS_PENDING;
                } else if ($request->transaction_status == 'expire') {
                    $order->status = RetailOrder::STATUS_CANCELLED;
                    Mail::to($order->customer->email)->send(new SendRetailOrderCancelled($order));
                } else if ($request->transaction_status == 'expired') {
                    $order->status = RetailOrder::STATUS_CANCELLED;
                    Mail::to($order->customer->email)->send(new SendRetailOrderCancelled($order));
                } else if ($request->transaction_status == 'cancel') {
                    $order->status = RetailOrder::STATUS_CANCELLED;
                    Mail::to($order->customer->email)->send(new SendRetailOrderCancelled($order));
                } else if ($request->transaction_status == 'deny') {
                    $order->status = RetailOrder::STATUS_CANCELLED;
                    Mail::to($order->customer->email)->send(new SendRetailOrderCancelled($order));
                }

                $order->save();
                $order->payment->update($response);

                if ($redirect) {
                    return redirect()->route('template.orders.show', [
                        'domain' => $order->domain,
                        'id' => encrypt($order->id),
                    ]);
                }

                return $order;
            }
        } else {
            $order = Order::where('invoice_no', $orderId)->first();

            if ($order) {
                if ($request->transaction_status == 'settlement') {
                    $order->status = Order::STATUS_PAID;
                    Mail::to($order->member->email)->send(new SendOrderPaid($order));
                } else if ($request->transaction_status == 'pending') {
                    $order->status = Order::STATUS_PENDING;
                } else if ($request->transaction_status == 'expire') {
                    $order->status = Order::STATUS_CANCELLED;
                    Mail::to($order->member->email)->send(new SendOrderCancelled($order));
                } else if ($request->transaction_status == 'expired') {
                    $order->status = Order::STATUS_CANCELLED;
                    Mail::to($order->member->email)->send(new SendOrderCancelled($order));
                } else if ($request->transaction_status == 'cancel') {
                    $order->status = Order::STATUS_CANCELLED;
                    Mail::to($order->member->email)->send(new SendOrderCancelled($order));
                } else if ($request->transaction_status == 'deny') {
                    $order->status = Order::STATUS_CANCELLED;
                    Mail::to($order->member->email)->send(new SendOrderCancelled($order));
                }

                $order->save();
                $order->payment->update($response);

                if ($redirect) {
                    return redirect()->route('orders.show', [
                        'order' => $order->id,
                    ]);
                }

                return $order;
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        \Log::info('midtrans success', $request->all());
        return $this->handle($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function pending(Request $request)
    {

        \Log::info('midtrans pending', $request->all());
        // dd('pending', $request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function failed(Request $request)
    {

        \Log::info('midtrans failed', $request->all());
        return $this->handle($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function notification(Request $request)
    {
        \Log::info('midtrans notification', $request->all());
        // return $this->handle($request, false);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function paid(Request $request)
    {
        \Log::info('midtrans paid', $request->all());
        return $this->handle($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
