@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->customer->name }},

Terima kasih, pembelian Anda telah selesai.

@component('mail::table')
| Alamat Pengiriman            |
| :---------------------------- |
| {{ $order->customer->name }} <br> {{ $order->customer->alamat }} <br> {{ $order->customer->subdistrict_name }}, {{ $order->customer->city_name }}, {{ $order->customer->province_name }} |
| {{ $order->shipping->name }} |
@endcomponent

@component('mail::table')
| Produk         |               | Harga    |
| :------------- |:-------------:| --------:|
| {{ $order->product->product_name }}  | {{ $order->product->qty }} x {{ format_currency($order->product->price) }} | {{ format_currency($order->product->total_price) }}   |
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
| Order Total        | {{ format_currency($order->product->total_price) }}         |
| Shipping Total     | {{ format_currency($order->shipping->price) }}              |
| Grand Total        | **{{ format_currency($order->total_price) }}**              |
@endcomponent

@component('mail::button', ['url' => $url])
Lihat Order
@endcomponent

Jika hendak mengirimkan keluhan, saran atau masukan silahkan email melalui selleria9@gmail.com

Terima kasih,<br>
{{ $order->owner->member->nama ?? '' }}
@endcomponent
