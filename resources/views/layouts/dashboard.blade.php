<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>:: BigBucket :: Home</title>

    <link rel="stylesheet" href="{{ asset('vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-6.5.1-web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free-6.5.1-web/css/all.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}" />
    <!-- colorpicker -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
    <!-- tagsinput -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/charts-c3/plugin.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/jvectormap/jquery-jvectormap-2.0.3.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/main.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}" type="text/css">
</head>

<body class="theme-indigo rtl">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="{{ asset('images/brand/icon_black.svg') }}" width="48" height="48"
                    alt="ArrOw"></div>
            <p>Please wait...</p>
        </div>
    </div>

    @include('includes.header')

    <div class="main_content" id="main-content">
        @include('includes.side')
        <div class="page">
            @yield('content')
        </div>
    </div>

    <!-- Core -->
    <script src="{{ asset('bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('bundles/c3.bundle.js') }}"></script>
    {{-- <script src="{{ asset('bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js --> --}}
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script> <!-- Bootstrap Colorpicker Js -->
    <script src="{{ asset('vendor/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script> <!-- Input Mask Plugin Js -->
    <script src="{{ asset('vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script> <!-- tagsinput -->
    <script src="{{ asset('vendor/nouislider/js/nouislider.min.js') }}"></script> <!-- SLIDERS -->


    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/pages/index.js') }}"></script>
    <script src="{{ asset('js/pages/todo-js.js') }}"></script>
    <script src="{{ asset('js/pages/advanced-form.js') }}"></script>
    @yield('script')
    <script>
        import Echo from "laravel-echo"

        window.Pusher = require('pusher-js');

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'your-pusher-key',
            wsHost: window.location.hostname,
            wsPort: 6001,
            forceTLS: false,
            disableStats: true,
        });
    </script>
</body>

</html>
