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
          <section id="main">
            <div class="page-home">

                    <h1 class="text-center title-page">Contact Us</h1>
                    <div class="row-inhert">
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
                        <div class="contact-map">
                            <div id="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3785754726428!2d105.78134315594316!3d21.01753304734255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454ab43c0c4db%3A0xdb6effebd6991106!2sKeangnam+Hanoi+Landmark+Tower!5e0!3m2!1svi!2s!4v1530175498947" allowfullscreen=""></iframe>
                            </div>
                        </div>
                        <div class="input-contact">
                            <p class="text-intro text-center">“Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum
                                auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit
                                amet nibh vultate cursus a sit amet mauris. Proin gravida nibh vel velit auctor aliquet.”
                            </p>

                            <p class="icon text-center">
                                <a href="#">
                                    <img src="img/other/contact_mess.png" alt="img">
                                </a>
                            </p>


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


