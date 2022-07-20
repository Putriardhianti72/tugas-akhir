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
<!--                <img src={{ asset('assets/sailent/images/temp/woman.jpg') }}" alt="">-->
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
                      <span class="iconbox"><i class="icon-video"></i></span>
                      <div class="features-box-content">
                        <h6>Video</h6>
                        <p>Mauris eros tortor, tristique cursus porttitor et, luctus sed urna</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"><i class="icon-camera"></i></span>
                      <div class="features-box-content">
                        <h6>Photography</h6>
                        <p>Mauris eros tortor, tristique cursus porttitor et, luctus sed urna.</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"><i class="icon-presentation"></i></span>
                      <div class="features-box-content">
                        <h6>Marketing</h6>
                        <p>Mauris eros tortor, tristique cursus porttitor et, luctus sed urna.</p>
                      </div>
                    </div>
                  </li>
                  <!-- feature -->
                  <li>
                    <div class="right-features-box animated out" data-animation="fadeInRight" data-delay="0">
                      <span class="iconbox"><i class="fa fa-life-ring"></i></span>
                      <div class="features-box-content">
                        <h6>Support</h6>
                        <p>Mauris eros tortor, tristique cursus porttitor et, luctus sed urna.</p>
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

    <!-- Team
    ================================================== -->
    <section>
      <div id="team-section" class="pad-sec">
        <div class="container">
          <div class="title-section animated out" data-animation="fadeInUp" data-delay="0">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2>Our awesome team</h2>
                <hr>
                <p>Seamlessly restore client-focused potentialities rather than functional strategic theme areas. Credibly e-enable value-added portals with clicks-and-mortar initiatives.</p>
              </div>
            </div> <!-- End row -->
          </div> <!-- end title-section -->

          <div class="team-members">
            <div class="row">

              <!-- member-team -->
              <div class="col-sm-4">
                <div class="member-team animated out" data-animation="fadeInLeft" data-delay="0">
                  <img src={{ asset('assets/sailent/images/team/m1.jpg') }}" alt="">
                  <div class="magnifier">
                    <div class="magnifier-inner">
                      <h3>MICHAEL ROOF</h3>
                      <p>Co_founder &amp; Designer</p>
                      <p>We’ll etch your brand onto tangible objects: business cards, ads, stickers, brochures, you name it. You won’t see business cards, ads, stickers, brochures anything until we’re done drooling at the result.</p>
                      <ul class="social-icons">

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Facebook" href="#" data-original-title="" title=""><i class="fa fa-facebook"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Twitter" href="#" data-original-title="" title=""><i class="fa fa-twitter"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Google Plus" href="#" data-original-title="" title=""><i class="fa fa-google-plus"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Skype" href="#" data-original-title="" title=""><i class="fa fa-skype"></i></a></li>

                      </ul>
                    </div> <!-- End magnifier-inner -->
                  </div> <!-- End magnifier -->
                </div> <!-- End member-team -->
              </div> <!-- End col-sm-4 -->

              <!-- member-team -->
              <div class="col-sm-4">
                <div class="member-team animated out" data-animation="fadeInUp" data-delay="0">
                  <img src={{ asset('assets/sailent/images/team/m2.jpg') }}" alt="">
                  <div class="magnifier">
                    <div class="magnifier-inner">
                      <h3>CHARLES WHITE</h3>
                      <p>Co_founder &amp; Designer</p>
                      <p>We’ll etch your brand onto tangible objects: business cards, ads, stickers, brochures, you name it. You won’t see business cards, ads, stickers, brochures anything until we’re done drooling at the result.</p>
                      <ul class="social-icons">

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Facebook" href="#" data-original-title="" title=""><i class="fa fa-facebook"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Twitter" href="#" data-original-title="" title=""><i class="fa fa-twitter"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Google Plus" href="#" data-original-title="" title=""><i class="fa fa-google-plus"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Skype" href="#" data-original-title="" title=""><i class="fa fa-skype"></i></a></li>

                      </ul>
                    </div> <!-- End magnifier-inner -->
                  </div> <!-- End magnifier -->
                </div> <!-- End member-team -->
              </div> <!-- End col-sm-4 -->

              <!-- member-team -->
              <div class="col-sm-4">
                <div class="member-team animated out" data-animation="fadeInRight" data-delay="0">
                  <img src={{ asset('assets/sailent/images/team/m3.jpg') }}" alt="">
                  <div class="magnifier">
                    <div class="magnifier-inner">
                      <h3>MARTIN CAMBRIGE</h3>
                      <p>Head Support</p>
                      <p>We’ll etch your brand onto tangible objects: business cards, ads, stickers, brochures, you name it. You won’t see business cards, ads, stickers, brochures anything until we’re done drooling at the result.</p>
                      <ul class="social-icons">

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Facebook" href="#" data-original-title="" title=""><i class="fa fa-facebook"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Twitter" href="#" data-original-title="" title=""><i class="fa fa-twitter"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Google Plus" href="#" data-original-title="" title=""><i class="fa fa-google-plus"></i></a></li>

                        <li><a data-rel="tooltip" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" data-title="Skype" href="#" data-original-title="" title=""><i class="fa fa-skype"></i></a></li>

                      </ul>
                    </div> <!-- End magnifier-inner -->
                  </div> <!-- End magnifier -->
                </div> <!-- End member-team -->
              </div> <!-- End col-sm-4 -->

            </div>
          </div> <!-- End team-members -->
        </div> <!-- End container -->
      </div> <!-- End team-section -->
    </section>
    <!-- End team section -->

    <!-- About Team
    ================================================== -->
    <section>
      <div id="about-team">
        <div class="container">
            <div class="row">

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="title-section">
                  <h3>Our team skills</h3>
                </div>
                <p>Sit ad etiam dissentias, viderer intellegebat usu et, per aliquam delectus ut. In inermis suavitate tincidunt quo, habeo lorem quis nulla eget, dictum pretium magna. Praesent id metus mattis tellus consectetur posuere. Aenean vel enim ut massa luctus efficitur a nec magna.</p>
              </div> <!-- end col-md-6 -->

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="progress-bars">

                  <!-- skillbar -->
                  <div class="p-bar">
                    <!-- meta -->
                    <div class="progress-meta">
                      <h6 class="progress-title">photoshop</h6>
                      <h6 class="progress-value">75%</h6>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" aria-valuenow="75" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                  </div> <!-- end p-bar -->

                  <!-- skillbar -->
                  <div class="p-bar">
                    <!-- meta -->
                    <div class="progress-meta">
                      <h6 class="progress-title">html</h6>
                      <h6 class="progress-value">95%</h6>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" aria-valuenow="95" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                  </div> <!-- end p-bar -->

                  <!-- skillbar -->
                  <div class="p-bar">
                    <!-- meta -->
                    <div class="progress-meta">
                      <h6 class="progress-title">css</h6>
                      <h6 class="progress-value">85%</h6>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" aria-valuenow="85" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                  </div> <!-- end p-bar -->

                  <!-- skillbar -->
                  <div class="p-bar">
                    <!-- meta -->
                    <div class="progress-meta">
                      <h6 class="progress-title">jquery</h6>
                      <h6 class="progress-value">73%</h6>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" aria-valuenow="73" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                  </div> <!-- end p-bar -->

                </div> <!-- end skills-bars -->
              </div> <!-- end col-md-6 -->
            </div> <!-- end row -->
        </div>
      </div>
    </section>
    <!-- End About Team -->

    <!-- Banner-Services
    ================================================== -->
    <section>
      <div id="banner-services" data-stellar-background-ratio="0">
        <div class="container">
          <div class="row">

            <div class="col-sm-6">
              <div class="banner-content animated out" data-animation="fadeInUp" data-delay="0">
                <h3 class="banner-heading">Looking for exclusive digital services?</h3>
                <div class="banner-decription">
                  Proin fringilla augue at maximus vestibulum. Nam pulvinar vitae neque et porttitor. Integer non dapibus diam, ac eleifend lectus.
                </div> <!-- end banner-decription -->
                <div>
                  <a href="contact.html" class="btn btn-sm btn-clean">Lets talk</a>
                </div>
              </div> <!-- end banner-content -->
            </div> <!-- end col-sm-6 -->

            <div class="col-sm-6">
              <div class="banner-image animated out" data-animation="fadeInUp" data-delay="0">
                <img src={{ asset('assets/sailent/images/temp/banner-img.png') }}" alt="">
              </div> <!-- end banner-image -->
            </div> <!-- end col-sm-6 -->

          </div> <!-- end row -->
        </div> <!-- end container -->
      </div>
    </section>
    <!-- End Banner services section -->

    <!-- Features App 2
    ================================================== -->
    <section>
      <div id="features-app-section-2" class="pad-sec">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 features-app-content-left animated out" data-animation="fadeInLeft" data-delay="0">
              <div class="section_header">
                <h2>Simple. Intuitive. <span>Powerful.</span></h2>
              </div> <!-- End section_header -->
                <p> Lorem ipsum <span>dolor</span> sit amet, consectetur adipisicing elit.Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                <ul class="features-app-list">

                  <!-- feature -->
                  <li>
                    <div class="feature-app-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <div class="app-feature-icon pull-left"><span class="pe-7s-graph"></span></div>
                      <div class="feature-app-box-content">
                        <h6>Beautiful, modern design</h6>
                        <p>Mauris vehicula tortor id augue rutrum consequat ac at massa. Interdum et malesuada fames ac ante ipsum primis.</p>
                      </div>
                    </div>
                  </li>

                  <!-- feature -->
                  <li>
                    <div class="feature-app-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <div class="app-feature-icon pull-left"><span class="pe-7s-config"></span></div>
                      <div class="feature-app-box-content">
                        <h6>Easy to set up</h6>
                        <p>Phasellus consequat facilisis volutpat ma faucibus odio vitae semper. Ae volutpat lobortis.</p>
                      </div>
                    </div>
                  </li>

                  <!-- feature -->
                  <li>
                    <div class="feature-app-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <div class="app-feature-icon pull-left"><span class="pe-7s-refresh-2"></span></div>
                      <div class="feature-app-box-content">
                        <h6>Stunning flexibility</h6>
                        <p>Phasellus consequat facilisis volutpat ma faucibus odio vitae semper. Ae volutpat lobortis.</p>
                      </div>
                    </div>
                  </li>

                  <!-- feature -->
                  <li>
                    <div class="feature-app-box animated out" data-animation="fadeInLeft" data-delay="0">
                      <div class="app-feature-icon pull-left"><span class="pe-7s-lock"></span></div>
                      <div class="feature-app-box-content">
                        <h6>Reliable and Secure Platform</h6>
                        <p>Phasellus consequat facilisis volutpat ma faucibus odio vitae semper. Ae volutpat lobortis.</p>
                      </div>
                    </div>
                  </li>

                </ul>
            </div> <!-- End feature-content -->

            <div class="col-sm-5 col-sm-offset-1 text-center img-app-right animated out" data-animation="fadeInRight" data-delay="0">
              <figure>
                <img src={{ asset('assets/sailent/images/app/phone-2.png') }}" alt="">
              </figure>
            </div> <!-- End col-sm-8 -->

          </div> <!-- End row -->
        </div> <!-- End container -->
      </div> <!-- End feature-section -->
    </section>
    <!-- End Features App 2 section -->

    <section>
      <div class="sep-section"></div>
    </section>

    <!-- Creative section-1
    ================================================== -->
    <section>
      <div id="creative-section-1" class="pad-sec">
        <div class="container">
          <div class="row">

            <div class="col-sm-7 img-creative-left text-center animated out" data-animation="fadeInLeft" data-delay="0">
              <figure>
                <img src={{ asset('assets/sailent/images/temp/cover.png') }}" alt="">
              </figure>
            </div> <!-- End col-sm-8 -->

            <div class="col-sm-5 creative-content-right animated out" data-animation="fadeInRight" data-delay="0">
              <div class="section_header">
                <h2>Creative project</h2>
              </div> <!-- End section_header -->

                <p> Lorem ipsum <span>dolor</span> sit amet, consectetur adipisicing elit.Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

              <div class="view-more">
                <a href="#services-section" class="btn btn-lg btn-primary">View online</a>
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

    <!-- Screenshots
    ================================================== -->
      <section>
        <div id="screenshots-section" class="pad-sec">
          <div class="container">
           <div class="title-section text-center animated out" data-animation="fadeInUp" data-delay="0">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <h2>Screenshots gallery</h2>
                  <hr>
                  <p>Seamlessly restore client-focused potentialities rather than functional strategic theme areas.</p>
              </div>
            </div> <!-- End row -->
          </div> <!-- end title-section -->

            <div class="row">
              <div class="col-md-12">
                <div class="screenshots-carousel animated out" data-animation="fadeInUp" data-delay="0">

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/1.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/1.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/2.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/1.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/1.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/2.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/2.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/1.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->


                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/1.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/2.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/2.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/1.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/1.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/2.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                  <div class="shot">
                    <div class="screen">
                      <a class="zoom" href={{ asset('assets/sailent/images/screenshots/2.jpg') }}"><img src={{ asset('assets/sailent/images/screenshots/1.jpg') }}" alt="screenshot"></a>
                    </div> <!-- end screen -->
                  </div> <!-- end shot -->

                </div> <!-- end screenshots-carousel -->
              </div> <!-- end col-md-12 -->
            </div> <!-- end row -->
          </div><!--  end container -->
        </div>
      </section>
      <!-- End screenshots-section -->

      <!-- Clients-section
    ================================================== -->
    <section>
      <div id="clients-section" class="clients-bg" data-stellar-background-ratio="0">
        <div class="container">
          <div class="row">

             <!-- client -->
            <div class="col-xs-4 col-sm-2">
              <div class="client">
                <a href="#"><img src={{ asset('assets/sailent/images/clients/client_1.png') }}" alt=""></a>
              </div>
            </div> <!-- end col-xs-6 -->

             <!-- client -->
            <div class="col-xs-4 col-sm-2">
              <div class="client">
                <a href="#"><img src={{ asset('assets/sailent/images/clients/client_2.png') }}" alt=""></a>
              </div>
            </div> <!-- end col-xs-6 -->

             <!-- client -->
            <div class="col-xs-4 col-sm-2">
              <div class="client">
                <a href="#"><img src={{ asset('assets/sailent/images/clients/client_3.png') }}" alt=""></a>
              </div>
            </div> <!-- end col-xs-6 -->

             <!-- client -->
            <div class="col-xs-4 col-sm-2">
              <div class="client">
                <a href="#"><img src={{ asset('assets/sailent/images/clients/client_4.png') }}" alt=""></a>
              </div>
            </div> <!-- end col-xs-6 -->

             <!-- client -->
            <div class="col-xs-4 col-sm-2">
              <div class="client">
                <a href="#"><img src={{ asset('assets/sailent/images/clients/client_1.png') }}" alt=""></a>
              </div>
            </div> <!-- end col-xs-6 -->

             <!-- client -->
            <div class="col-xs-4 col-sm-2">
              <div class="client">
                <a href="#"><img src={{ asset('assets/sailent/images/clients/client_2.png') }}" alt=""></a>
              </div>
            </div> <!-- end col-xs-6 -->

          </div> <!-- End row -->
        </div> <!-- End container -->
      </div>
    </section>
    <!-- End clients-section -->

    <!-- Prices
    ================================================== -->
    <section>
      <div id="prices-section" class="pad-sec">
        <div class="container">
          <div class="title-section text-center animated out" data-animation="fadeInUp" data-delay="0">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2>Our Prices</h2>
                <hr>
                <p>Seamlessly restore client-focused potentialities rather than functional strategic theme areas.</p>
              </div>
            </div> <!-- End row -->
          </div> <!-- end title-section -->

          <div class="row">
            <div class="col-sm-4">
              <ul class="price-table animated out" data-animation="fadeInLeft" data-delay="0">
                  <li class="title-price">
                    <h3>Basic Pack</h3>
                  </li>
                  <li class="price-box">
                      <p class="price"><span class="currency">$</span>5.99</p>
                      <p class="months">per month</p>
                  </li>
                  <li><p>Full Access</p></li>
                  <li>
                      <p>5 Projects</p>
                  </li>
                  <li>
                      <p>5 GB Storage</p>
                  </li>
                  <li>
                      <p>100GB Monthly Bandwidth</p>
                  </li>
                  <li><p>Premium Support</p></li>
                  <li>
                      <p>Your domain</p>
                  </li>
                  <li>
                      <a href="#" class="btn btn-sm btn-dark">Purchase</a>
                  </li>
              </ul>
            </div> <!-- end col-sm-4 -->

            <div class="col-sm-4">
              <ul class="price-table animated out" data-animation="fadeInUp" data-delay="0">
                  <li class="title-price">
                    <h3>Basic Pack</h3>
                  </li>
                  <li class="price-box">
                      <p class="price"><span class="currency">$</span>5.99</p>
                      <p class="months">per month</p>
                  </li>
                  <li><p>Full Access</p></li>
                  <li>
                      <p>5 Projects</p>
                  </li>
                  <li>
                      <p>5 GB Storage</p>
                  </li>
                  <li>
                      <p>100GB Monthly Bandwidth</p>
                  </li>
                  <li><p>Premium Support</p></li>
                  <li>
                      <p>Your domain</p>
                  </li>
                  <li>
                      <a href="#" class="btn btn-sm btn-dark">Purchase</a>
                  </li>
              </ul>
            </div> <!-- end col-sm-4 -->

            <div class="col-sm-4">
              <ul class="price-table animated out" data-animation="fadeInRight" data-delay="0">
                  <li class="title-price">
                    <h3>Basic Pack</h3>
                  </li>
                  <li class="price-box">
                      <p class="price"><span class="currency">$</span>5.99</p>
                      <p class="months">per month</p>
                  </li>
                  <li><p>Full Access</p></li>
                  <li>
                      <p>5 Projects</p>
                  </li>
                  <li>
                      <p>5 GB Storage</p>
                  </li>
                  <li>
                      <p>100GB Monthly Bandwidth</p>
                  </li>
                  <li><p>Premium Support</p></li>
                  <li>
                      <p>Your domain</p>
                  </li>
                  <li>
                      <a href="#" class="btn btn-sm btn-dark">Purchase</a>
                  </li>
              </ul>
            </div> <!-- end col-sm-4 -->
          </div> <!-- end row -->
        </div> <!-- end container -->
      </div>
    </section>
    <!-- End prices section -->

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
                      <img src={{ asset('assets/sailent/images/temp/client-photo.jpg') }}" alt="">
                      <p>Sebelumnya saya setelah bangun tidur kepala pusing ngliyeng dan kaki sering kesemutan. Alhamdulillah setelah 3 hari konsumsi Proflavo ngliyeng dan kesemutan kaki saya sudah hilang. Sekarang rutin konsumsi Proflavo Propolis</p>
                      <div class="testimonials-author"> Mbah Magi - Semarang </div>
                    </li>

                    <!-- Testimonial -->
                    <li>
                      <img src={{ asset('assets/sailent/images/temp/client-photo.jpg') }}" alt="">
                      <p>Saya sebelumnya pegel kaki, ngantuk tidak bisa dihindari. Lalu saya dikenalkan Proflavo dan mulai mengonsumsinya. Setelah minum Proflavo alhamdulillah sampai sekarang tidak ada keluhan dan rasa pegel di kaki sudah tidak ada.</a>.</p>
                      <div class="testimonials-author">Suwarno - Karanganyar</div>
                    </li>

                    <!-- Testimonial -->
                    <li>
                      <img src={{ asset('assets/sailent/images/temp/client-photo.jpg') }}" alt="">
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
      <div id="contact-section" class="pad-sec">

        <div class="container">

          <div class="title-section text-center animated out" data-animation="fadeInUp" data-delay="0">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                  <h2>Contact</h2>
                  <hr>
                  <p>Hubungi kami</p>
              </div>
            </div> <!-- End row -->
          </div> <!-- end title-section -->

          <div class="form-wrapper">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">

                <!-- form fields -->
              {{--   <form id="form-order" method="post" name="contactform" id="contactform" class="animated out" data-animation="fadeInUp" data-delay="0">

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
                  </fieldset>

                  <!-- submit button -->
                  <div class="form-group">
                    <input type="submit" name="submit" value="Send message" id="submit" class="btn btn-sm btn-dark">
                  </div>

                  <div id="alert"></div>

                </form> --}}

              </div> <!-- end col-md-8 -->
            </div> <!-- end row -->
          </div>  <!-- end form-wrapper -->

        </div> <!-- end container -->

      </div> <!-- End contact-section -->
    </section>

    <!-- Contact-info
    ================================================== -->
    <section>
      <div class="contact-info">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <a href="#"><i class="pe-7s-map-marker"></i>Ruko Sibedil No. B6-7 Jl Solo Karanganyar Km7 Karanganyar</a>
            </div> <!-- End col-sm-4 -->
            <div class="col-sm-4">
            <a href="tel:+123000456"><i class="pe-7s-phone"></i>0271-736773</a>
            </div>
             <div class="col-sm-4">
              <a href="mailto:hello@hotmail.com"><i class="pe-7s-mail"></i>dobelnetwork@gmail.com</a>
             </div>
          </div> <!-- End row -->
        </div> <!-- End container -->
      </div> <!-- End contact-info -->
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
