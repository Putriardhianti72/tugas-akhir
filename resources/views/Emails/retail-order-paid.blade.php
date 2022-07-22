@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->customer->name }},

Pembayaran Anda sudah kami terima.

@component('mail::table')
| Produk         |               | Harga    |
| :------------- |:-------------:| --------:|
| {{ $order->product->product_name }}  | {{ $order->product->qty }} x {{ $order->product->price }} | {{ $order->product->total_price }}   |
@endcomponent

@component('mail::table', ['class' => 'table-stretch'])
| Detail Pembayaran  |                                            |
| :----------------- | -----------------------------------------: |
| Metode Pembayaran  | {{ $order->payment->payment_type ?: '-' }} |
@if ($order->payment->bank)
| Bank               | {{ $order->payment->bank }}                |
@endif
@if ($order->payment->va_number)
| No Virtual Account | {{ $order->payment->va_number }}           |
@endif
| Order Total        | {{ $order->product->total_price }}         |
| Shipping Total     | {{ $order->shipping->price }}              |
| Grand Total        | **{{ $order->total_price }}**              |
@endcomponent

@component('mail::button', ['url' => $url])
Lihat Order
@endcomponent

Terima kasih,<br>
{{ $order->owner->member->nama ?? '' }}
@endcomponent
