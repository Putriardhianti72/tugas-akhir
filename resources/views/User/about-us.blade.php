@extends('Layouts.user.main')

@section('class-body', 'blog')
@section('id-body', 'contact')

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
                <span>About Us</span>
              </a>
            </li>
          </ol>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 onecol">
          <section id="main" class="mb-4">
            <div class="page-home">
              <h1 class="text-center title-page">About Us</h1>
              <div class="row-inhert mb-4 pb-3">
                 <p class="text-intro text-center">Selleria - PT. Dobel Network Internasional adalah sebuah perusahaan Network Marketing Karya Anak Bangsa. Kita berusaha untuk bekerjasama dengan semua kalangan, untuk menemukan talenta-talenta luar biasa dari anak bangsa. Dimana proyek kita tidak hanya sekedar meningkatkan income dan penghasilan semua member/anggota akan tetapu juga mengasah talenta-talenta luar biasa untuk menjadi pemimpin bangsa ke depannya.
                </p>
                  <p class="text-intro text-center">PT Dobel ingin menjadi salah satu cahaya lilin di antara ribuan lilin pencerahan buat Bangsa Indonesia. Program People Building yang kita bentuk dengan pelatihan-pelatihan yang terstuktur dan terarah akan mencetak ribuan dan jutaan marketer handal dengan jiwa dan akhlak mulia. - Berlian akan mengkilap ketika sudah mengalami banyak gosokan, Manusia akan menjadi Manusia Berlian ketika sudah mengatasi Ribuan Gosokan masalah kehidupan-
                </p>

              </div>

              <div class="mb-4 pb-3">
                <div class="header-contact">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="item d-flex">
                                <div class="item-left">
                                    <div class="icon">
                                        <i class="zmdi zmdi-email"></i>
                                    </div>
                                </div>
                                <div class="item-right d-flex">
                                    <div class="title">Email:</div>
                                    <div class="contact-content">
                                        <a href="mailto:dobelnetwork@gmail.com">dobelnetwork@gmail.com</a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="item d-flex">
                                <div class="item-left">
                                    <div class="icon">
                                        <i class="zmdi zmdi-home"></i>
                                    </div>
                                </div>
                                <div class="item-right d-flex">
                                    <div class="title">Address:</div>
                                    <div class="contact-content">
                                        Solo Paragon Mall & Resident Lantai M1 <br>Surakarta Jawa Tengah
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="item d-flex justify-content-end  last">
                                <div class="item-left">
                                    <div class="icon">
                                        <i class="zmdi zmdi-phone"></i>
                                    </div>
                                </div>
                                <div class="item-right d-flex">
                                    <div class="title">Hotline:</div>
                                    <div class="contact-content">
                                        0271-736773
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="mb-4">
                <div class="contact-map">
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1143906325387!2d110.8077081138552!3d-7.562505376779768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a15ca78a40b6b%3A0xb614b188282e15b5!2sSolo%20Paragon%20Mall!5e0!3m2!1sen!2sid!4v1658476736376!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
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


