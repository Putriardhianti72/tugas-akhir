@extends('Layouts.main')
@section('isi')

 <!-- main content -->
 <div class="main-content">
    <div class="wrap-banner">
        <!-- menu category -->
        <div class="container position">
            <div class="section menu-banner d-xs-none">
                <div class="tiva-verticalmenu block">

                </div>
            </div>
        </div>
        <!-- slide show -->
        <div class="section banner">
            <div class="tiva-slideshow-wrapper">
                <div id="tiva-slideshow" class="nivoSlider">
                    <a href="#">
                        <img class="img-responsive" src="{{asset('user')}}/img/home/home-th.png" title="#caption1" alt="Slideshow image">
                    </a>
                    <a href="#">
                        <img class="img-responsive" src="{{asset('user')}}/img/home/home-th4.png" title="#caption2" alt="Slideshow image">
                    </a>
                    <a href="#">
                        <img class="img-responsive" src="{{asset('user')}}/img/home/home-th3.png" title="#caption3" alt="Slideshow image">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- main -->
    <div id="wrapper-site">
        <div id="content-wrapper" class="full-width">
            <div id="main">
                <section class="page-home">
                    <div class="container">

                        <!-- delivery form -->
                        <div class="section policy-home col-lg-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="block">
                                        <div class="block-content">
                                            <div class="policy-item">
                                                <div class="policy-content iconpolicy1">
                                                    <img src="{{ asset('user') }}/img/home/home1-policy.png" alt="img">
                                                    <div class="policy-name mb-5">INTEGRATED SHIPPING</div>
                                                    <div class="policy-des">Website marketing terintegrasi RajaOngkir</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tiva-html col-lg-4 col-md-4">
                                    <div class="block">
                                        <div class="block-content">
                                            <div class="policy-item">
                                                <div class="policy-content iconpolicy2">
                                                    <img src="{{ asset('user') }}/img/home/home1-policy2.png" alt="img">
                                                    <div class="policy-name mb-5">FREE MAINTANANCE</div>
                                                    <div class="policy-des">Website akan terus update dari perusahaan</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tiva-html col-lg-4 col-md-4">
                                    <div class="block">
                                        <div class="block-content">
                                            <div class="policy-item">
                                                <div class="policy-content iconpolicy3">
                                                    <img src="{{ asset('user') }}/img/home/home1-policy3.png" alt="img">
                                                    <div class="policy-name mb-5">AUTOMATIC REWARD</div>
                                                    <div class="policy-des">Reward otomatis ke tangan Anda</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- product living room -->
                    <div class="section living-room">
                        <div class="container">
                            <div class="tiva-row-wrap row">
                                <div class="groupcategoriestab-vertical col-md-12 col-xs-12">
                                    <div class="grouptab row">

                                        <div class="categoriestab-left product-tab col-md-9 flex-9">
                                            <div class="title-tab-content d-flex justify-content-start">
                                                <ul class="nav nav-tabs">
                                                    <li>
                                                        <a href="#new" data-toggle="tab" class="active">New Arrivals</a>
                                                    </li>
                                                    <li>
                                                        <a href="#best" data-toggle="tab">Best Sellers</a>
                                                    </li>
                                                    <li>
                                                        <a href="#sale" data-toggle="tab">Special Products</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <div id="new" class="tab-pane fade in active show">
                                                    <div class="category-product-index owl-carousel owl-theme owl-loaded owl-drag" style="width: 135%">
                                                        @foreach ($products as $product)
                                                        <div class="item text-center" >
                                                            <div class="product-miniature first-item js-product-miniature item-one">
                                                                <div class="thumbnail-container">
                                                                    <a href="{{ route('products.show', $product->id) }}">
                                                                        <img class="img-fluid image-cover" src="{{ $product->pict_url }}" alt="img">
                                                                        <img class="img-fluid image-secondary" src="{{ $product->pict_url }}" alt="img">
                                                                    </a>
                                                                </div>
                                                                <div class="product-description">
                                                                    <div class="product-groups">
                                                                        <div class="product-title">
                                                                            <a href="{{ route('products.show', $product->id) }}">{{$product->product_name}}</a>
                                                                        </div>
                                                                        <div class="product-group-price">
                                                                            <div class="product-price-and-shipping">
                                                                                <span class="price">{{$product->price}}</span>
                                                                                <del class="regular-price">£28.68</del>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-buttons d-flex justify-content-center">
                                                                        <form action="#" method="post" class="formAddToCart">
                                                                            @csrf
                                                                            @if(member_auth()->check())
                                                                                @if($product->in_stock)
                                                                                <a class="add-to-cart" href="{{route('carts.edit', $product->id)}}" data-button-action="add-to-cart" data-add-to-cart="{{ $product->id }}">
                                                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                                </a>
                                                                                @else
                                                                                <span class="add-to-cart"data-button-action="add-to-cart">
                                                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                                </span>
                                                                                @endif
                                                                            @else
                                                                            <a class="add-to-cart" href="{{route('login')}}" data-button-action="add-to-cart">
                                                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                            </a>
                                                                            @endif
                                                                        </form>
                                                                        <a href="#" class="quick-view hidden-sm-down" data-link-action="quickview">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <!-- banner -->
                        <div class="section spacing-10 group-image-special col-lg-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('user')}}/img/home/home-bn.png" alt="banner-1" title="banner-1">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="effect">
                                        <a href="#">
                                            <img class="img-fluid" src="{{asset('user')}}/img/home/home-bn.png" alt="banner-2" title="banner-2">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- testimonial -->
                        <div class="section testimonial-block col-lg-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 ">
                                    <div class="block">
                                        <div class="owl-carousel owl-theme testimonial-type-one">
                                            <div class="item type-one d-flex align-items-center flex-column">
                                                <div class="textimonial-image">
                                                    <i class="icon-testimonial"></i>
                                                </div>
                                                <div class="desc-testimonial">
                                                    <div class="testimonial-content">
                                                        <div class="text">
                                                            <p>" Liquam quis risus viverra, ornare ipsum vitae, congue tellus.
                                                                Vestibulum nunc lorem, scelerisque a tristique non, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum "</p>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info">
                                                        <h5 class="mt-0 box-info">David Jame</h5>
                                                        <p class="box-dress">DESIGNER</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item type-one d-flex align-items-center flex-column">
                                                <div class="textimonial-image">
                                                    <i class="icon-testimonial"></i>
                                                </div>
                                                <div class="desc-testimonial">
                                                    <div class="testimonial-content">
                                                        <div class="text">
                                                            <p>" Liquam quis risus viverra, ornare ipsum vitae, congue tellus.
                                                                Vestibulum nunc lorem, scelerisque a tristique non, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum "</p>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info">
                                                        <h5 class="mt-0 box-info">Max Control</h5>
                                                        <p class="box-dress">DEVELOPER</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item type-one d-flex align-items-center flex-column">
                                                <div class="textimonial-image">
                                                    <i class="icon-testimonial"></i>
                                                </div>
                                                <div class="desc-testimonial">
                                                    <div class="testimonial-content">
                                                        <div class="text">
                                                            <p>" Liquam quis risus viverra, ornare ipsum vitae, congue tellus.
                                                                Vestibulum nunc lorem, scelerisque a tristique non, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum "</p>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info">
                                                        <h5 class="mt-0 box-info">John Do</h5>
                                                        <p class="box-dress">CSS - HTML</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item type-one d-flex align-items-center flex-column">
                                                <div class="textimonial-image">
                                                    <i class="icon-testimonial"></i>
                                                </div>
                                                <div class="desc-testimonial">
                                                    <div class="testimonial-content">
                                                        <div class="text">
                                                            <p>" Liquam quis risus viverra, ornare ipsum vitae, congue tellus.
                                                                Vestibulum nunc lorem, scelerisque a tristique non, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum, accumsan
                                                                ornare eros. Nullam sapien metus, volutpat dictum "</p>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-info">
                                                        <h5 class="mt-0 box-info">Elizabeth Pham</h5>
                                                        <p class="box-dress">DEVELOPER</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <!-- recent posts -->
                    <div class="container">
                        <div class="section recent-post">
                            <div class="title-block">CATEGORIES</div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="item-post">
                                        <div class="thumbnail-img">
                                            <a href="blog-detail.html">
                                                <img src="img/home/home1-post1.jpg" alt="img">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="post-info">
                                                <span class="comment">
                                                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    <span>0 Comments</span>
                                                </span>
                                                <span class="datetime">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>April 12, 2018</span>
                                                </span>
                                            </div>
                                            <div class="post-title">
                                                <a href="blog-detail.html">Lorem ipsum dolor sit amet</a>
                                            </div>
                                            <div class="post-desc">
                                                Lorem ipsum dolor sit amet, consecte adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="item-post">
                                        <div class="thumbnail-img">
                                            <a href="blog-detail.html">
                                                <img src="img/home/home1-post2.jpg" alt="img">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="post-info">
                                                <span class="comment">
                                                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    <span>0 Comments</span>
                                                </span>
                                                <span class="datetime">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>April 12, 2018</span>
                                                </span>
                                            </div>
                                            <div class="post-title">
                                                <a href="blog-detail.html">Lorem ipsum dolor sit amet</a>
                                            </div>
                                            <div class="post-desc">
                                                Lorem ipsum dolor sit amet, consecte adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="item-post">
                                        <div class="thumbnail-img">
                                            <a href="blog-detail.html">
                                                <img src="img/home/home1-post3.jpg" alt="img">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="post-info">
                                                <span class="comment">
                                                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                                                    <span>0 Comments</span>
                                                </span>
                                                <span class="datetime">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>April 12, 2018</span>
                                                </span>
                                            </div>
                                            <div class="post-title">
                                                <a href="blog-detail.html">Lorem ipsum dolor sit amet</a>
                                            </div>
                                            <div class="post-desc">
                                                Lorem ipsum dolor sit amet, consecte adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- partner -->
                        <div class="section introduct-logo">
                            <div class="row">
                                <div class="tiva-manufacture  col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="block">
                                        <div id="manufacture" class="owl-carousel owl-theme owl-loaded owl-drag">
                                            <div class="item">
                                                <div class="logo-manu">
                                                    <a href="#" title="view products">
                                                        <img class="img-fluid" src="img/home/icon-logo1.jpg" alt="img" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="logo-manu">
                                                    <a href="#" title="view products">
                                                        <img class="img-fluid" src="img/home/icon-logo2.jpg" alt="img" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="logo-manu">
                                                    <a href="#" title="view products">
                                                        <img class="img-fluid" src="img/home/icon-logo3.jpg" alt="img" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="logo-manu">
                                                    <a href="#" title="view products">
                                                        <img class="img-fluid" src="img/home/icon-logo4.jpg" alt="img" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="logo-manu">
                                                    <a href="#" title="view products">
                                                        <img class="img-fluid" src="img/home/icon-logo5.jpg" alt="img" />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="logo-manu">
                                                    <a href="#" title="view products">
                                                        <img class="img-fluid" src="img/home/icon-logo6.jpg" alt="img" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
