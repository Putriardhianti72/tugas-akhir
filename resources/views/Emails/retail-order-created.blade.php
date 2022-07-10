@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->customer->name }},

Terima kasih sudah melakukan pembelian di situs kami.



@component('mail::table')
| Alamat Pengiriman            |
| :---------------------------- |
| {{ $order->customer->name }} <br> {{ $order->customer->alamat }} <br> {{ $order->customer->subdistrict_name }}, {{ $order->customer->city_name }}, {{ $order->customer->province_name }} |
@endcomponent

@component('mail::table')
| Metode Pengiriman            |
| :---------------------------- |
| {{ $order->shipping->name }} |
@endcomponent


@component('mail::table')
| Produk         |               | Harga    |
| :------------- |:-------------:| --------:|
| {{ $order->product->product_name }}  | {{ $order->product->qty }} x {{ $order->product->price }} | {{ $order->product->total_price }}   |
@endcomponent

@component('mail::subcopy')
<p class="text-right">
  Shipping {{ $order->shipping->price }}
</p>
<p class="text-right">
  Grand Total <b>{{ $order->total_price }}</b>
</p>
@endcomponent

@component('mail::button', ['url' => $url])
Lihat Order
@endcomponent

Terima kasih,<br>
{{ $order->owner->nama }}
@endcomponent
