@extends('Layouts.user.main')

@section('class-body', 'product-cart checkout-cart blog')

@section('isi')
<div class="main-content" id="cart">
  <!-- main -->
  <div id="wrapper-site">
    <!-- breadcrumb -->
    <nav class="breadcrumb-bg">
      <div class="container no-index">
        <div class="breadcrumb">
          <ol>
            <li>
              <a href="{{ url('/') }}">
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/orders') }}">
                <span>My Orders</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span>Detail Order</span>
              </a>
            </li>
          </ol>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div id="content-wrapper" class="col-12 col-sm-12 col-md-12 col-lg-12 onecol">
          <section id="main">
            <div class="cart-grid row">
              <div class="col-md-9 col-12 check-info">

                  <div class="row mb-4 pb-4">
                    <div class="col-12">
                      <h1 class="title-page">Order Detail</h1>

                      @if($order->status == \App\Models\Order::STATUS_PENDING)
                        <div class="row mb-4">
                          <div class="col-12">
                            <div class="form-group row">
                              <div class="col-12 col-md-12">
                                <div class="card bg-warning text-white">
                                  <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                      <h5 class="subtitle-page">Pembayaran</h5>
                                      <label>Lanjutkan pembayaran untuk menyelesaikan order.</label>
                                    </div>
                                    <form action="{{ route('orders.pay', $order->id) }}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                      <div class="card">
                        <div class="card-header text-right">
                          Invoice No. {{ $order->invoice_no }}

                          <strong class="ml-4">
                            {{ $order->status_text }}
                          </strong>
                        </div>

                        <div class="card-body">
                          <h6 class="subtitle-page">Product List</h6>

                          <table class="std table">
                            <thead>
                              <tr>
                                <th class="first_item" width="15%">Image</th>
                                <th class="item mywishlist_first">Product Name</th>
                                <th class="item mywishlist_second">Domain</th>
                                <th class="item mywishlist_first">Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($order->products as $product)
                              <tr>
                                <td>
                                  <a href="#">
                                    <img class="img-fluid" src="{{ $product->pict_url }}" alt="{{ $product->product_name }}">
                                  </a>
                                </td>
                                <td class="bold align_center">
                                  {{ $product->product_name }}
                                </td>
                                <td>{{ $product->domain }}</td>
                                <td>{{ $product->price }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  @if($order->status != \App\Models\Order::STATUS_PENDING)
                  <div class="row mb-4">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="subtitle-page">Payment Detail</h5>

                          <div class="row my-4">
                            <div class="col-12">
                              <div class="row">
                                <div class="col-12 col-md-4">
                                  Metode Pembayaran
                                </div>
                                <div class="col-12 col-md-8">
                                  {{ $order->payment->payment_type_text }}
                                </div>
                              </div>
                              @if($order->payment->bank)
                              <div class="row">
                                <div class="col-12 col-md-4">
                                  Bank
                                </div>
                                <div class="col-12 col-md-8">
                                  {{ $order->payment->bank }}
                                </div>
                              </div>
                              @endif
                              @if($order->payment->va_number)
                              <div class="row">
                                <div class="col-12 col-md-4">
                                  No. Virtual Account
                                </div>
                                <div class="col-12 col-md-8">
                                  {{ $order->payment->va_number }}
                                </div>
                              </div>
                              @endif
                              <div class="row">
                                <div class="col-12 col-md-4">
                                  Jumlah Pembayaran
                                </div>
                                <div class="col-12 col-md-8">
                                  {{ $order->payment->total_price }}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

                  <hr class="my-4">
              </div>
              <div class="cart-grid-right col-xs-12 col-lg-3">
                <div class="cart-summary">
                  <div class="cart-detailed-totals">
                    <div class="cart-summary-products">
                      <div class="summary-label">There are {{ 0 }} item in your cart</div>
                    </div>
                    <div class="cart-summary-line" id="cart-subtotal-products">
                      <span class="label js-subtotal">
                        Total products:
                      </span>
                      <span class="value">{{ 0 }}</span>
                    </div>
                    <div class="cart-summary-line" id="cart-subtotal-shipping">
                      <span class="label">
                        Total Shipping:
                      </span>
                      <span class="value">Free</span>
                      <div>
                        <small class="value"></small>
                      </div>
                    </div>
                    <div class="cart-summary-line cart-total">
                      <span class="label">Total:</span>
                      <span class="value">{{ 0 }} (tax incl.)</span>
                    </div>
                  </div>
                </div>
                <div id="block-reassurance">
                  <ul>
                    <li>
                      <div class="block-reassurance-item">
                        <img src="{{ asset('/user/img/product/check1.png') }}" alt="Security policy (edit with Customer reassurance module)">
                        <span>Security policy (edit with Customer reassurance module)</span>
                      </div>
                    </li>
                    <li>
                      <div class="block-reassurance-item">
                        <img src="{{ asset('/user/img/product/check2.png') }}" alt="Delivery policy (edit with Customer reassurance module)">
                        <span>Delivery policy (edit with Customer reassurance module)</span>
                      </div>
                    </li>
                    <li>
                      <div class="block-reassurance-item">
                        <img src="{{ asset('/user/img/product/check3.png' ) }}" alt="Return policy (edit with Customer reassurance module)">
                        <span>Return policy (edit with Customer reassurance module)</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
$(function() {
  $(document).on('input', '[data-cart-input="domain"]', function() {
    var $this = $(this);
    var value = $this.val();

    if (value) {
      if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(value)) {
        $(this).parent().find('.valid-feedback').text('Domain valid');
        $(this).parent().find('.invalid-feedback').text('');
        $(this).addClass('is-valid').removeClass('is-invalid');

        $.ajax({
          url: '{{ url(' / ajax / order / check - domain ') }}',
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            domain: value
          },
          success: function(res) {
            if (res.status === 'success') {
              $this.parent().find('.valid-feedback').text('Domain tersedia');
            }
          },
          error: function(err) {
            if (err.responseJSON.status === 'error') {
              $this.parent().find('.valid-feedback').text('');
              $this.parent().find('.invalid-feedback').text('Domain tidak tersedia');
              $this.addClass('is-invalid').removeClass('is-valid');
            }
          }
        })
      } else {
        $(this).parent().find('.valid-feedback').text('');
        $(this).parent().find('.invalid-feedback').text('Domain tidak valid');
        $(this).addClass('is-invalid').removeClass('is-valid');
      }
    } else {
      $(this).parent().find('.valid-feedback').text('');
      $(this).parent().find('.invalid-feedback').text('');
      $(this).removeClass('is-invalid').removeClass('is-valid');
    }
  });
})
</script>
@endpush
