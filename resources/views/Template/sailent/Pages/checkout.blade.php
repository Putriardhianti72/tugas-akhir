@extends('Template.sailent.Layouts.main')

@section('body-class', 'page-checkout')

@section('content')
<section>
  <div id="checkout-section">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-7">
          <form id="form-order" method="post" name="contactform" id="contactform" class="animated out" data-animation="fadeInUp" data-delay="0">

            <fieldset>
              <div class="form-group">
                <input class="form-control br-b" type="text" name="customer[name]" id="name" placeholder="Name">
              </div>

              <div class="form-group">
                <input class="form-control br-b" type="email" name="customer[email]" id="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input class="form-control br-b" type="text" name="customer[no_hp]" id="no_hp" placeholder="No WhatsApp">
              </div>
              <div class="form-group">
                <input class="form-control br-b" type="text" name="qty" id="qty" placeholder="Qty">
              </div>
              <div class="form-group">
                <textarea class="form-control br-b" name="customer[alamat]" id="alamat" placeholder="Alamat..."></textarea>
              </div>
              <div class="form-group">
                <select class="form-control br-b" name="customer[province_id]" data-shipping="province">
                  @foreach ($provinces as $province)
                  <option value="{{ $province['province_id'] }}" {{ config('rajaongkir_api.default_selected.province_id') == $province['province_id'] ? 'selected' : '' }}>{{ $province['province'] }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <select class="form-control br-b" name="customer[city_id]" data-shipping="city">
                </select>
              </div>

              <div class="form-group">
                <select class="form-control br-b" name="customer[subdistrict_id]" data-shipping="subdistrict">
                </select>
              </div>

              {{-- <div class="form-group">
                <select class="form-control br-b" name="customer[courier]" data-shipping="courier">
                  <option value="">Pilih Kurir</option>
                  @foreach ($couriers as $key => $value)
                  <option value="{{ $key }}">{{ $value }}</option>
                  @endforeach
                </select>
              </div> --}}

              <div class="form-group">
                <select class="form-control br-b" name="customer[courier_service]" data-shipping="courier_service">
                </select>
              </div>
            </fieldset>

            <!-- submit button -->
            <div class="form-group">
              <input type="submit" name="submit" value="Send message" id="submit" class="btn btn-sm btn-dark">
            </div>

            <div id="alert"></div>

          </form>

        </div>
        <div class="col-xs-12 col-md-5">
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
              <div class="row cart-row" data-product="{{ json_encode($cart['product']) }}" data-qty="{{ $cart['qty'] }}">
                <div class="col-xs-2">
                  @if(isset($cart['product']['pict_url']))
                  <img class="img-responsive" src="{{ $cart['product']['pict_url'] }}">
                  @else
                  <img class="img-responsive" src="https://via.placeholder.com/200x200">
                  @endif
                </div>
                <div class="col-xs-6">
                  <h4 class="product-name"><strong>{{ $cart['product']['nama'] }}</strong></h4><h4 class="truncate-text"><small>{{ $cart['product']['deskripsi'] }}</small></h4>
                </div>
                <div class="col-xs-4">
                  <div class="col-xs-9 text-right">
                    <h6><strong>{{ $cart['product']['harga'] }} <span class="text-muted">x</span></strong> <strong>{{ $cart['qty'] }}</strong></h6>
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

              <div class="row">
                <div class="text-center">
                  <div class="col-xs-9">
                    <h5 class="text-right">Shipping</h5>
                  </div>
                  <div class="col-xs-3">
                    <h5 class="text-right" data-cart="total_shipping">-</h5>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="text-center">
                  <div class="col-xs-9">
                    <h5 class="text-right">Total</h5>
                  </div>
                  <div class="col-xs-3">
                    <h5 class="text-right" data-cart="total_harga" data-total="{{ $totalCartPrice }}">{{ $totalCartPrice }}</h5>
                  </div>
                </div>
              </div>

            </div>
            <div class="panel-footer">
              <div class="row text-center">
                <div class="col-xs-8">
                  {{--<h4 class="text-right">Total <strong data-cart="total_harga">{{ $totalCartPrice }}</strong></h4>--}}
                </div>
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-success btn-block">
                    Checkout
                  </button>
                </div>
              </div>
            </div>
          </div>
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
        url: '{{ route('template.carts.destroy', ['template' => $template, 'cart' => 1]) }}',
        method: 'delete',
        data: data,
        dataType: 'json',
        success: function (res) {
          if (res.status === 'success') {
            $this.closest('.cart-row').remove();

            if (!$this.closest('form').find('.cart-row').length) {
              window.location.replace('{{ route('template.home', $template) }}')
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

      $('[data-cart="total_harga"]').text(total).data('total', total);
    });



    $(document).on('change', '[data-shipping="province"]', function () {
      var val = $(this).val();

      var $city = $('[data-shipping="city"]');

      $city.val('').change();
      $city.html('');

      $.ajax({
        url: '{{ url($template . '/ajax/shipping/city') }}?province=' + val,
        success: function (res) {
          if (res.status === 'success') {
            var html = '<option value="">Pilih Kota/Kabupaten</option>';

            $.each(res.data, function (key, item) {
              html += '<option value="'+item.city_id+'">'+item.type +' '+item.city_name+'</option>'
            });

            $city.html(html);
          }
        },
        error: function (err) {
          console.log(err)
        }
      });
    });

    $(document).on('change', '[data-shipping="city"]', function () {
      var val = $(this).val();

      if (val) {
        var $subdistrict = $('[data-shipping="subdistrict"]');

        $subdistrict.val('').change();
        $subdistrict.html('');

        $.ajax({
          url: '{{ url($template . '/ajax/shipping/subdistrict') }}?city=' + val,
          success: function (res) {
            if (res.status === 'success') {
              var html = '<option value="">Pilih Kecamatan</option>';

              $.each(res.data, function (key, item) {
                html += '<option value="'+item.subdistrict_id+'">'+item.subdistrict_name+'</option>'
              });

              $subdistrict.html(html);
            }
          },
          error: function (err) {
            console.log(err)
          }
        });
      } else {
        $('[data-shipping="subdistrict"]').val('').change()
      }
    });

    $(document).on('change', '[data-shipping="subdistrict"]', function () {
      var subdistrict = $('[data-shipping="subdistrict"]').val();
      $('[data-cart="total_shipping"]').text('-');
      $('[data-cart="total_harga"]').text($('[data-cart="total_harga"]').data('total') || '-');

      if (subdistrict) {
        var totalWeight = 0;

        $('[data-product]').each(function () {
          var product = $(this).data('product');
          var berat = parseFloat(product.berat, 10) || 0;
          var qty = parseFloat($(this).data('qty'), 10) || 0;

          totalWeight += (berat * qty);
        });

        $.ajax({
          url: '{{ url($template . '/ajax/shipping/cost') }}?weight=' + totalWeight + '&subdistrict_id=' + subdistrict,
          success: function (res) {
            if (res.status === 'success') {
              var result = [];

              $.each(res.data, function (key, value) {
                $.each(value.costs, function (k, v) {
                  var cost = $.isArray(v.cost) ? v.cost[0] : null;

                  if (cost) {
                    var etd = cost.etd;
                    var price = cost.value;
                    var service = v.service;
                    var name = value.name;
                    var code = value.code;

                    result.push({
                      name: name,
                      label: name + ' ' + service,
                      code: code,
                      service: service,
                      price: price
                    });
                  }
                });
              });

              result.sort(function (a, b) {
                if (a.price < b.price) {
                  return -1;
                }

                if (a.price > b.price) {
                  return 1;
                }

                return 0;
              });

              var html = '';

              $.each(result, function (key, value) {
                html += '<option value="' + value.name + '::' + value.service + '" data-name="' + value.name + '" data-code="' + value.code + '" data-service="' + value.service + '" data-price="' + value.price + '" data-etd="' + value.etd + '">' + value.label + (value.etd ? ' (' + value.etd + ')' : '') + '</option>';
              });

              $('[data-shipping="courier_service"]').html(html);
              var firstVal = $('[data-shipping="courier_service"]').find('option:first').val();

              if (firstVal) {
                $('[data-shipping="courier_service"]').val(firstVal).trigger('change');
              }
            }
          },
          error: function (err) {
            console.log(err)
          }
        });
      }
    });

    $(document).on('change', '[data-shipping="courier_service"]', function () {
      var $option = $(this).find('option:selected');
      var price = parseInt($option.data('price'), 10);

      $('[data-cart="total_shipping"]').text(price);
      $('[data-cart="total_harga"]').text((parseInt($('[data-cart="total_harga"]').data('total') ,10) + price) || '-')
    });

    $('[data-shipping="province"]').trigger('change');
  });
</script>
@endpush
