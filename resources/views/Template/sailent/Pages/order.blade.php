@extends('Template.sailent.Layouts.main')

@section('body-class', 'page-order')

@section('content')
<section>
  <div id="order-section">
    <div class="container">
      <div class="row">
        <div class="col-xs-5"></div>
        <div class="col-xs-5">
          <h4>Invoice No: {{ $order->invoice_no }}</h4>
        </div>
        <div class="col-xs-2 text-right">
          <h4>{{ $order->status_text }}</h4>
        </div>
      </div>

      <hr>

      {{-- <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary">Buy Again</button>
        </div>
      </div>

      <hr> --}}



      @if($order->status == \App\Models\RetailOrder::STATUS_PENDING)
        <div class="row mb-4">
          <div class="col-xs-12">
            <div class="form-group row">
              <div class="col-xs-12 col-md-12">
                <div class="card bg-warning text-white" style="padding: 1rem 1.5rem 1.5rem;">
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
        <div class="col-xs-7">
          <h4>Delivery Address</h4>

          <h5>{{ $order->customer->name }}</h5>
          <div>
            {{ $order->customer->alamat }}
          </div>
          <div>
            {{ $order->customer->subdistrict_name }},
            {{ $order->customer->city_name }},
            {{ $order->customer->province_name }}
          </div>
        </div>
        <div class="col-xs-5 text-right">
          {{ $order->shipping->name }}
          <br>
          ({{ $order->shipping->weight }} gram)
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="panel-title">
                  <div class="row">
                    <div class="col-xs-6">
                      <h4>Products</h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row cart-row">
                  <div class="col-xs-2">
                    <img class="img-responsive" src="https://via.placeholder.com/200x200">
                  </div>
                  <div class="col-xs-6">
                    <h4 class="product-name"><strong>{{ $order->product->product_name }}</strong></h4><h4 class="truncate-text"><small>{{ $order->product->desc }}</small></h4>
                  </div>
                  <div class="col-xs-4">
                    <div class="col-xs-12 text-right">
                      <h6><strong>{{ $order->product->price }} <span class="text-muted">x</span></strong> <strong>{{ $order->product->qty }}</strong></h6>
                    </div>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="text-center">
                    <div class="col-xs-9">
                      <h5 class="text-right">Shipping</h5>
                    </div>
                    <div class="col-xs-3">
                      <h5 class="text-right" data-cart="total_shipping">{{ $order->shipping->price }}</h5>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="text-center">
                    <div class="col-xs-9">
                      <h5 class="text-right">Total</h5>
                    </div>
                    <div class="col-xs-3">
                      <h5 class="text-right">{{ $order->shipping->price + $order->product->price }}</h5>
                    </div>
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
