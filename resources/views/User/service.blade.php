@extends('Layouts.user.main')

@section('class-body', 'product-cart checkout-cart blog')
@push('css')
<style type="text/css">
  .card-group-service .card-img-top{
    display: flex;
    justify-content: center;
    padding: 2rem 1rem 1rem;
  }
</style>
@endpush
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
                <span>Services</span>
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
            <h1 class="text-center title-page">Mengapa Memilih Kami?</h1>
          <div class="card-group card-group-service">
            <div class="card">
              <div class="card-img-top">
                <img src="{{ asset('/user/img/icons/1.png') }}" alt="Card image cap" width="30%">
              </div>
              <div class="card-body">
                <h5 class=" card-title">Marketing Plan Aman & Legal</h5>
                <p class=" card-text">Perijinan Perusahaan sudah Lengkap & Marketing Plan Terverifikasi Pemerintah</p>
              </div>
            </div>
            <div class="card">
              <div class="card-img-top">
                <img src="{{ asset('/user/img/icons/2.png') }}" alt="Card image cap" width="30%">
              </div>
              <div class="card-body">
                <h5 class="card-title">PRODUK UNGGULAN</h5>
                <p class="card-text">Semua Produk telah Teruji Dan Berijin Lengkap & Merupakan Kebutuhan Masyarakat</p>
              </div>
            </div>
            <div class="card">
              <div class="card-img-top">
                <img src="{{ asset('/user/img/icons/4.png') }}" alt="Card image cap" width="30%">
              </div>
              <div class="card-body">
                <h5 class="card-title">SUPPORT SYSTEM</h5>
                <p class="card-text">Support Perusahaan & Leader yang Handal. Jaminan Kemudahan dan Kecepatan Hasil Bisnis</p>
              </div>
            </div>
             <div class="card">
              <div class="card-img-top">
                <img src="{{ asset('/user/img/icons/5.png') }}" alt="Card image cap" width="30%">
              </div>
              <div class="card-body">
                <h5 class="card-title">IT HANDAL</h5>
                <p class="card-text">Dukuangan IT yang Handal memberikan Rasa Aman dan Kemudahan Akses</p>
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


