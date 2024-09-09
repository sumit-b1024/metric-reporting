<!DOCTYPE html><html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>Login | Rednirus CMS</title>
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
        <!-- Icons -->
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons.css')}}" />
        <!-- Core CSS -->
        <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
        <!-- Vendor -->
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/%40form-validation/form-validation.css')}}" />
        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
        <!-- Helpers -->
        <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
        <script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>
        <script src="{{asset('assets/js/config.js')}}"></script>
    </head>
    <body>
        <div class="authentication-wrapper authentication-cover">
            <div class="authentication-inner row m-0">
                <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                    <div class="w-100 d-flex justify-content-center">
                        <img src="{{asset('assets/img/illustrations/boy-with-rocket-light.png')}}" class="img-fluid" alt="Login image" width="700">
                    </div>
                </div>
                <!-- /Left Text -->
                <!-- Login -->
                <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
                    <div class="w-px-400 mx-auto">
                        <!-- Logo -->
                        <div class="app-brand mb-5">
                            <a href="{{route('dashboard')}}" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-body fw-bold">Rednirus CMS</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Rednirus CMS! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    <a href="{{route('password.request')}}">
                                    <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                                    <label class="form-check-label" for="remember-me">
                                    Remember Me
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">
                            Sign in
                            </button>
                        </form>
                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{route('register')}}">
                            <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
        <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
        <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
        <!-- endbuild -->
        <!-- Vendors JS -->
        <script src="{{asset('assets/vendor/libs/%40form-validation/popular.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/%40form-validation/bootstrap5.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/%40form-validation/auto-focus.js')}}"></script>
        <!-- Main JS -->
        <script src="{{asset('assets/js/main.js')}}"></script>
        <!-- Page JS -->
        <script src="{{asset('assets/js/pages-auth.js')}}"></script>
    </body>
</html>

