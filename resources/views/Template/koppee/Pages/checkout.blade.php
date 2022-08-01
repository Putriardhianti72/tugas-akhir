@extends('Template.koppee.Layouts.main')

@push('css')
<style type="text/css">
#checkout-section .panel-heading,
#checkout-section .panel-body,
#checkout-section .panel-footer {
  padding: 1rem 0;
}

@media (min-width: 1000px) {
  #checkout-section::after {
      -webkit-box-shadow: 1px 0 0 #cfcdc6 inset;
      box-shadow: 1px 0 0 #cfcdc6 inset;
  }
}

#checkout-section::after {
  content: "";
  display: block;
  width: 43%;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  background: #fafafa;
  z-index: -1;
}
</style>
@endpush

@section('content')
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 200px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Checkout</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="{{ route('template.home', $domain) }}">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Checkout</p>
        </div>
    </div>
</div>


<div id="checkout-section" class="container py-5">
  <form id="form-order" action="{{ route('template.orders.store', $domain) }}" method="post" class="animated out" data-animation="fadeInUp" data-delay="0">
    @csrf
    <input type="hidden" name="domain" value="{{ env('KOPPEE_DOMAIN') }}">
    <input type="hidden" name="customer[province_name]" value="{{ old('customer[name]') }}">
    <input type="hidden" name="customer[city_name]" value="{{ old('customer[city_name]') }}">
    <input type="hidden" name="customer[subdistrict_name]" value="{{ old('customer[subdistrict_name]') }}">
    <input type="hidden" name="shipping[name]" value="{{ old('shipping[name]') }}">
    <input type="hidden" name="shipping[code]" value="{{ old('shipping[code]') }}">
    <input type="hidden" name="shipping[price]" value="{{ old('shipping[price]') }}">
    <input type="hidden" name="shipping[weight]" value="{{ old('shipping[code]') }}">
    <input type="hidden" name="shipping[etd]" value="{{ old('shipping[etd]') }}">

    <div class="row">
      <div class="col col-12 col-md-7">
          <fieldset>
            <div class="form-group">
              <input class="form-control br-b" type="text" name="customer[name]" id="name" placeholder="Name" value="{{ old('customer[name]') }}" required>
            </div>

            <div class="form-group">
              <input class="form-control br-b" type="email" name="customer[email]" id="email" placeholder="Email" value="{{ old('customer[email]') }}" required>
            </div>
            <div class="form-group">
              <input class="form-control br-b" type="text" name="customer[no_hp]" id="no_hp" placeholder="No WhatsApp" value="{{ old('customer[no_hp]') }}" required>
            </div>
            <div class="form-group">
              <textarea class="form-control br-b" name="customer[alamat]" id="alamat" placeholder="Alamat..." required>{{ old('customer[alamat]') }}</textarea>
            </div>
            <div class="form-group">
              <select class="form-control br-b" name="customer[province_id]" data-shipping="province" required>
                @foreach ($provinces as $province)
                <option value="{{ $province['province_id'] }}" data-province="{{ $province['province'] }}" {{ old('customer[province_id]', config('rajaongkir_api.default_selected.province_id')) == $province['province_id'] ? 'selected' : '' }}>{{ $province['province'] }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <select class="form-control br-b" name="customer[city_id]" data-shipping="city"  value="{{ old('customer[city_id]') }}" required>
              </select>
            </div>

            <div class="form-group">
              <select class="form-control br-b" name="customer[subdistrict_id]" data-shipping="subdistrict" value="{{ old('customer[customer_id]') }}" required>
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
              <select class="form-control br-b" name="shipping[service]" data-shipping="courier_service" required>
              </select>
            </div>
          </fieldset>

          <div id="alert"></div>
      </div>
      <div class="col col-12 col-md-5">
        <div class="card card-info" style="font-size: 0.8em;">
          <div class="card-header bg-transparent">
            <div class="card-title">
              <div class="row">
                <div class="col col-6">
                  <h6><span class="fa fa-shopping-cart"></span> Shopping Cart</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            @foreach($carts as $cart)
            <div class="row cart-row" data-product="{{ json_encode($cart['product']) }}" data-qty="{{ $cart['qty'] }}">
              <div class="col col-2">
                @if(isset($cart['product']['pict_url']))
                <img class="img-fluid" src="{{ asset('assets/sailent/images/hero-bg/1.png') }}">
                @else
                <img class="img-fluid" src="{{ asset('assets/sailent/images/hero-bg/1.png') }}">
                @endif
              </div>
              <div class="col col-6">
                <div class="product-name"><strong>{{ $cart['product']['nama'] }}</strong></div><div class="truncate-text"><small>{{ $cart['product']['deskripsi'] }}</small></div>
              </div>
              <div class="col col-4 py-0">
                <div class="text-right">
                  <div><strong>{{ format_currency($cart['product']['harga']) }} <span class="text-muted">x</span></strong> <strong>{{ $cart['qty'] }}</strong></div>
                </div>
              </div>
            </div>
            <hr>
            @endforeach

            <div class="row text-right">
              <div class="col col-9">
                <div class="text-right">Shipping</div>
              </div>
              <div class="col col-3">
                <strong class="text-right" data-cart="total_shipping">-</strong>
              </div>
            </div>
            <div class="row text-right">
              <div class="col col-9">
                <strong class="text-right">Total</strong>
              </div>
              <div class="col col-3">
                <strong class="text-right" data-cart="total_harga" data-total="{{ $totalCartPrice }}">{{ format_currency($totalCartPrice) }}</strong>
              </div>
            </div>

          </div>
          <div class="card-footer bg-transparent">
            <div class="row text-center">
              <div class="col col-8">
                {{--<h4 class="text-right">Total <strong data-cart="total_harga">{{ $totalCartPrice }}</strong></h4>--}}
              </div>
              <div class="col col-4">
                <button type="submit" class="btn btn-success btn-block">
                  Checkout
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection


@push('js')
<script type="text/javascript">
  $(function () {
    $(document).on('input', '[data-cart="qty"]', function (e) {
      var $form = $(this).closest('form');
      var total = 0;

      $form.find('[data-cart="qty"]').each(function () {
        var harga = parseFloat($(this).data('harga') || 0, 10) || 0;
        var qty = parseFloat($(this).val(), 10) || 0;

        total += (harga * qty);
      });

      $('[data-cart="total_harga"]').text($.getFormattedCurrency(total)).data('total', total);
    });

    var oldCityValue = '{{ old('customer[city_id]') }}'

    $(document).on('change', '[data-shipping="province"]', function () {
      var val = $(this).val();
      $('input[name="customer[province_name]"]').val($(this).find('option:selected').data('province') || '');

      var $city = $('[data-shipping="city"]');

      $city.val('').change(); //nilai value menjadi kosong
      $city.html(''); //nilai option menjadi kosong

      $.ajax({
        url: '{{ route('template.ajax.shipping.city', $domain) }}?province=' + val,
        success: function (res) {
          if (res.status === 'success') {
            var html = '<option value="">Pilih Kota/Kabupaten</option>';

            $.each(res.data, function (key, item) {
              html += '<option value="'+item.city_id+'" data-city-name="'+item.city_name+'">'+item.type +' '+item.city_name+'</option>'
            });

            $city.html(html);

            if (oldCityValue) {
              $city.val(oldCityValue).trigger('change');
              oldCityValue = null;
            }
          }
        },
        error: function (err) {
          console.log(err)
        }
      });
    });

    var oldSubdistrictValue = '{{ old('customer[subdistrict_id]') }}'

    $(document).on('change', '[data-shipping="city"]', function () {
      var val = $(this).val();

      $('input[name="customer[city_name]"]').val($(this).find('option:selected').data('city-name') || '');

      if (val) {
        var $subdistrict = $('[data-shipping="subdistrict"]');

        $subdistrict.val('').change();
        $subdistrict.html('');

        $.ajax({
          url: '{{ route('template.ajax.shipping.subdistrict', $domain) }}?city=' + val,
          success: function (res) {
            if (res.status === 'success') {
              var html = '<option value="">Pilih Kecamatan</option>';

              $.each(res.data, function (key, item) {
                html += '<option value="'+item.subdistrict_id+'" data-subdistrict-name="'+item.subdistrict_name+'">'+item.subdistrict_name+'</option>'
              });

              $subdistrict.html(html);

              if (oldSubdistrictValue) {
                $subdistrict.val(oldSubdistrictValue).trigger('change');
                oldSubdistrictValue = null;
              }
            }
          },
          error: function (err) {
            console.log(err)
          }
        });
      } else {
        $('[data-shipping="subdistrict"]').val('').change();
      }
    });

    var oldShippingServiceValue = '{{ old('shipping[service]') }}'

    $(document).on('change', '[data-shipping="subdistrict"]', function () {
      var subdistrict = $('[data-shipping="subdistrict"]').val();
      $('input[name="customer[subdistrict_name]"]').val($(this).find('option:selected').data('subdistrict-name'));

      $('input[name="shipping[weight]"]').val('');
      $('input[name="shipping[service]"]').val('');
      $('input[name="shipping[code]"]').val('');
      $('input[name="shipping[name]"]').val('');
      $('input[name="shipping[etd]"]').val('');
      $('input[name="shipping[price]"]').val('');
      $('[data-cart="total_shipping"]').text('-');
      $('[data-cart="total_harga"]').text($.getFormattedCurrency($('[data-cart="total_harga"]').data('total')));

      if (subdistrict) {
        var totalWeight = 0;

        $('[data-product]').each(function () {
          var product = $(this).data('product');
          var berat = parseFloat(product.berat, 10) || 0;
          var qty = parseFloat($(this).data('qty'), 10) || 0;

          totalWeight += (berat * qty);
        });

        $('input[name="shipping[weight]"]').val(totalWeight);

        $.ajax({
          url: '{{ route('template.ajax.shipping.cost', $domain) }}?weight=' + totalWeight + '&subdistrict_id=' + subdistrict,
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
                html += '<option value="' + value.name + '::' + value.service + '" data-name="' + value.name + '" data-code="' + value.code + '" data-service="' + value.service + '" data-price="' + value.price + '" data-etd="' + (value.etd || '') + '">' + value.label + (value.etd ? ' (' + value.etd + ')' : '') + '</option>';
              });

              $('[data-shipping="courier_service"]').html(html);

              if (oldShippingServiceValue) {
                $('[data-shipping="courier_service"]').val(oldValue).trigger('change');
                oldShippingServiceValue = null;
              } else {
                var firstVal = $('[data-shipping="courier_service"]').find('option:first').val();

                if (firstVal) {
                  $('[data-shipping="courier_service"]').val(firstVal).trigger('change');
                }
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


      $('[data-cart="total_shipping"]').text(price ? $.getFormattedCurrency(price) : '-');
      $('[data-cart="total_harga"]').text($.getFormattedCurrency(parseInt($('[data-cart="total_harga"]').data('total') ,10) + price));
      $('input[name="shipping[service]"]').val($option.data('service'));
      $('input[name="shipping[code]"]').val($option.data('code'));
      $('input[name="shipping[name]"]').val($option.data('name'));
      $('input[name="shipping[etd]"]').val($option.data('etd'));
      $('input[name="shipping[price]"]').val(price);
    });

    $('[data-shipping="province"]').trigger('change');
  });
</script>
@endpush
