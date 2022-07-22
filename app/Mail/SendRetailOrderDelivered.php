<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RetailOrder;

class SendRetailOrderDelivered extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RetailOrder $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;

        $data = [
            'order' => $order,
            'domain' => $order->domain,
            'url' => route('template.orders.show', [
                'domain' => $order->domain,
                'id' => $order->id,
            ]),
            'confirmUrl' => route('template.orders.confirm-receive', [
                'domain' => $order->domain,
                'token' => encrypt($order->id),
            ]),
        ];

        $subject = 'Order ' . $order->invoice_no . ' - Pembelian Dikirim';
        return $this->markdown('Emails.retail-order-delivered', $data)->subject($subject)->from($order->owner->member->email, $order->owner->member->nama);
    }
}
