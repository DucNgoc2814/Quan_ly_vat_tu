<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>404 Lỗi | Quản lý vật tư</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Hệ thống quản lý vật tư" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('themes/admin/assets/images/favicon.ico') }}">

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

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden p-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="text-center">
                            <img src="{{ asset('themes/admin/assets/images/error400-cover.png') }}" alt="error img" class="img-fluid">
                            <div class="mt-3">
                                <h3 class="text-uppercase">Xin lỗi, không tìm thấy trang 😭</h3>
                                <p class="text-muted mb-4">Trang bạn đang tìm kiếm không tồn tại!</p>
                                @if(session('error') == 'backLogin')
                                <a href="{{ route('employees.login') }}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Quay lại trang đăng nhập</a>
                                @else
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Quay lại trang chủ</a>
                                @endif
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth-page content -->
    </div>
    <!-- end auth-page-wrapper -->

</body>

</html>