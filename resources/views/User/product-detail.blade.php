@extends('Layouts.user.main')

@section('id-body', 'product-detail')

@section('isi')
<div class="main-content">
  <div id="wrapper-site">
    <div id="content-wrapper">
      <div id="main">
        <div class="page-home">

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
                    <a href="{{ route('products.index') }}">
                      <span>Product</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span>Detail Product</span>
                    </a>
                  </li>
                </ol>
              </div>
            </div>
          </nav>

          <div class="container">
            <div class="content">
              <div class="row justify-content-center mx-auto">
                <div class="col-sm-8 col-lg-9 col-md-9">
                  <div class="main-product-detail">
                    <h2>{{ $product->product_name }}</h2>
                    <div class="product-single row">
                      <div class="product-detail col-xs-12 col-md-5 col-sm-5">
                        <div class="page-content" id="content">
                          <div class="images-container">
                            <!--div class="js-qv-mask mask tab-content border">
                              <div id="item1" class="tab-pane fade active in show">
                                <img src="{{ $product->pict_url }}" alt="img">
                              </div>
                            </div-->

                            <div class="js-qv-mask mask tab-content border">
                              @foreach($product->images as $image)
                                <div id="item{{$image->id}}" class="tab-pane fade {{ $loop->iteration == 1 ? 'active in show' : '' }}">
                                    <img src="{{ $image->pict_url }}" alt="img">
                                </div>
                              @endforeach
                                <div class="layer hidden-sm-down" data-toggle="modal" data-target="#product-modal">
                                    <i class="fa fa-expand"></i>
                                </div>
                            </div>






                            <ul class="product-tab nav nav-tabs d-flex">
                              @foreach($product->images as $image)
                              <li class="col {{ $loop->iteration == 1 ? 'active' : '' }}">
                                  <a href="#item{{ $image->id }}" data-toggle="tab" aria-expanded="true" class="{{ $loop->iteration == 1 ? 'active show' : '' }}">
                                      <img src="{{ $image->pict_url }}" alt="img">
                                  </a>
                              </li>
                              @endforeach
                            </ul>


                          </div>
                        </div>
                      </div>
                      <div class="product-info col-xs-12 col-md-7 col-sm-7">
                        <div class="detail-description">
                          <div class="price-del">
                            <span class="price">{{ format_currency($product->price) }}</span>
                            <span class="float-right">
                              <span class="availb">Availability: </span>
                              @if($product->in_stock)
                              <span class="check">
                                <i class="fa fa-check-square-o" aria-hidden="true"></i>IN STOCK</span>
                              </span>
                              @else
                              <span class="check text-danger">
                                <i class="fa fa-window-close" aria-hidden="true"></i>OUT OF STOCK</span>
                              </span>
                              @endif
                          </div>
                          <p class="description">{{ $product->desc }}</p>

                          <div class="content mb-4">
                            <div class="row align-items-center">
                              <div class="col col-xs-12 col-md-6">
                                <p>Category :
                                  <span class="content2">
                                    <a href="#">{{ $product->category->category_name ?? '' }}</a>
                                  </span>
                                </p>
                              </div>
                              <div class="col col-xs-12 col-md-6 d-flex justify-content-end">
                                <div class="product-quantity">
                                  <div class="qty">
                                    <div class="input-group">
                                      <span class="add">
                                        @if(member_auth()->check())
                                          <button class="btn btn-primary add-to-cart add-item" data-button-action="add-to-cart" data-add-to-cart="{{ $product->id }}" type="button">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span>Add to cart</span>
                                          </button>
                                        @else
                                        <a class="btn btn-primary add-to-cart add-item" href="{{ route('login') }}" data-button-action="add-to-cart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                        @endif
                                      </span>
                                    </div>

                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <p class="product-minimal-quantity">
                                </p>
                              </div>
                          </div>
                        </div>
                        <div class="mt-2 has-border cart-area">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- end col-md-9-1 -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
