@extends('Template.sailent.Layouts.main')

@section('content')
<section>
  <div id="cart-section">
    <div class="container">
      <div class="row">
        <div class="col-xs-8">
          <form action="{{ route('template.carts.checkout', $domain) }}" method="post">
            @csrf
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="panel-title">
                  <div class="row">
                    <div class="col-xs-6">
                      <h5><span class="fa fa-shopping-cart"></span> Shopping Cart</h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                @foreach($carts as $cart)
                <input type="hidden" name="carts[{{ $cart['codeProduct'] }}][codeProduct]" value="{{ $cart['codeProduct'] }}">

                <div class="row cart-row">
                  <div class="col-xs-2">
                    @if(isset($cart['product']['pict_url']))
                    <img class="img-responsive" src="{{ $cart['product']['pict_url'] }}">
                    @else
                    <img class="img-responsive" src="https://via.placeholder.com/200x200">
                    @endif
                  </div>
                  <div class="col-xs-4">
                    <h4 class="product-name"><strong>{{ $cart['product']['nama'] }}</strong></h4><h4 class="truncate-text"><small>{{ $cart['product']['deskripsi'] }}</small></h4>
                  </div>
                  <div class="col-xs-6">
                    <div class="col-xs-6 text-right">
                      <h6><strong>{{ $cart['product']['harga'] }} <span class="text-muted">x</span></strong></h6>
                    </div>
                    <div class="col-xs-4">
                      <input type="text" class="form-control input-sm" data-cart="qty" data-harga="{{ $cart['product']['harga'] }}" name="carts[{{ $cart['codeProduct'] }}][qty]" value="{{ $cart['qty'] }}">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-link btn-danger btn-xs" data-cart-action="delete" data-code-product="{{ $cart['codeProduct'] }}">
                        <span class="fa fa-trash"> </span>
                      </button>
                    </div>
                  </div>
                </div>
                <hr>
                @endforeach
              </div>
              <div class="panel-footer">
                <div class="row text-center">
                  <div class="col-xs-9">
                    <h4 class="text-right">Total <strong data-cart="total_harga">{{ $totalCartPrice }}</strong></h4>
                  </div>
                  <div class="col-xs-3">
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
  </div>
</section>

<!-- Footer
================================================== -->
<footer>
  <div id="footer-section" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <ul class="footer-social-links">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Dribbble</a></li>
            <li><a href="#">Behance</a></li>
            <li><a href="#">Pinterest</a></li>
          </ul>
          <p class="copyright">
            &copy; 2016 Salient - Created By <a href="http://templatestock.co">Template Stock</a>
          </p>
        </div> <!-- End col-sm-8 -->
      </div> <!-- End row -->
    </div> <!-- End container -->
  </div> <!-- End footer-section  -->
</footer>
<!-- End footer -->
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

      $('[data-cart="total_harga"]').text(total);
    })
  });
</script>
@endpush
