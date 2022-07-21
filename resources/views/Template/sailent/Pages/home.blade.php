@extends('Template.sailent.Layouts.main')

@section('content')

  <!-- Hero
  ================================================== -->
    <section>
      <div id="hero-section" class="landing-hero" data-stellar-background-ratio="0">
        <div class="hero-content">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">

                <div class="hero-text">
                  <div class="herolider">
                    <ul class="caption-slides">

                      <li class="caption">
                        <h1>PROFLAVO NANO PROPOLIS</h1>
                        <div class="div-line"></div>
                        <p class="hero">Propolis dengan Nano Technology</p>
                      </li>

                      <li class="caption">
                        <h1>PROFLAVO</h1>
                        <div class="div-line"></div>
                        <p class="hero">Membantu Menjaga Imun Anda</p>
                      </li>

                    </ul>
                  </div> <!-- end herolider -->
                </div> <!-- end hero-text -->

                <div class="hero-btn">
                  <a href="#landing-offer" class="btn btn-clean">Read more</a>
                </div> <!-- end hero-btn -->

              </div> <!-- end col-md-6 -->
            </div> <!-- end row -->
          </div> <!-- End container -->
        </div> <!-- End hero-content -->
      </div> <!-- End hero-section -->
    </section>
    <!-- End hero section -->

    <!-- Offer
    ================================================== -->
    <section>
      <div id="landing-offer" class="pad-sec">
        <div class="container">

          <div class="title-section big-title-sec animated out" data-animation="fadeInUp" data-delay="0">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2 class="big-title">Cairan Suplemen dari Lebah Madu Tropis Pilihan</h2>
<!--                <h1 class="big-subtitle">Cairan Suplemen dari Lebah Madu Tropis Pilihan</h1>-->
                <hr>
                <p class="about-text">Sejak 300 SM, propolis telah digunakan sebagai makanan dan sebagai obat yang bermanfaat untuk kesehatan secara keseluruhan. Proflavo diolah menggunakan technology terbaru yaitu Nano sehingga dalam satu tetes Proflavo setara dengan dua tetes propolis biasa. Proflavo merupakan propolis yang tidak mengandung alcohol sehingga halal untuk dikonsumsi.</p>

                <br><br>
                <button type="button" class="btn btn-lg btn-primary" data-action="add-to-cart" data-code-product="{{ $product['codeProduct'] ?? '' }}">Beli Sekarang</button>
              </div>
            </div> <!-- End row -->
          </div> <!-- end title-section -->

          <div class="offer-boxes">

            <div class="row">
            <div class="col-sm-4">
              <div class="offer-post text-center animated out" data-animation="fadeInLeft" data-delay="0">
                <div class="offer-icon">
                  <span class="icon-desktop"></span>
                </div>
                <h4>BPOM</h4>
                <p>Proflavo sudah BPOM dengan nomor TR182616191</p>
              </div> <!-- End offer-post -->
            </div> <!-- End col-sm-4 -->

            <div class="col-sm-4">
              <div class="offer-post text-center animated out" data-animation="fadeInUp" data-delay="0">
                <div class="offer-icon">
                  <span class="icon-piechart"></span>
                </div>
                <h4>Branding</h4>
                <p>Jernih, Bebas dari wax</p>
              </div> <!-- End offer-post -->
            </div> <!-- End col-sm-4 -->

            <div class="col-sm-4">
              <div class="offer-post text-center animated out" data-animation="fadeInRight" data-delay="0">
                <div class="offer-icon">
                  <span class="icon-lifesaver"></span>
                </div>
                <h4>Halal</h4>
                <p>Tidak mengandung alcohol sehigga halal untuk dikonsumsi</p>
              </div> <!-- End offer-post -->
            </div> <!-- End col-sm-4 -->

            </div> <!-- End row -->

          </div> <!-- End offer-boxes -->
        </div> <!-- End container -->
      </div> <!-- End landing-offer-section -->
    </section>
    <!-- End offer section -->

    <section>
      <div class="sep-section"></div>
    </section>

    <!-- Features services
    ================================================== -->
    <section>
      <div id="features-section" class="pad-sec">
        <div class="container">
          <div class="title-section text-center animated out" data-animation="fadeInUp" data-delay="0">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2>What we do?</h2>
                <hr>
                <p>Manfaat Proflavo Nano Propolis</p>
              </div> <!-- edn col-sm-8 -->
            </div> <!-- End row -->
          </div> <!-- end title-section -->
          <div class="row">
            <div class="col-md-3 without-padding">
              <div class="left-features-services">
                <ul class="features-list">
                  <!-- feature -->
                  <li>
                    <div class="left-features-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
<!--                        <h6>Mobile App</h6>-->
                        <p>Sebagai stimulator sistem kekebalan tubuh (imuno stimulator)</p>
                      </div> <!-- end features-box-content -->
                    </div> <!-- end left-features-box -->
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="left-features-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
<!--                        <h6>Web design</h6>-->
                        <p>Sebagai antijamur, antibakteri, dan antivirus</p>
                      </div> <!-- end features-box-content -->
                    </div> <!-- end left-features-box -->
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="left-features-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        <p>Antioksidan, melawan radikal bebas</p>
                      </div> <!-- end features-box-content -->
                    </div> <!-- end left-features-box -->
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="left-features-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        <p>Antitumor, menekan pertumbuhan sel tak terkendali</p>
                      </div> <!-- end features-box-content -->
                    </div> <!-- end left-features-box -->
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="left-features-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        <p>Membantu proses regenerasi sel hati</p>
                      </div> <!-- end features-box-content -->
                    </div> <!-- end left-features-box -->
                  </li>
                </ul> <!-- end features-list -->
              </div> <!-- end left-features-service -->
            </div><!--  end col-md-3 -->

            <div class="col-md-6">
              <div class="features-image animated out" data-animation="fadeInUp" data-delay="0">
                <img src="{{ asset('assets/sailent/images/hero-bg/1.png') }}" alt="" width="70%">
              </div> <!-- end features-image -->
            </div> <!-- end col-md-6 -->

            <div class="col-md-3 without-padding">
              <div class="right-features-services">
                <ul class="features-list">
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        <p>Membantu penyembuhan diabetes melitus (kencing manis)</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        {{-- <h6>Video</h6> --}}
                        <p>Membantu mengatasi gangguan pencernaan dan pernafasan</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        {{-- <h6>Photography</h6> --}}
                        <p>Membantu mengatasi penyakit jantung dan pembuluh darah</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        {{-- <h6>Marketing</h6> --}}
                        <p>Membantu untuk menurunkan kadar kolestrol jahat dan trigliserida</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"></span>
                      <div class="features-box-content">
                        {{-- <h6>Support</h6> --}}
                        <p>Membantu penyembuhan luka dengan kemampuannya meredakan inflamasi (radang)</p>
                      </div>
                    </div>
                  </li>
                </ul> <!-- end features-list -->
              </div>
            </div> <!-- end col-md-3 -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </div>
    </section>
    <!-- End features-section -->

    <!-- Video section
    ================================================== -->
    <section>
      <div id="video-section" data-stellar-background-ratio="0">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="video-section-content text-center">
                <a href="http://vimeo.com/channels/staffpicks/116829150" class="video-pop-up"><i class="fa fa-play"></i></a>
                <div class="video-head">Introducing Video</div>
                <div class="video-sub-heading">Check out our video presentation</div>
              </div>
            </div> <!-- end col-sm-6 -->
          </div> <!-- end row -->
        </div> <!-- end container -->
      </div>
    </section>
    <!-- End Video section -->






    <section>
      <div class="sep-section"></div>
    </section>

    <!-- Price section-1
    ================================================== -->
    <section>
      <div id="price-section-1" class="pad-sec">
        <div class="container">
          <div class="row">

            <div class="col-sm-7 img-creative-left text-center animated out" data-animation="fadeInLeft" data-delay="0">
              <figure>
                <img src="{{ asset('assets/sailent/images/hero-bg/1.png') }}" alt="" width="50%">
              </figure>
            </div> <!-- End col-sm-8 -->

            <div class="col-sm-5 creative-content-right animated out" data-animation="fadeInRight" data-delay="0">
              <div class="section_header">
                <h2>Proflavo Nano Propolis</h2>
              </div> <!-- End section_header -->

                <p> Propolis dengan nano teknologi. Untuk membantu menjaga imun Anda</p>

                <br>
                <br>
                 <h2>Rp. {{ $product['harga'] ?? '' }}</h2>
              <div class="view-more">
                <button type="button" class="btn btn-lg btn-primary" data-action="add-to-cart" data-code-product="{{ $product['codeProduct'] ?? '' }}">Beli Sekarang</button>
              </div>
            </div> <!-- End feature-content -->

          </div> <!-- End row -->
        </div> <!-- End container -->
      </div> <!-- End feature-section -->
    </section>
    <!-- End Creative section-1 -->

    <section>
      <div class="sep-section"></div>
    </section>



    <!-- Subscribe-section
    ================================================== -->
    <section>
      <div id="subscribe-section">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
               <!-- end col-sm-6 -->
          </div> <!-- end row -->
        </div> <!-- end container -->
      </div> <!-- end subscribe-section -->
    </section>
    <!-- End subscribe section -->

    <section>
      <div class="sep-section"></div>
    </section>

      <!-- Testimonial
      ================================================== -->
      <section>
        <div id="testimonials-section">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">

                <div class="testimonials-carousel">

                  <ul class="testimonials-slider">

                    <!-- Testimonial -->
                    <li>
                      <img src="{{ asset('assets/sailent/images/temp/client-photo.jpg') }}" alt="">
                      <p>Sebelumnya saya setelah bangun tidur kepala pusing ngliyeng dan kaki sering kesemutan. Alhamdulillah setelah 3 hari konsumsi Proflavo ngliyeng dan kesemutan kaki saya sudah hilang. Sekarang rutin konsumsi Proflavo Propolis</p>
                      <div class="testimonials-author"> Mbah Magi - Semarang </div>
                    </li>

                    <!-- Testimonial -->
                    <li>
                      <img src="{{ asset('assets/sailent/images/temp/client-photo.jpg') }}" alt="">
                      <p>Saya sebelumnya pegel kaki, ngantuk tidak bisa dihindari. Lalu saya dikenalkan Proflavo dan mulai mengonsumsinya. Setelah minum Proflavo alhamdulillah sampai sekarang tidak ada keluhan dan rasa pegel di kaki sudah tidak ada.</a>.</p>
                      <div class="testimonials-author">Suwarno - Karanganyar</div>
                    </li>

                    <!-- Testimonial -->
                    <li>
                      <img src="{{ asset('assets/sailent/images/temp/client-photo.jpg') }}" alt="">
                      <p>Saya mau berbagi pengalaman saya pak. Anak saya kena amandel saya kasih proflavo 3 tetes dilarutkan dalam air sepertinya tidak begitu ngefek… besoknya saya teteskan langsung ke amandelnya katanya panas terus langsung adem dan berangsur membaik. Alhamdulillah</a>.</p>
                      <div class="testimonials-author">Mariska - Jogja</div>
                    </li>

                  </ul>

                  <div class="tc-arrows">
                     <div class="tc-arrow-left"></div>
                     <div class="tc-arrow-right"></div>
                  </div> <!-- end tc-arrows -->
                </div> <!-- end testimonials-carousel -->

              </div> <!-- end col-md-8 -->
            </div> <!-- end row -->
          </div> <!-- end container -->
        </div>
      </section>
      <!-- end testimonial section -->

    <section>
      <div class="sep-section"></div>
    </section>

    <!-- Google map
    ================================================== -->
    <section>
      <div id="module-maps">
        <div id="map"></div>
      </div>
    </section>
    <!-- End Google map -->

    <!-- Contact-section
    ================================================== -->
    <section>
      <div id="contact-section" >

        <div class="container">

          <div class="title-section text-center animated out" data-animation="fadeInUp" data-delay="0">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <h2>Contact</h2>
                  <hr>
                  <p>Hubungi kami</p>
                </div>
              </div><br><br>
              <div class="row md-5">
                <div class="col-sm-4">
                  <a href="#"><i class="pe-7s-map-marker"></i>Ruko Sibedil No. B6-7 Jl Solo Karanganyar Km7 Karanganyar</a>
                </div> <!-- End col-sm-4 -->
                <div class="col-sm-4">
                  <a href="tel:+123000456"><i class="pe-7s-phone"></i>0271-736773</a>
                </div>
                <div class="col-sm-4">
                  <a href="mailto:dobelnetwork@gmail.com"><i class="pe-7s-mail"></i>dobelnetwork@gmail.com</a>
                </div>
              </div> <!-- End row -->
          </div> <!-- end title-section -->
        </div> <!-- end container -->

      </div> <!-- End contact-section -->
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
    $(document).on('click', '[data-action="add-to-cart"]', function (e) {
      e.preventDefault();

      var $this = $(this);
      var data = {
        codeProduct: $this.data('code-product'),
        domain: '{{ env('SAILENT_DOMAIN') }}',
        qty: 1,
        _token: '{{ csrf_token() }}'
      }

      $.ajax({
        url: '{{ route('template.carts.store', $domain) }}',
        method: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
          if (res.status === 'success') {
            window.location.href = '{{ route('template.carts.index', $domain) }}'
          }
        },
        error: function (err) {
          console.log(err)
        }
      });
    });

    $(document).on('change', '[data-shipping="province"]', function () {
      var val = $(this).val();

      var $city = $('[data-shipping="city"]');

      $city.val('').change();
      $city.html('');

      $.ajax({
        url: '{{ url($domain . '/ajax/shipping/city') }}?province=' + val,
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
          url: '{{ url($domain . '/ajax/shipping/subdistrict') }}?city=' + val,
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

    $('[data-shipping="province"]').trigger('change');
  });
</script>
@endpush
