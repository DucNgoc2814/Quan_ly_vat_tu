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

    <!-- jsvectormap css -->
    <link href="{{ asset('themes/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('themes/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .form-control-sm {
            width: 250px !important;
            height: 35px !important;
        }

        .variant-checkbox-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .variant-checkbox {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid black;
            /* Viền mỏng */
            padding: 0;
            /* Đặt padding thành 0 để không có khoảng cách giữa viền và nền */
            border-radius: 5px;
            background-color: white;
            /* Nền trắng */
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }

        .variant-checkbox input {
            display: none;
            /* Ẩn checkbox */
        }

        .variant-checkbox span {
            color: black;
            /* Màu chữ mặc định là đen */
            font-weight: bold;
            padding: 5px 10px;
            /* Giữ padding cho span */
            border-radius: 5px;
            /* Bo góc cho span */
        }

        /* Khi checkbox được chọn */
        .variant-checkbox input:checked+span {
            background-color: rgb(11, 43, 102);
            /* Màu nền xanh đậm khi được chọn */
            color: white;
            /* Màu chữ trắng khi chọn */
            border-color: darkblue;
            /* Viền cũng đổi sang màu xanh đậm */
        }

        /* Đảm bảo rằng không có padding giữa nền và viền */
        .variant-checkbox input:checked+span {
            padding: 5px 10px;
            /* Đảm bảo padding không thay đổi khi chọn */
            border-radius: 5px;
            /* Bo góc giữ nguyên */
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('themes/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/js/plugins.js') }}"></script>

    <script src="{{ asset('themes/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('themes/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('themes/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('themes/admin/assets/libs/swiper/swiper-bundle.min.j') }}s"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('themes/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('themes/admin/assets/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--datatable js-->
    <script src="{{ asset('themes/admin/assets/js/jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>

    <script src="{{ asset('themes/admin/assets/js/jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="assets/js/pages/datatables.init.js"></script>
    <script>
        new DataTable('#myTable')
    </script>
    <script src="{{ asset('themes/admin/assets/js/jquery.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function changeStatus(nameTable, id, is_active) {
            $.ajax({
                url: '{{ route('client.updateStatus') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    nameTable: nameTable,
                    is_active: is_active
                },
                success: function(response) {
                    if (response.success) {
                        alert('Status updated successfully!');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
    <script>
     $(document).ready(function() {
        $('.div-datalist').hide();
    $('#customer_id').on('input', function() {
        $('.div-datalist').show();
        var value = $(this).val().toLowerCase();
        $('#customer_list .li-datalist').each(function() {
            if ($(this).text().toLowerCase().indexOf(value) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('.div-datalist').on('click', '.li-datalist', function() {
        var selectedText = $(this).find('.dataCustom').text();
        $('#customer_id').val(selectedText);
        $('#customer_list .li-datalist').hide();
        $('.div-datalist').hide();
    });
});

    </script>
    @yield('scripts')
</body>

</html>
