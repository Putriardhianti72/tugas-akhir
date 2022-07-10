@component('mail::message')
## Order: {{ $order->invoice_no }}

Halo {{ $order->member->nama }},

Terima kasih sudah melakukan pembelian di situs kami.

@component('mail::table')
| Produk         | Harga    |
| :------------- | --------:|
@foreach($order->products as $product)
| {{ $product->product_name }}  | {{ $product->price }}   |
@endforeach
@endcomponent

@component('mail::subcopy')
<p class="text-right">
  Order Total <b>{{ $order->total_price }}</b>
</p>
@endcomponent

@component('mail::button', ['url' => $url])
Lihat Order
@endcomponent

Terima kasih<br>

@endcomponent
