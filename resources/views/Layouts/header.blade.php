<header>
    <!-- header left mobie -->
    <div class="header-mobile d-md-none">
        <div class="mobile hidden-md-up text-xs-center d-flex align-items-center justify-content-around">

            <!-- menu left -->
            <div id="mobile_mainmenu" class="item-mobile-top">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>

            <!-- logo -->
            <div class="mobile-logo">
                <a href="{{ url('/') }}">
                    <img class="logo-mobile img-fluid" src="{{ asset('user') }}/img/home/selleria-logo.png" alt="Prestashop_Furnitica">
                </a>
            </div>

            <!-- menu right -->
            <div class="mobile-menutop" data-target="#mobile-pagemenu">
                <i class="zmdi zmdi-more"></i>
            </div>
        </div>

        <!-- search -->
        <div id="mobile_search" class="d-flex">
            {{-- <div id="mobile_search_content">
                <form method="get" action="#">
                    <input type="text" name="s" value="" placeholder="Search">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div> --}}
          <div class="desktop_cart">
                <div class="blockcart block-cart cart-preview tiva-toggle">
                    <div class="header-cart tiva-toggle-btn">
                        <span class="cart-products-count">0</span>
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="dropdown-content">
                        <div class="cart-content">
                            <table>
                                <tbody data-template-content="cart-list">
                                    <tr>
                                        <td class="product-image">
                                            <a href="product-detail.html">
                                                <img src="" alt="Product">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="product-name">
                                                <a href="#"></a>
                                            </div>
                                            <div>
                                                <span class="product-price"></span>
                                            </div>
                                        </td>
                                        <td class="action">
                                            <a class="remove" href="#">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr class="total">
                                        <td colspan="2">Total:</td>
                                        <td>0</td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" class="d-flex justify-content-center">
                                            <div class="cart-button">
                                                <a href="{{ member_auth()->check() ? url('/carts') : url('login') }}" title="View Cart">View Cart</a>
                                                <a href="{{ member_auth()->check() ? url('/carts') : url('login') }}" title="Checkout">Checkout</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- header desktop -->
    <div class="header-top d-xs-none ">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-sm-2 col-md-2 d-flex align-items-center">
                    <div id="logo">
                        <a href="{{ url('/') }}">
                            <img class="img-fluid" src="{{asset('user')}}/img/home/selleria-logo.png" alt="logo">
                        </a>
                    </div>
                </div>

                <!-- menu -->
                <div class="main-menu col-sm-4 col-md-5 align-items-center justify-content-center navbar-expand-md">
                    <div class="menu navbar collapse navbar-collapse">
                        <ul class="menu-top navbar-nav">
                            {{-- <li class="nav-link"> --}}
                            <li>
                                <a href="{{ url('/') }}" class="parent">Home</a>

                            </li>
                            <li>
                                <a href="{{ url('/products') }}" class="parent">Product</a>
                            </li>
                            <li>
                                <a href="{{ url('/services') }}" class="parent">Services</a>
                            </li>
                            <li>
                                <a href="{{ url('/about-us') }}" class="parent">About Us</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- search-->
                <div id="search_widget" class="col-sm-6 col-md-5 align-items-center justify-content-end d-flex">
                 {{--    <form method="get" action="#">
                        <input type="text" name="s" value="" placeholder="Search ..." class="ui-autocomplete-input" autocomplete="off">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form> --}}

                    <!-- acount  -->
                    <div id="block_myaccount_infos" class="hidden-sm-down dropdown">
                        <div class="myaccount-title">
                            <a href="#acount" data-toggle="collapse" class="acount">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                @if (member_auth()->check())
                                    <span>{{ member_auth()->user()->get('nama') }}</span>
                                @else
                                    <span>Account</span>
                                @endif
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div id="acount" class="collapse">
                            <div class="account-list-content">
                                @if(member_auth()->check())
                                <div>
                                    <a class="login" href="{{ url('/profile') }}" rel="nofollow" title="Log in to your customer account">
                                        <i class="fa fa-cog"></i>
                                        <span>My Account</span>
                                    </a>
                                </div>
                                <div>
                                    <a class="login" href="{{ url('/orders') }}" rel="nofollow" title="Log in to your customer account">
                                        <i class="fa fa-cog"></i>
                                        <span>My Orders</span>
                                    </a>
                                </div>
                                @if(member_auth()->hasOrder())
                                <div>
                                    <a class="login" href="{{ url('/member-area') }}" rel="nofollow" title="Log in to your customer account">
                                        <i class="fa fa-cog"></i>
                                        <span>My Dashboard</span>
                                    </a>
                                </div>
                                @endif
                                @else
                                <div>
                                    <a class="login" href="{{ url('/login') }}" rel="nofollow" title="Log in to your customer account">
                                        <i class="fa fa-sign-in"></i>
                                        <span>Sign in</span>
                                    </a>
                                </div>
                                @endif
{{--                                <div>--}}
{{--                                    <a class="register" href="user-register.html" rel="nofollow" title="Register Account">--}}
{{--                                        <i class="fa fa-user"></i>--}}
{{--                                        <span>Register Account</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div>
                                    <a class="check-out" href="{{ member_auth()->check() ? url('/carts') : url('/login') }}" rel="nofollow" title="Checkout">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Checkout</span>
                                    </a>
                                </div>
{{--                                <div>--}}
{{--                                    <a href="user-wishlist.html" title="My Wishlists">--}}
{{--                                        <i class="fa fa-heart"></i>--}}
{{--                                        <span>My Wishlists</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                @if(member_auth()->check())
                                <div>
                                    <a href="{{ url('/logout') }}" title="Logout">
                                        <i class="fa fa-sign-out"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="desktop_cart">
                        <div class="blockcart block-cart cart-preview tiva-toggle">
                            <div class="header-cart tiva-toggle-btn">
                                <span class="cart-products-count">0</span>
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </div>
                            <div class="dropdown-content">
                                <div class="cart-content">
                                    <table>
                                        <tbody data-template-content="cart-list">
                                            <tr>
                                                <td class="product-image">
                                                    <a href="product-detail.html">
                                                        <img src="" alt="Product">
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="product-name">
                                                        <a href="#"></a>
                                                    </div>
                                                    <div>
                                                        <span class="product-price"></span>
                                                    </div>
                                                </td>
                                                <td class="action">
                                                    <a class="remove" href="#">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr class="total">
                                                <td colspan="2">Total:</td>
                                                <td>0</td>
                                            </tr>

                                            <tr>
                                                <td colspan="3" class="d-flex justify-content-center">
                                                    <div class="cart-button">
                                                        <a href="{{ member_auth()->check() ? url('/carts') : url('login') }}" title="View Cart">View Cart</a>
                                                        <a href="{{ member_auth()->check() ? url('/carts') : url('login') }}" title="Checkout">Checkout</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script type="text/template" data-template="cart-list">
    <tr>
        <td class="product-image">
            <a href="#">
                <img alt="Product">
            </a>
        </td>
        <td>
            <div class="product-name">
                <a href="#"></a>
            </div>
            <div>
                <span class="product-price"></span>
            </div>
        </td>
        <td class="action">
            <a class="remove" href="#">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
</script>
