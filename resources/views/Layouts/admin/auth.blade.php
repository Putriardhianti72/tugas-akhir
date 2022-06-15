<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
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
    <link rel="stylesheet" href="{{URL::asset('admin')}}/assets/css/auth.css">

    @stack('css')
</head>
<body class="template-auth">
<div class="wrapper">
    <div class="main-panel">
        @yield('content')
    </div>
</div>

@stack('js')
</body>
</html>
