<!DOCTYPE html>

<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-semi-dark"
    data-assets-path="assets/" data-template="vertical-menu-template-semi-dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    <meta name="description" content="Login kedalam aplikasi untuk melakukan pengolahan nilai" />
    <meta name="keywords" content="login, login sistem pengolahan nilai {{ $ps->nama_sekolah }}">
    <!-- Favicon -->
    @if($ps->logo)
    <link rel="icon" type="image/x-icon" href="{{asset($ps->logo)}}" />
    @else
    <link rel="icon" type="image/x-icon" href="{{asset('logo/default.png')}}" />
    @endif

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css?v='.rand()) }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css?v='.rand()) }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css?v='.rand()) }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css?v=".rand() />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-semi-dark.css?v='.rand()) }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css?v='.rand()) }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css?v='.rand()) }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css?v='.rand()) }}" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css?v='.rand()) }}">

</head>

<body style="background-color: #fff;">

    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{asset('assets/img/illustrations/entry.jpg')}}" class="img-fluid" alt="Login image" width="700">
                </div>
            </div>
            <!-- /Left Text -->


            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <div class="mb-5">
                        <h6 class="mb-2">SISTEM INFORMASI PENGOLAHAN NILAI</h6>
                        <h6 class="mb-2">{{ $ps->nama_sekolah }}</h6>
                    </div>
                    <form id="formAuthentication" class="mb-3" autocomplete="off">
                        <div class="message"></div>
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" name="username">
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" id="password" class="form-control" name="password" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger d-grid w-100 login">
                            Login
                        </button>
                    </form>
                </div>
                <!-- /Login -->
            </div>
        </div>

        <!-- / Content -->
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="{{asset('assets/vendor/libs/jquery/jquery.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/libs/popper/popper.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/js/bootstrap.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/libs/hammer/hammer.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/libs/i18n/i18n.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js?v='.rand())}}"></script>
        <script src="{{asset('assets/vendor/js/menu.js?v='.rand())}}"></script>
        <script src="{{asset('assets/ajax/auth.js?v='.rand() )}}"></script>

        <!-- endbuild -->
</body>

</html>
