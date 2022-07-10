<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class SendOrderCancelled extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
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
            'template' => $order->template,
            'url' => route('orders.show', [
                'order' => $order->id,
            ])
        ];

        $subject = 'Order ' . $order->invoice_no . ' - Pembelian Dibatalkan';
        return $this->markdown('Emails.order-cancelled', $data)->subject($subject);
    }
}
