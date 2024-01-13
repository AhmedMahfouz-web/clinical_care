<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>CliniCare | تسجيل دخول</title>

    <link rel="stylesheet" href="{{ asset('vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/font-awesome.min.css') }}">

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
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <img src="{{ asset('images/logo.jpeg') }}" alt="Lucid">
                        <strong>POS</strong>
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead">تسجيل الدخول لحسابك </p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" method="POST" action="{{ route('adminLoginPost') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">البريد الالكتروني</label>
                                    <input type="email" name="email" class="form-control" id="signin-email"
                                        placeholder="البريد الالكتروني">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">كلمة المرور</label>
                                    <input type="password" name="password" class="form-control" id="signin-password"
                                        placeholder="كلمة المرور">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @error('credentials')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary btn-lg btn-block">دخول</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
</body>

</html>
