@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->member->nama }},

Pembayaran Anda sudah kami terima.

@component('mail::table')
| Produk         | Harga    |
| :------------- | --------:|
@foreach($order->products as $product)
| {{ $product->product_name }}  | {{ $product->price }}   |
@endforeach
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
| Order Total        | **{{ $order->total_price }}**              |
@endcomponent

@component('mail::button', ['url' => $url])
Lihat Order
@endcomponent

Terima kasih<br>

@endcomponent
