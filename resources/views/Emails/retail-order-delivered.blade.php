@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->customer->name }},

Pesanan Anda telah dikirim pada {{ $order->shipping->updated_at ?? null ? $order->shipping->updated_at->format('d/m/Y') : '' }}.

Mohon menerima dan mengkonfirmasi pesanan di e-mail ini apabila barang telah Anda terima. Klik tombol konfirmasi terima barang.


@component('mail::button', ['url' => $confirmUrl])
Konfirmasi Terima Barang
@endcomponent

@component('mail::table')
| Alamat Pengiriman            |
| :---------------------------- |
| {{ $order->customer->name }} <br> {{ $order->customer->alamat }} <br> {{ $order->customer->subdistrict_name }}, {{ $order->customer->city_name }}, {{ $order->customer->province_name }} |
| {{ $order->shipping->name }} |
@endcomponent

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
