@extends('Template.koppee.Layouts.main')

@section('content')
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 200px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Cart</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="{{ route('template.home', $domain) }}">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Cart</p>
        </div>
    </div>
</div>


<div class="container py-5">
  <div class="row">
    <div class="col col-10">
      <form action="{{ route('template.carts.checkout', $domain) }}" method="post">
        @csrf
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="card-title mb-0">
              <span class="fa fa-shopping-cart"></span> Shopping Cart
            </div>
          </div>
          <div class="card-body">
            @foreach($carts as $cart)
            <input type="hidden" name="carts[{{ $cart['codeProduct'] }}][codeProduct]" value="{{ $cart['codeProduct'] }}">

            <div class="row cart-row">
              <div class="col col-2">
                @if(isset($cart['product']['pict_url']))
                <img class="img-responsive img-fluid" src="{{ asset('assets/sailent/images/hero-bg/1.png') }}">
                @else
                <img class="img-responsive img-fluid" src="{{ asset('assets/sailent/images/hero-bg/1.png') }}">
                @endif
              </div>
              <div class="col col-4">
                <h4 class="product-name"><strong>{{ $cart['product']['nama'] }}</strong></h4><h4 class="truncate-text"><small>{{ $cart['product']['deskripsi'] }}</small></h4>
              </div>
              <div class="col col-6">
                <div class="row">
                  <div class="col col-6 d-flex align-items-center justify-content-end">
                    <h6 class="mb-0"><strong>{{ format_currency($cart['product']['harga']) }} <span class="text-muted">x</span></strong></h6>
                  </div>
                  <div class="col col-4">
                    <input type="text" class="form-control input-sm" data-cart="qty" data-harga="{{ $cart['product']['harga'] }}" name="carts[{{ $cart['codeProduct'] }}][qty]" value="{{ $cart['qty'] }}">
                  </div>
                  <div class="col col-2">
                    <button type="button" class="btn btn-link btn-danger btn-xs" data-cart-action="delete" data-code-product="{{ $cart['codeProduct'] }}">
                      <span class="fa fa-trash"> </span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            @endforeach
          </div>
          <div class="card-footer bg-transparent">
            <div class="row text-center">
              <div class="col col-9">
                <h4 class="text-right">Total <strong data-cart="total_harga">{{ format_currency($totalCartPrice) }}</strong></h4>
              </div>
              <div class="col col-3">
                <button type="submit" class="btn btn-success btn-block">
                  Checkout
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection


@push('js')
<script type="text/javascript">
  $(function () {
    $(document).on('click', '[data-cart-action="delete"]', function (e) {
      e.preventDefault();

      var $this = $(this);
      var data = {
        codeProduct: $this.data('code-product'),
        _token: '{{ csrf_token() }}'
      }

      $.ajax({
        url: '{{ route('template.carts.destroy', ['domain' => $domain, 'cart' => 1]) }}',
        method: 'delete',
        data: data,
        dataType: 'json',
        success: function (res) {
          if (res.status === 'success') {
            $this.closest('.cart-row').remove();

            if (!$this.closest('form').find('.cart-row').length) {
              window.location.replace('{{ route('template.home', $domain) }}')
            }
          }
        },
        error: function (err) {
          console.log(err)
        }
      });
    });

    $(document).on('input', '[data-cart="qty"]', function (e) {
      var $form = $(this).closest('form');
      var total = 0;

      $form.find('[data-cart="qty"]').each(function () {
        var harga = parseFloat($(this).data('harga') || 0, 10) || 0;
        var qty = parseFloat($(this).val(), 10) || 0;

        total += (harga * qty);
      });

      $('[data-cart="total_harga"]').text($.getFormattedCurrency(total));
    })
  });
</script>
@endpush
