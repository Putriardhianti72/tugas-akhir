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
              <a href="#">
                <span>Shopping Cart</span>
              </a>
            </li>
          </ol>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
          <section id="main">
            <div class="cart-grid row">
              @if(count($carts))
              <div class="col-md-9 col-xs-12 check-info">
                <form action="{{ route('carts.update') }}" method="post">
                  @csrf
                  @method('patch')

                  <h1 class="title-page">Shopping Cart</h1>
                  <div class="cart-container">
                    <div class="cart-overview js-cart">
                      <ul class="cart-items">
                        @foreach($carts as $i => $cart)
                        <input type="hidden" name="carts[{{ $i }}][id]" value="{{ $cart->id }}">
                        <li class="cart-item">
                          <div class="product-line-grid row justify-content-between">
                            <!--  product left content: image-->
                            <div class="product-line-grid-left col-md-2">
                              <span class="product-image media-middle">
                                <a href="product-detail.html">
                                  <img class="img-fluid" src="{{ $cart->product->pict_url }}" alt="{{ $cart->product->product_name }}">
                                </a>
                              </span>
                            </div>
                            <div class="product-line-grid-body col-md-6">
                              <div class="product-line-info">
                                <a class="label" href="product-detail.html" data-id_customization="0">{{ $cart->product->name }}</a>
                              </div>
                              <div class="product-line-info product-price">
                                <span class="value">{{ $cart->product->price }}</span>
                              </div>
                            </div>
                            <div class="product-line-grid-right product-line-actions col-md-4">
                              <div class="row">
                                <div class="col-md-10 col qty">
                                  <input type="text" name="carts[{{ $i }}][domain]" value="{{ $cart->domain }}" class="form-control form-control-sm" placeholder="Domain" data-cart-input="domain" data-cart-id="{{ $cart->id }}" aria-label="Domain" aria-describedby="basic-addon2" autocomplete="off" required>
                                  <div class="valid-feedback"></div>
                                  <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-md-1 col text-xs-right">
                                  <div class="cart-line-product-actions">
                                    <a class="remove-from-cart" rel="nofollow" href="/cart/hapus/{{ $cart->id }}" data-link-action="delete-from-cart" data-id-product="1">
                                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  <button type="submit" class="continue btn btn-primary pull-xs-right">
                    Continue
                  </button>
                </form>
              </div>
              @else
              <div class="col-md-9 col-xs-12 check-info text-muted text-center p-4">
                <em>Anda belum memiliki produk di dalam cart</em>
              </div>
              @endif
              <div class="cart-grid-right col-xs-12 col-lg-3">
                <div class="cart-summary">
                  <div class="cart-detailed-totals">
                    <div class="cart-summary-products">
                      <div class="summary-label">There are {{ $totalCart }} item in your cart</div>
                    </div>
                    <div class="cart-summary-line" id="cart-subtotal-products">
                      <span class="label js-subtotal">
                        Total products:
                      </span>
                      <span class="value">{{ $totalCartPrice }}</span>
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
                      <span class="value">{{ $totalCartPrice }} (tax incl.)</span>
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
      $(this).parent().find('.valid-feedback').text('Domain valid');
      $(this).parent().find('.invalid-feedback').text('');
      $(this).addClass('is-valid').removeClass('is-invalid');

      $.ajax({
        url: '{{ url('/ajax/order/check-domain') }}',
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
      });
    } else {
      $(this).parent().find('.valid-feedback').text('');
      $(this).parent().find('.invalid-feedback').text('');
      $(this).removeClass('is-invalid').removeClass('is-valid');
    }
  });
});
</script>
@endpush


