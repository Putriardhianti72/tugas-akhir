@extends('Template.koppee.Layouts.main')

@section('body-class', 'page-order')

@section('content')
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 200px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Order</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="{{ route('template.home', $domain) }}">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Order</p>
        </div>
    </div>
</div>


<div id="order-section" class="container py-5" style="font-size: 0.8em;">
  <div class="row d-flex justify-content-center">
    <div class="col col-8">
      <div class="row">
        <div class="col col-8">
          <h6>Invoice No: {{ $order->invoice_no }}</h6>
        </div>
        <div class="col col-4 text-right">
          <h6>
            <span>Status: </span>
            @if($order->status == \App\Models\RetailOrder::STATUS_PENDING)
            <span class="badge badge-pill badge-secondary">{{ $order->status_text }}</span>
            @elseif($order->status == \App\Models\RetailOrder::STATUS_PAID)
            <span class="badge badge-pill badge-info">{{ $order->status_text }}</span>
            @elseif($order->status == \App\Models\RetailOrder::STATUS_DELIVERY)
            <span class="badge badge-pill badge-primary">{{ $order->status_text }}</span>
            @elseif($order->status == \App\Models\RetailOrder::STATUS_COMPLETED)
            <span class="badge badge-pill badge-success">{{ $order->status_text }}</span>
            @elseif($order->status == \App\Models\RetailOrder::STATUS_CANCELLED)
            <span class="badge badge-pill badge-danger">{{ $order->status_text }}</span>
            @endif
          </h6>
        </div>
      </div>

      <hr>

      @if($order->status == \App\Models\RetailOrder::STATUS_PENDING)
        <div class="row mb-4">
          <div class="col col-12">
            <div class="form-group row">
              <div class="col col-12 col-md-12">
                <div class="card bg-warning text-white">
                  <div class="card-body d-flex align-items-center justify-content-between" style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                      <h5 class="subtitle-page">Pembayaran</h5>
                      <label>Lanjutkan pembayaran untuk menyelesaikan order.</label>
                    </div>
                    <form action="{{ route('template.orders.pay', ['domain' => $domain, 'id' => $order->id]) }}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-primary btn-sm">Bayar Sekarang</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif

      <hr>

      <div class="row">
        <div class="col col-7">
          <h6>Delivery Address</h6>

          <div>{{ $order->customer->name }}</div>
          <div>
            {{ $order->customer->alamat }}
          </div>
          <div>
            {{ $order->customer->subdistrict_name }},
            {{ $order->customer->city_name }},
            {{ $order->customer->province_name }}
          </div>
        </div>
        <div class="col col-5 text-right">
          {{ $order->shipping->name }}
          <br>
          ({{ $order->shipping->weight }} gram)
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col col-12">
            <div class="card card-info">
              <div class="card-header bg-transparent">
                <div class="card-title mb-0">
                  <div class="row">
                    <div class="col col-6">
                      <h6 class="mb-0">Products</h6>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row cart-row">
                  <div class="col col-2">
                    <img class="img-responsive img-fluid" src="{{ asset('assets/sailent/images/hero-bg/1.png') }}">
                  </div>
                  <div class="col col-6">
                    <div class="product-name"><strong>{{ $order->product->product_name }}</strong></div><div class="truncate-text"><small>{{ $order->product->desc }}</small></div>
                  </div>
                  <div class="col col-4">
                    <div class="text-right">
                      <div>{{ format_currency($order->product->price) }} <span class="text-muted">x</span>{{ $order->product->qty }}</div>
                    </div>
                  </div>
                </div>
                <hr>

                <div class="row text-center">
                  <div class="col col-9 pr-0">
                    <h5 class="text-right">Shipping</h5>
                  </div>
                  <div class="col col-3 pl-0">
                    <h5 class="text-right" data-cart="total_shipping">{{ format_currency($order->shipping->price) }}</h5>
                  </div>
                </div>
                <div class="row text-center">
                  <div class="col col-9 pr-0">
                    <h5 class="text-right">Total</h5>
                  </div>
                  <div class="col col-3 pl-0">
                    <h5 class="text-right font-weight-bold">{{ format_currency($order->shipping->price + $order->product->price) }}</h5>
                  </div>
                </div>

              </div>
            </div>

        </div>
      </div>
    </div>
  </div>
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

      $('[data-cart="total_harga"]').text(total).data('total', total);
    });


    var oldCityValue = '{{ old('customer[city_id]') }}'

    $(document).on('change', '[data-shipping="province"]', function () {
      var val = $(this).val();
      $('input[name="customer[province_name]"]').val($(this).find('option:selected').data('province') || '');

      var $city = $('[data-shipping="city"]');

      $city.val('').change();
      $city.html('');

      $.ajax({
        url: '{{ url($domain . '/ajax/shipping/city') }}?province=' + val,
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
      console.log($(this).find('option:selected').data('city') || '')
      $('input[name="customer[city_name]"]').val($(this).find('option:selected').data('city-name') || '');

      if (val) {
        var $subdistrict = $('[data-shipping="subdistrict"]');

        $subdistrict.val('').change();
        $subdistrict.html('');

        $.ajax({
          url: '{{ url($domain . '/ajax/shipping/subdistrict') }}?city=' + val,
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
        $('[data-shipping="subdistrict"]').val('').change()
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
      $('[data-cart="total_harga"]').text($('[data-cart="total_harga"]').data('total') || '-');

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
          url: '{{ url($domain . '/ajax/shipping/cost') }}?weight=' + totalWeight + '&subdistrict_id=' + subdistrict,
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

      $('[data-cart="total_shipping"]').text(price);
      $('[data-cart="total_harga"]').text((parseInt($('[data-cart="total_harga"]').data('total') ,10) + price) || '-');
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
