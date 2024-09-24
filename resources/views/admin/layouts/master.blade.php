<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('themes/admin/assets/images/Gemo__1_-removebg-preview.png') }}">

    @yield('styles-list')
    <!-- Layout config Js -->
    <script src="{{ asset('themes/admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('themes/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('themes/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('themes/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('themes/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- link ajax jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    .form-control-sm{
        width: 250px !important;
        height:  35px !important;
    }
</style>
    <script src="{{ asset('themes/admin/assets/js/jquery.js') }}"></script>
    @yield('styles')
</head>

<body>
    <!-- Begin page -->
    <div id="jquery-wrapper">
        @include('admin.layouts.partials.header')
        <!-- ========== App Menu ========== -->
        @include('admin.layouts.partials.sidebar')
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.layouts.partials.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <script>
        const PATH_ROOT = '{{ asset('themes/admin/') }}';
    </script>


    <!-- JAVASCRIPT -->
    <script src="{{ asset('themes/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/plugins.js') }}"></script>

    @yield('scripts-list')
    <!-- App js -->
    <script src="{{ asset('themes/admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/jquery.js') }}"></script>
<script>
new DataTable('#myTable')
</script>
    @yield('scripts')
</body>

</html>
