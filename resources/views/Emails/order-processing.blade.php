@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->member->nama }},

Domain Anda sedang kami proses.

@component('mail::table')
| Produk         | Harga    |
| :------------- | --------:|
@foreach($order->products as $product)
| {{ $product->product_name }}  | {{ format_currency($product->price) }}   |
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
| Order Total        | **{{ format_currency($order->total_price) }}**              |
@endcomponent

@component('mail::button', ['url' => $url])
Lihat Order
@endcomponent

Terima kasih<br>

@endcomponent
