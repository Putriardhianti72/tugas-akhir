<!DOCTYPE html>
<!--
  Salient by TEMPLATE STOCK
  templatestock.co @templatestock
  Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @hasSection('page-title')
  <title>@yield('page-title') - Retail Commerce</title>
  @else
  <title>Retail Commerce</title>
  @endif

  <!-- Custom Google fonts -->
  <link href='//fonts.googleapis.com/css?family=Raleway:400,500,300,700' rel='stylesheet' type='text/css'>
  <link href="//fonts.googleapis.com/css?family=Crimson+Text:400,600" rel="stylesheet" type="text/css">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">

  <!-- Bootstrap CSS Style -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/bootstrap.min.css') }}">

  <!-- Template CSS Style -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/style.css') }}">

  <!-- Animate CSS  -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/animate.css') }}">

  <!-- FontAwesome 4.3.0 Icons  -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/font-awesome.min.css') }}">

  <!-- et line font  -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/et-line-font/style.css') }}">

  <!-- BXslider CSS  -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/bxslider/jquery.bxslider.css') }}">

  <!-- Owl Carousel CSS Style -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/owl-carousel/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/owl-carousel/owl.theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/owl-carousel/owl.transitions.css') }}">

  <!-- Magnific-Popup CSS Style -->
  <link rel="stylesheet" href="{{ asset('assets/sailent/css/magnific-popup/magnific-popup.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">
    .dropdown-navbar-cart .dropdown-menu {
      min-width: 320px;
    }
    .dropdown-navbar-cart .dropdown-menu .dropdown-menu-action {
      display: flex;
      align-item: center;
      justify-content: space-around;
    }
  </style>

  @stack('css')
</head>
<body @hasSection('body-class') class="@yield('body-class')" @endif>

  <!-- Preload the Whole Page -->
  <div id="preloader">
    <div id="loading-animation">&nbsp;</div>
  </div>

  <!-- Navbar -->
  <header class="header">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <a class="navbar-brand" href="#"><img src="assets/images/logo.png" alt=""></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navigation-nav">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a class="section-scroll" href="#wrapper">Home</a></li>
            <li><a href="#landing-offer">About</a></li>
            <li><a href="#features-section">Services</a></li>
            <li><a href="#price-section-1">Price</a></li>
            <li><a href="#testimonials-section">Testimoni</a></li>
            <li><a href="#contact-section">Contact</a></li>
       {{--      <li><a href="#screenshots-section">Works</a></li>
            <li><a href="#prices-section">Prices</a></li> --}}


            {{-- <li class="dropdown dropdown-navbar-cart active">
              <a href="#" class="dropdown-toggle" id="navbarDrop1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart"></i> Cart</a>
                <div class="dropdown-menu" aria-labelledby="navbarDrop1">
                  <div class="media">
                    <div class="media-left">
                      <img alt="64x64" class="media-object" style="width: 64px; height: 64px; max-width: none;" src="https://via.placeholder.com/64x64.png">
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Media heading</h4>
                      CLorem ipsum sit dolor amet
                    </div>
                  </div>
                    <div role="separator" class="divider"></div>
                    <div class="dropdown-menu-action">
                      <a href="#three">View Cart</a>
                      <a href="#three">Checkout</a>
                    </div>
                </div>
            </li> --}}
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
  </header>
  <!-- End Navbar -->

  <div id="wrapper">
    @yield('content')
  </div>
  <!-- Back-to-top
  ================================================== -->
  <div class="back-to-top">
    <i class="fa fa-angle-up fa-3x"></i>
  </div> <!-- end back-to-top -->

  <!-- JS libraries and scripts -->
  <script src="{{ asset('assets/sailent/js/jquery-1.11.3.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/bootstrap-hover-dropdown.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.appear.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.bxslider.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.countTo.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.imagesloaded.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.isotope.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.placeholder.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.smoothscroll.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.waypoints.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.fitvids.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.countdown.js') }}"></script>
  <script src="{{ asset('assets/sailent/js/jquery.navbar-scroll.js') }}"></script>
  {{-- <script src="http://maps.google.com/maps/api/js?sensor=false"></script> --}}
  {{-- <script src="{{ asset('assets/sailent/js/jquery.gmaps.js') }}"></script> --}}
  <script src="{{ asset('assets/sailent/js/main.js') }}"></script>
  @stack('js')
</body>
</html>
