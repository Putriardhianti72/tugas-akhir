<!DOCTYPE html>
<html lang="en">
    @include('Layouts.user.head')
    <body class="product-cart checkout-cart blog">
    @include('Layouts.header')
        <div class="main-content" id="cart">
            <!-- main -->
            <div id="wrapper-site">
                <!-- breadcrumb -->
                <nav class="breadcrumb-bg">
                    <div class="container no-index">
                        <div class="breadcrumb">
                            <ol>
                                <li>
                                    <a href="#">
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span>Shopping Cart</span>
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <div class="row">
                        <div id="content-wrapper" class="col-12 col-sm-12 col-md-12 col-lg-12 onecol">
                            <section id="main">
                                <div class="cart-grid row">
                                    <div class="col-md-9 col-12 check-info">
                                        <form action="{{ route('orders.pay', $order->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-4 pb-4">
                                                <div class="col-12">
                                                    <h1 class="title-page">Pembayaran</h1>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row mb-4">
                                                        <div class="col-12 col-md-4">
                                                            <h6 class="subtitle-page">Total Pembayaran</h6>
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            <h6>{{ $totalPrice }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-12">
                                                            <h6 class="subtitle-page">Informasi Bank</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    Bank
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <strong>{{ $bank->bank_name }}</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    Nama
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <strong>{{ $bank->acc_owner }}</strong>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    No. Rekening
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <strong>{{ $bank->acc_number }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row my-4">
                                                        <div class="col-12">
                                                            <h6 class="subtitle-page">Konfirmasi Pembayaran</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    Nama Bank
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <div class="form-group">
                                                                        <input type="text" name="bank_name" class="form-control" placeholder="Contoh: BCA">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    Nama pengirim di Rekening Bank
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <div class="form-group">
                                                                        <input type="text" name="acc_owner" class="form-control" placeholder="Nama">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    No. Rekening Anda
                                                                </div>
                                                                <div class="col-12 col-md-8">
                                                                    <div class="form-group">
                                                                        <input type="text" name="acc_number" class="form-control" placeholder="0123123123">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    Jumlah
                                                                </div>
                                                                <div class="col-12 col-md-8">

                                                                    <div class="form-group">
                                                                        <input type="text" name="totalPrice" class="form-control" placeholder="{{ $totalPrice }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-12 col-md-4">
                                                            Bukti Pembayaran
                                                        </div>
                                                        <div class="col-12 col-md-8">
                                                            <div class="form-group">
                                                              <input type="file" name="payment_proof" class="form-control" id="inputGroupFile02">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr class="my-4">
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <button type="submit" class="continue btn btn-primary pull-xs-right">
                                                        Continue
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="cart-grid-right col-xs-12 col-lg-3">
                                        <div class="cart-summary">
                                            <div class="cart-detailed-totals">
                                                <div class="cart-summary-products">
                                                    <div class="summary-label">There are {{ 0 }} item in your cart</div>
                                                </div>
                                                <div class="cart-summary-line" id="cart-subtotal-products">
                                                        <span class="label js-subtotal">
                                                            Total products:
                                                        </span>
                                                    <span class="value">{{ 0 }}</span>
                                                </div>
                                                <div class="cart-summary-line" id="cart-subtotal-shipping">
                                                        <span class="label">
                                                            Total Shipping:
                                                        </span>
                                                    <span class="value">Free</span>
                                                    <div>
                                                        <small class="value"></small>
                                                    </div>
                                                </div>
                                                <div class="cart-summary-line cart-total">
                                                    <span class="label">Total:</span>
                                                    <span class="value">{{ 0 }} (tax incl.)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="block-reassurance">
                                            <ul>
                                                <li>
                                                    <div class="block-reassurance-item">
                                                        <img src="{{ asset('/user/img/product/check1.png') }}" alt="Security policy (edit with Customer reassurance module)">
                                                        <span>Security policy (edit with Customer reassurance module)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="block-reassurance-item">
                                                        <img src="{{ asset('/user/img/product/check2.png') }}" alt="Delivery policy (edit with Customer reassurance module)">
                                                        <span>Delivery policy (edit with Customer reassurance module)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="block-reassurance-item">
                                                        <img src="{{ asset('/user/img/product/check3.png' ) }}" alt="Return policy (edit with Customer reassurance module)">
                                                        <span>Return policy (edit with Customer reassurance module)</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- Vendor JS -->
    <script src="{{URL::asset('user/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('user/libs/popper/popper.min.js')}}"></script>
    <script src="{{URL::asset('user/libs/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('user/libs/slider-range/js/tmpl.js')}}"></script>
    <script src="{{URL::asset('user/libs/slider-range/js/jquery.dependClass-0.1.js')}}"></script>

    <!-- Template JS -->
    <script src="{{URL::asset('user/js/theme.js')}}"></script>
    <script src="{{URL::asset('user/js/script.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $(document).on('input', '[data-cart-input="domain"]', function () {
                var $this = $(this);
                var value = $this.val();

                if (value) {
                    if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(value)) {
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
                          success: function (res) {
                            if (res.status === 'success') {
                              $this.parent().find('.valid-feedback').text('Domain tersedia');
                            }
                          },
                          error: function (err) {
                            if (err.responseJSON.status === 'error') {
                                $this.parent().find('.valid-feedback').text('');
                                $this.parent().find('.invalid-feedback').text('Domain tidak tersedia');
                                $this.addClass('is-invalid').removeClass('is-valid');
                            }
                          }
                        })
                    } else {
                        $(this).parent().find('.valid-feedback').text('');
                        $(this).parent().find('.invalid-feedback').text('Domain tidak valid');
                        $(this).addClass('is-invalid').removeClass('is-valid');
                    }
                } else {
                    $(this).parent().find('.valid-feedback').text('');
                    $(this).parent().find('.invalid-feedback').text('');
                    $(this).removeClass('is-invalid').removeClass('is-valid');
                }
            });
        })
    </script>
</body>
</html>
