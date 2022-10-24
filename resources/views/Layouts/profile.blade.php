<!DOCTYPE html>
<!--
	xBe by TEMPLATE STOCK
	templatestock.co @templatestock
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->


<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    

    <title> xBe Free HTML5 Responsive Template  | Template Stock</title>

    <!-- Bootstrap Core CSS -->

    <link href="{{ asset('assets/xbe/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ asset('assets/xbe/css/style.css')}}">

    <!-- Custom Fonts -->

   <link href="{{ asset('assets/xbe/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
   <link href='https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
   <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>


    <!-- Custom Animations -->

    <link rel="stylesheet" href="{{ asset('assets/xbe/css/animate.css')}}">

</head>

<body>
    <!-- HEADER -->
    <header id="header">
     
    </header>
    <!-- Slider -->
    <section id="slider">
      <div id="myCarousel-one" class="carousel slide">

       <ol class="carousel-indicators">
            <li data-target="#myCarousel-one" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel-one" data-slide-to="1"></li>
           
        </ol>

            <div class="carousel-inner">
                <div class="item active"> 
                
                    <div class="carousel-caption wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro-text">
                                    <h1 class="intro-lead-in animated bounceInLeft">PUTRI WIDYA ARDHIANTI</h1>
                                    <h2 class="intro-heading animated bounceInRight">M3119072</h2>
                                    <p class="intro-paragraph animated bounceInRight">Mahasiswa D3 Teknik Informatika Sekolah Vokasi Universitas Sebelas Maret 
                                        <br>Judul Tugas Akhir Sistem Informasi Membership dengan Metode Agile</p>
                                </div>
                                <a href="{{ url('/home') }}" class="page-scroll btn btn-xl slider-button animated bounceInUp">TUGAS AKHIR</a>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/xbe/img/backgrounds/header-bg.jpg')}}" alt="slider-image"/>
                
                </div>
                <div class="item">
                    <div class="carousel-caption wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro-text">
                                    <h1 class="intro-lead-in animated bounceInLeft">PUTRI WIDYA ARDHIANTI</h1>
                                    <h2 class="intro-heading animated bounceInRight">M3119072</h2>
                                    <p class="intro-paragraph animated bounceInRight">Mahasiswa D3 Teknik Informatika Sekolah Vokasi Universitas Sebelas Maret 
                                    <br>Judul Tugas Akhir Sistem Informasi Membership dengan Metode Agile</p>
                                        <!-- <br>quam architecto quo inventore harum ex magni, dicta impedit.</p> -->
                                </div>
                                <a href="{{ url('/home') }}" class="page-scroll btn btn-xl slider-button animated bounceInUp">TUGAS AKHIR</a>
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('assets/xbe/img/backgrounds/header-bg-two.jpg')}}" alt="slider-image"/>
                </div>
                    <!-- Controls -->
                    <a class="myCarousel-one-left" href="#myCarousel-one" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="myCarousel-one-right" href="#myCarousel-one" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services">
        <div class="container-fluid wrapper">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <h2 class="section-heading">Portfolio</h2>
                    <h3 class="section-subheading">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h3>
                </div>
            </div>
            <div class="row text-center">
                <!-- First row services -->
                <div class="row first-services">
                    <div class="col-sm-12 col-md-4 service">
                        <i class="fa fa-desktop"></i>
                        <h4 class="service-heading">Web and Graphic Design</h4>
                        <p class="text-services">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-sm-12 col-md-4 service">
                        <i class="fa fa-magic"></i>
                        <h4 class="service-heading">Branding</h4>
                        <p class="text-services">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-sm-12 col-md-4 service">
                        <i class="fa fa-cubes"></i>
                        <h4 class="service-heading">Front End Development</h4>
                        <p class="text-services">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                </div>
                <!-- Second row services -->
                <div class="row second-services">
                    <div class="col-sm-12 col-md-4 service">
                        <i class="fa fa-cogs"></i>
                        <h4 class="service-heading">Back End Development</h4>
                        <p class="text-services">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-sm-12 col-md-4 service">
                        <i class="fa fa-laptop"></i>
                        <h4 class="service-heading">Responsive Design</h4>
                        <p class="text-services">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-sm-12 col-md-4 service">
                        <i class="fa fa-heart"></i>
                        <h4 class="service-heading">Consulting</h4>
                        <p class="text-services">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                </div>
            </div>
	</div>
    </section>
 
    <!-- Portfolio Section -->
    <section id="portfolio">
        <div class="container-fluid wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-heading">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</h3>
                </div>
                <div class="col-xs-12 col-md-12 portfolio-submenu text-center">
                    <ul class="filter">
                        <li><a class="active" href="#" data-filter="*">All</a></li>
                        <li><a href="#" data-filter=".wordpress">WordPress</a></li>
                        <li><a href="#" data-filter=".html">Web Design</a></li>
                        <li><a href="#" data-filter=".graphic">Graphic Design</a></li>
                        <li><a href="#" data-filter=".php">PHP</a></li>
                        <li><a href="#" data-filter=".bootstrap">Bootstrap</a></li>
                    </ul>
                    <!--/#portfolio-filter-->
                </div>
            </div>
        </div>
        <div class="portfolio-wrapper portfolio-container-fluid">
            <div class="portfolio-items">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid php graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Wine Label</h4>
                                    <h5>Branding</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/card.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid php graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Business Card</h4>
                                    <h5>Stationary</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/2.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid wordpress bootstrap">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Logo Design</h4>
                                    <h5>Branding</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/3.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid wordpress html bootstrap graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Logo Design</h4>
                                    <h5>Branding</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/4.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid wordpress graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Web Design</h4>
                                    <h5>Web Design</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/5.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid wordpress html graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Packageing and Label Design</h4>
                                    <h5>Branding</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/6.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid wordpress graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Logo Design</h4>
                                    <h5>Branding</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/1.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 work-grid wordpress graphic">
                    <div class="portfolio-item">
                        <div class="hover-bg">
                            <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                                <div class="hover-text">
                                    <h4>Book Cover</h4>
                                    <h5>Branding</h5>
                                    <div class="clearfix"></div>
                                    <i class="fa fa-plus"></i>
                                </div>
                                <img src="{{ asset('assets/xbe/img/portfolio/book.jpg')}}" class="img-responsive" alt="portfolio-image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact">
        <div class="container-fluid wrapper">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <br>
                    <h2 class="section-heading">Get in touch</h2>
                    <h3 class="section-subheading">Kontak saya lebih lanjut.</h3>
                </div>
                <div class="col-md-6">
                                 <div class="company-address col-sm-6 col-md-6">  
                                    <address>
                                        Putri Ardhianti
                                        <br>
                                        <span id="map-input">
                                 
                                    Universitas Sebelas Maret<br>
                                    Ir. Sutami, Jebres, Surakarta</span>
                                        <br>
                                    </address>
                                </div>
                               <div class="company-contact col-sm-6 col-md-6">
                                    <address>Email Us
                                        <br>
                                        <a href="mailto:#">ardhiantiputri@student.uns.ac.id</a>
                                        <br>
                                        <a href="mailto:#">support@example.com</a>
                                    </address>
                               </div>
                 </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="" novalidate>
                        <div class="row">
                            <div class="col-md-6 contact-form-box">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                           

                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                               
                           </div>
                            <div class="col-md-6">
                                <div id="map-canvas">
                                    
                                </div>
                              </div>   
                                
                            <div class="clearfix"></div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container-fluid wrapper">
            <div class="col-lg-12 footer-info">
                <a class="footer-logo" href="#header">
                    <!-- <img class="img-responsive" src="img/footer-logo.png" alt="logo-footer"> -->
                </a>
                <p class="footer-text">Terima kasih telah mengunjungi portofolio saya, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
            </div>
            <div class="col-sm-6 col-md-12 social-icons-footer">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-behance"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-google"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 copyright-bottom">
                <span class="copyright">Copyright &copy; xBe 2016 Created By <a href="http://templatestock" target="_blank">Template Stock</a> </span>
            </div>
        </div>
    </footer>
    <!-- Scroll-up -->
    <div class="scroll-up">
        <a href="#header" class="page-scroll"><i class="fa fa-angle-up"></i></a>
    </div>
    <div id="theme-settings">
        <div id="settings-button">
        </div>
        <div class="color">
            <span class="settings-title">Theme color selector</span>
            <ul class="gradients">
                <li>
                    <div class="gradient1">
                    </div>
                </li>
                <li>
                    <div class="gradient2">
                    </div>
                </li>
                <li>
                    <div class="gradient3">
                    </div>
                </li>
                <li>
                    <div class="gradient4">
                    </div>
                </li>
                <li>
                    <div class="gradient5">
                    </div>
                </li>
                <li>
                    <div class="gradient6">
                    </div>
                </li>
                <li>
                    <div class="gradient7">
                    </div>
                </li>
                <li>
                    <div class="gradient8">
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- Portfolio Modals -->
    <!-- Use the modals below to showcase details about your portfolio projects! -->
    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-responsive img-centered" src="img/portfolio/flattastic-free.jpg" alt="modal">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <p>
                                <strong>Want this UI kit sample?</strong>You can download it for free, courtesy of <a href="#">edubd.net</a>, or you can download it <a href="#">here</a>.</p>
                            <ul class="list-inline">
                                <li>Date: August 9, 2013</li>
                                <li>Client: Web Designer Depot</li>
                                <li>Category: Graphic Design</li>
                            </ul>
                            <button type="button" class="btn btn-xl" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-responsive img-centered" src="img/portfolio/flat.jpg" alt="modal">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <p>
                                <strong>Want this flat style illustrations? </strong>You can download it for free, courtesy of <a href="#">edubd.net</a>, or you can download it <a href="#">here</a>.</p>
                            <ul class="list-inline">
                                <li>Date: February 20, 2015</li>
                                <li>Client: Web Designer Depot</li>
                                <li>Category: Graphic Design</li>
                            </ul>
                            <button type="button" class="btn btn-xl" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/xbe/js/jquery.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/xbe/js/bootstrap.min.js')}}"></script>
    <!-- Color Settings script -->
    <script src="{{ asset('assets/xbe/js/settings-script.js')}}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('assets/xbe/js/jquery.easing.min.js')}}"></script>
    <!-- Contact Form JavaScript -->
    <script src="{{ asset('assets/xbe/js/jqBootstrapValidation.js')}}"></script>
    
    <!-- SmoothScroll script -->
    <script src="{{ asset('assets/xbe/js/smoothscroll.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('assets/xbe/js/xBe.js')}}"></script>
    <!-- Isotope -->
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <!-- Google Map -->
    <script src="http://maps.googleapis.com/maps/api/js?extension=.js&output=embed"></script>
    <!-- Footer Reveal scirt -->
    <script src="{{ asset('assets/xbe/js/footer-reveal.js')}}"></script>

</body>

</html>