<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RetailOrder;

class SendRetailOrderCompleted extends Mailable
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
            'template' => $order->template,
            'url' => route('template.orders.show', [
                'template' => $order->template,
                'id' => $order->id,
            ])
        ];

        $subject = 'Order ' . $order->invoice_no . ' - Pembelian Selesai';
        return $this->markdown('Emails.retail-order-completed', $data)->subject($subject)->from($order->owner->email, $order->owner->nama);
    }
}
