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
                <span>Service</span>
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


