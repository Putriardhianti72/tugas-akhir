@extends('Layouts.user.main')

@section('class-body', 'product-cart member-area checkout-cart blog')

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
              <a href="{{ url('/') }}/member-area">
                <span>My Dashboard</span>
              </a>
            </li>
             <li>
              <a href="#">
                <span>Detail Order Retail</span>
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
            <a href="{{ route('member-area.index', $domain) }}" class="btn btn-text mb-4"><i class="fa fa-angle-left mr-2"></i> Back</a>

            <div class="row">
              <div class="col-md-12">
                <div class="card shadow">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Order Detail</h4>
                    <div class="text-right">
                      <span class="mr-4">Invoice No: {{ $order->invoice_no }}</span>

                        <span class="ml-auto">Order Status:
                          <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-order-status">
                            <strong>
                              {{ $order->status_text }}
                            </strong>
                          </span>
                        </span>
                    </div>
                  </div>
                  <div class="card-body-">
                    <div class="row mb-2">
                      <div class="col-12">
                        <div class="card shadow-none border-0">
                          <div class="card-header bg-light d-flex align-items-center justify-content-between">
                            <h6 class="subtitle-page mb-0">Delivery Address</h6>

                            <span class="ml-auto">Tracking No:
                              <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-shipping">
                                <strong>
                                  {{ $order->shipping->tracking_no ?? 'N/A' }}
                                </strong>
                              </span>
                            </span>
                          </div>
                          <div class="card-body">
                            @if($order->customer)
                            <div class="row">
                              <div class="col-7">
                                <div class="mb-0 font-weight-bold">{{ $order->customer->name }}</div>
                                <small class="d-block mb-3">
                                  {{ $order->customer->no_hp }}<br>
                                  {{ $order->customer->email }}
                                </small>
                                <div>
                                  {{ $order->customer->alamat }}
                                </div>
                                <div>
                                  {{ $order->customer->subdistrict_name }},
                                  {{ $order->customer->city_name }},
                                  {{ $order->customer->province_name }}
                                </div>
                              </div>
                              @if($order->shipping)
                              <div class="col-5 text-right">
                                {{ $order->shipping->name }}
                                <br>
                                Berat: {{ $order->shipping->weight }} gram
                              </div>
                              @endif
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>

                    <div class="row mb-2">
                      <div class="col-12">
                        <div class="card shadow-none border-0">
                          <div class="card-header bg-light">
                            <h6 class="subtitle-page mb-0">Product Detail</h6>
                          </div>
                          <div class="card-body">
                            @if($order->product)
                            <div class="row cart-row">
                              <div class="col-12 col-md-6">
                                <div class="product-name"><strong>{{ $order->product->product_name }}</strong></div><span class="truncate-text"><small>{{ $order->product->desc }}</small></span>
                              </div>
                              <div class="col-12 col-md-3">
                                <div class="col-12 text-right">
                                  <h6>{{ format_currency($order->product->price) }} <span class="text-muted">x</span> {{ $order->product->qty }}</h6>
                                </div>
                              </div>
                              <div class="col-12 col-md-3">
                                <div class="col-12 text-right">
                                  <h6>{{ format_currency($order->product->total_price) }}</h6>
                                </div>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>

                    <div class="row mb-2">
                      <div class="col-12">
                        <div class="card shadow-none border-0">
                          <div class="card-header bg-lightd-flex align-items-center justify-content-between">
                            <h6 class="subtitle-page mb-0">Payment Detail</h6>

                            <span class="ml-auto">Payment Status:
                              <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-payment-status">
                                <strong>
                                  {{ $order->payment->transaction_status ?? '-' }}
                                </strong>
                              </span>
                            </span>
                          </div>
                          <div class="card-body">
                            @if ($order->payment)
                            <div class="row my-4">
                              <div class="col-12">
                                <div class="row">
                                  <div class="col-12 col-md-4 col-lg-3">
                                    Metode Pembayaran
                                  </div>
                                  <div class="col-12 col-md-8 col-lg-9">
                                    {{ $order->payment->payment_type_text }}
                                  </div>
                                </div>
                                @if($order->payment->bank)
                                <div class="row">
                                  <div class="col-12 col-md-4 col-lg-3">
                                    Bank
                                  </div>
                                  <div class="col-12 col-md-8 col-lg-9">
                                    {{ $order->payment->bank }}
                                  </div>
                                </div>
                                @endif
                                @if($order->payment->va_number)
                                <div class="row">
                                  <div class="col-12 col-md-4 col-lg-3">
                                    No Virtual Account
                                  </div>
                                  <div class="col-12 col-md-8 col-lg-9">
                                    {{ $order->payment->va_number }}
                                  </div>
                                </div>
                                @endif
                                <div class="row">
                                  <div class="col-12 col-md-4 col-lg-3">
                                    Order Total
                                  </div>
                                  <div class="col-12 col-md-8 col-lg-9">
                                    {{ format_currency($order->product->total_price ?? 0) }}
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-12 col-md-4 col-lg-3">
                                    Shipping Total
                                  </div>
                                  <div class="col-12 col-md-8 col-lg-9">
                                    {{ format_currency($order->shipping->price) }}
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-12 col-md-4 col-lg-3">
                                    Grand Total
                                  </div>
                                  <div class="col-12 col-md-8 col-lg-9">
                                    {{ format_currency($order->total_price) }}
                                  </div>
                                </div>
                              </div>
                            </div>
                            @else
                            <div class="row my-4">
                              <div class="col-12 text-center">
                                <em class="text-muted">No data available</em>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>

                    <div class="row mb-2">
                      <div class="col-12">
                        <div class="card shadow-none border-0">
                          <div class="card-header bg-light d-flex align-items-center justify-content-between">
                            <h6 class="subtitle-page mb-0">Reward</h6>

                            <span class="ml-auto">
                              @if($order->status == \App\Models\RetailOrder::STATUS_COMPLETED)
                              <span class="ml-2 update-status" tabindex="0" role="button" data-toggle="modal" data-target="#modal-update-commission">
                                <strong>
                                  {{ $order->commission ? format_currency($order->commission) : 'N/A' }}
                                </strong>
                              </span>
                              @else
                              <span class="ml-2">
                                Order belum selesai
                              </span>
                              @endif
                            </span>
                          </div>

                        </div>
                      </div>
                    </div>
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
