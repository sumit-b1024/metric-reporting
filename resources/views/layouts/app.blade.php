<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <title>Dashboard - CMS | Rednirus</title>
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icons.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
        @yield('css')
        <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
        <script src="{{asset('assets/js/config.js')}}"></script>
    </head>
    <body>
        <div class="layout-wrapper layout-content-navbar  ">
            <div class="layout-container">
                @include('layouts.sidebar')
                <div class="layout-page">
                    @include('layouts.header')
                    <div class="content-wrapper">
                        @yield('content')
                        @include('layouts.footer')
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="toggleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('delete-permission-form').submit();">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <form id="delete-permission-form" action="" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <div class="layout-overlay layout-menu-toggle"></div>
            <div class="drag-target"></div>
        </div>
        <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
        <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
        <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/%40form-validation/popular.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/%40form-validation/bootstrap5.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/%40form-validation/auto-focus.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>
        <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
        <script>
            $(document).on('click', '.delete-record', function() {
                $('#toggleModal .modal-body').html($(this).attr('data-content'));
                $('#toggleModal .modal-footer a').attr("href",$(this).attr('data-route'));
                $('#delete-permission-form').attr("action",$(this).attr('data-route'));
            });
        </script>
        @yield('js')
        <script src="{{asset('assets/js/dashboards-crm.js')}}"></script>
    </body>
</html>