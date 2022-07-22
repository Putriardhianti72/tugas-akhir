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
          </ol>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div id="content-wrapper" class="col-12 col-sm-12 col-md-12 col-lg-12 onecol">
          <section id="main">
            <div class="row mb-5">
              <div class="col-3">
                <div class="card">
                  <div class="card-body pb-3">
                    <h6 class="card-subtitle text-muted">Total Reward</h6>
                    <h5 class="card-title mb-0">{{ $totalCommission }}</h5>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="card">
                  <div class="card-body pb-3">
                    <h6 class="card-subtitle text-muted">Total Order Selesai</h6>
                    <h5 class="card-title mb-0">{{ $totalOrderCompleted }}</h5>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="card">
                  <div class="card-body pb-3">
                    <h6 class="card-subtitle text-muted">Total Order Dikirim</h6>
                    <h5 class="card-title mb-0">{{ $totalOrderDelivery }}</h5>
                  </div>
                </div>
              </div>
               <div class="col-3">
                <div class="card">
                  <div class="card-body pb-3">
                    <h6 class="card-subtitle text-muted" style="font-size: 0.9rem">Total Order Belum Dibayar</h6>
                    <h5 class="card-title mb-0">{{ $totalOrderPending }}</h5>
                  </div>
                </div>
              </div>
            </div>

            <div class="cart-grid row">
              <div class="cart-grid-right col-xs-12 col-lg-3">
                <div class="card">
                  <div class="card-header">
                    Domain
                  </div>
                  <div class="list-group list-group-flush">
                    @foreach($orderProducts as $product)
                    <a href="#" class="list-group-item list-group-item-action {{ $domain === $product->domain ? 'active' : '' }}">
                      {{ $product->domain }}
                    </a>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col-md-9 col-12 check-info">
                <div id="block-history" class="block-center">
                  <table class="std table">
                      <thead>
                        <tr>
                          <th class="first_item">Invoice No</th>
                          <th class="item mywishlist_first">Customer</th>
                          <th class="item mywishlist_first">Qty</th>
                          <th class="item mywishlist_first">Harga</th>
                          <th class="item mywishlist_first">Reward</th>
                          <th class="item mywishlist_first">Status</th>
                          <th class="item mywishlist_second">Created</th>
                          <th class="item mywishlist_second"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($orders as $order)
                        <tr>
                          <td>
                            <a href="{{ route('member-area.show', ['domain' => $domain, 'id' => $order->id]) }}">
                              {{ $order->invoice_no }}
                            </a>
                          </td>
                          <td class="bold align_center">
                            {{ $order->customer->name ?? '-' }}
                          </td>
                          <td>{{ $order->product->qty ?? 1 }}</td>
                          <td>{{ $order->total_price }}</td>
                          <td>{{ $order->commission }}</td>
                          <td>{{ $order->status_text }}</td>
                          <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                          <td>
                            <a href="{{ route('member-area.show', ['domain' => $domain, 'id' => $order->id]) }}">
                              Lihat
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
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
});
</script>
@endpush
