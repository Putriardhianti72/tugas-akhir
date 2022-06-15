<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Area - Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{URL::asset('admin')}}/assets/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{URL::asset('admin')}}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{asset('admin')}}/assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{URL::asset('admin')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset('admin')}}/assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{URL::asset('admin')}}/assets/css/demo.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @stack('css')
</head>
<body>
<div class="wrapper">
    @include('Layouts.admin.header')

    @include('Layouts.admin.sidebar')
    <div class="main-panel">
        @yield('content')
        @include('Layouts.admin.footer')
    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                        <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeTopBarColor" data-color="dark"></button>
                        <button type="button" class="changeTopBarColor" data-color="blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="green"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange"></button>
                        <button type="button" class="changeTopBarColor" data-color="red"></button>
                        <button type="button" class="changeTopBarColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                        <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="green2"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                        <button type="button" class="changeTopBarColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button" class="selected changeSideBarColor" data-color="white"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Background</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                        <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                        <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                        <button type="button" class="changeBackgroundColor" data-color="dark"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="flaticon-settings"></i>
        </div>
    </div>
    <!-- End Custom template -->
</div>

<!--   Core JS Files   -->
<script src="{{URL::asset('admin')}}/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="{{URL::asset('admin')}}/assets/js/core/popper.min.js"></script>
<script src="{{URL::asset('admin')}}/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{URL::asset('admin')}}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
{{--<script src="{{URL::asset('admin')}}/assets/js/plugin/chart.js/chart.min.js"></script>--}}

<!-- jQuery Sparkline -->
{{--<script src="{{URL::asset('admin')}}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>--}}

<!-- Chart Circle -->
{{--<script src="{{URL::asset('admin')}}/assets/js/plugin/chart-circle/circles.min.js"></script>--}}

<!-- Datatables -->
{{--<script src="{{URL::asset('admin')}}/assets/js/plugin/datatables/datatables.min.js"></script>--}}

<!-- Bootstrap Notify -->
<script src="{{URL::asset('admin')}}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
{{--<script src="{{URL::asset('admin')}}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>--}}
{{--<script src="{{URL::asset('admin')}}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>--}}

<!-- Sweet Alert -->
<script src="{{URL::asset('admin')}}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Atlantis JS -->
<script src="{{URL::asset('admin')}}/assets/js/atlantis.min.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{URL::asset('admin')}}/assets/js/setting-demo.js"></script>
{{--<script src="{{URL::asset('admin')}}/assets/js/demo.js"></script>--}}

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
$(function () {
    $(document).on('click.logout', '.dropdown-user [data-action="logout"]', function (e) {
        e.preventDefault();

        window.location.replace('{{ route('admin.logout')  }}');
    })
})
</script>

@stack('js')

</body>
</html>
