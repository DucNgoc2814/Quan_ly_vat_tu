<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

</html>

<head>

    <meta charset="utf-8" />
    <title>Đăng Nhập | Velzon - Trang Quản Trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Giao Diện Quản Trị Đa Năng Cao Cấp" name="description" />
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
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="{{ asset('themes/admin/assets/images/gemo2.png') }}"
                                                        alt="" height="200">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div id="qoutescarouselIndicators" class="carousel slide"
                                                    data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="0" class="active" aria-current="true"
                                                            aria-label="Slide 1"></button>
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button"
                                                            data-bs-target="#qoutescarouselIndicators"
                                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">"Quản lý xuất sắc, dẫn lối thành
                                                                công vượt trội, tạo nên những kết quả tuyệt vời và bền
                                                                vững. "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">"Nơi bắt đầu của sự hoàn hảo,
                                                                đem đến những thành công đỉnh cao và bền vững."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">"Quản lý đột phá, tạo dựng giá
                                                                trị vượt trội, mang lại kết quả xuất sắc cho doanh
                                                                nghiệp. "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Chào Mừng Trở Lại!</h5>
                                            <p class="text-muted">Đăng nhập để tiếp tục vào hệ thống.</p>
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                        </div>

                                        <div class="mt-4">
                                            <form action="{{ route('employees.loginPost') }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        id="email" placeholder="Nhập email">
                                                    @error('email')
                                                        <span class="text-danger">*{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="auth-pass-reset-cover.html" class="text-muted">Quên mật
                                                            khẩu?</a>
                                                    </div>
                                                    <label class="form-label" for="password-input">Mật khẩu</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" name="password"
                                                            class="form-control pe-5 password-input"
                                                            placeholder="Nhập mật khẩu" id="password-input">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                        @error('password')
                                                            <span class="text-danger">*{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Ghi nhớ
                                                        đăng nhập</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Đăng
                                                        Nhập</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('themes/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/plugins.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('themes/admin/assets/js/pages/password-addon.init.js') }}"></script>
</body>

</html>
