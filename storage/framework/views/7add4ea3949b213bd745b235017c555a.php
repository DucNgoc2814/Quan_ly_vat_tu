<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('themes/admin/assets/images/Gemo__1_-removebg-preview.png')); ?>">

    <!-- jsvectormap css -->
    <link href="<?php echo e(asset('themes/admin/assets/libs/jsvectormap/css/jsvectormap.min.css')); ?>" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="<?php echo e(asset('themes/admin/assets/libs/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet"
        type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Layout config Js -->
    <script src="<?php echo e(asset('themes/admin/assets/js/layout.js')); ?>"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('themes/admin/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('themes/admin/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('themes/admin/assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo e(asset('themes/admin/assets/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>

    <!-- Config Echo -->
    <script>
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '<?php echo e(config('broadcasting.connections.pusher.key')); ?>',
            cluster: '<?php echo e(config('broadcasting.connections.pusher.options.cluster')); ?>',
            forceTLS: true,
            encrypted: true,
            enabledTransports: ['ws', 'wss']
        });
    </script>

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

        .variant-checkbox input:checked+span {
            padding: 5px 10px;
            /* Đảm bảo padding không thay đổi khi chọn */
            border-radius: 5px;
            /* Bo góc giữ nguyên */
        }



        .location-select-container {
            position: relative;
            width: 100%;
        }

        .location-dropdown {
            display: none;
            position: absolute;
            width: 100%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .location-dropdown.active {
            display: block;
        }

        .location-dropdown .row>div {
            padding-right: 10px;
            padding-left: 10px;
        }

        .location-dropdown select {
            margin-bottom: 10px;
        }

        /* Input field with icons inside */
        .input-with-icons {
            width: 100%;
            position: relative;
        }

        /* Styling for the icons inside the input */
        .input-with-icons input {
            width: 100%;
            padding-right: 40px;
            /* Add padding to make space for the icons */
        }

        /* Icon container inside the input */
        .input-with-icons .icon-container {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 10px;
            align-items: center;
        }

        /* Adjust icon size */
        .input-with-icons .ri-search-line,
        .input-with-icons .ri-arrow-down-s-line {
            font-size: 18px;
            color: #6c757d;
        }

        /* Initially hide search icon */
        .ri-search-line {
            display: none;
        }

        /* Show search icon when input is focused */
        .input-with-icons.focused .ri-search-line {
            display: block;
        }

        /* Always show the dropdown arrow */
        .ri-arrow-down-s-line {
            cursor: pointer;
        }



        .customer-list-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .customer-item {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .customer-item:hover {
            background-color: #f8f9fa;
        }

        /* Overlay for loading */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 10000;
            display: none;
            justify-content: center;
            align-items: center;
        }
    </style>
    <style>
        .chat-box-wrapper {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            z-index: 9999;
        }

        .chat-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chat-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-body {
            height: 300px;
            overflow-y: auto;
            padding: 15px;
        }

        .chat-footer {
            padding: 15px;
            border-top: 1px solid #eee;
        }

        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            max-width: 80%;
        }

        .sent {
            background: #007bff;
            color: white;
            margin-left: auto;
        }

        .received {
            background: #f1f1f1;
        }
    </style>
    <script src="<?php echo e(asset('themes/admin/assets/js/jquery.js')); ?>"></script>
    <?php echo $__env->yieldContent('styles'); ?>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    <div id="jquery-wrapper">
        <?php echo $__env->make('admin.layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php echo $__env->yieldContent('content'); ?>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php echo $__env->make('admin.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        const PATH_ROOT = '<?php echo e(asset('themes/admin/')); ?>';
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT -->
    <script src="<?php echo e(asset('themes/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('themes/admin/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('themes/admin/assets/libs/node-waves/waves.min.js')); ?>"></script>
    <script src="<?php echo e(asset('themes/admin/assets/libs/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('themes/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
    <script src="<?php echo e(asset('themes/admin/assets/js/plugins.js')); ?>"></script>

    <script src="<?php echo e(asset('themes/admin/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>

    <!-- Vector map-->
    <script src="<?php echo e(asset('themes/admin/assets/libs/jsvectormap/js/jsvectormap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('themes/admin/assets/libs/jsvectormap/maps/world-merc.js')); ?>"></script>

    <!--Swiper slider js-->
    <script src="<?php echo e(asset('themes/admin/assets/libs/swiper/swiper-bundle.min.j')); ?>s"></script>

    <!-- Dashboard init -->
    <script src="<?php echo e(asset('themes/admin/assets/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
    <!-- App js -->
    <script src="<?php echo e(asset('themes/admin/assets/js/app.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--datatable js-->
    <script src="<?php echo e(asset('themes/admin/assets/js/jquery.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>
    <script>
        new DataTable('#myTable')
    </script>
    <script src="<?php echo e(asset('themes/admin/assets/js/jquery.js')); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    
    <script>
        function changeStatus(nameTable, id, is_active) {
            $.ajax({
                url: '<?php echo e(route('updateStatus')); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
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

    <script>
        window.Echo.channel('order-cancel')
            .listen('OrderCancelRequested', (e) => {
                Swal.fire({
                    title: 'Thông báo hủy!',
                    text: `Đơn hàng bán ra ${e.order.slug} yêu cầu hủy`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            });
        window.Echo.channel('import-order-created')
            .listen('NewImportOrderCreated', (e) => {
                Swal.fire({
                    title: 'Đơn hàng nhập mới!',
                    text: `Đơn hàng nhập "${e.importOrder.slug}" yêu cầu thêm mới`,
                    icon: 'info',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            });

        window.Echo.channel('import-order-cancel')
            .listen('ImportOrderCancelRequested', (e) => {
                Swal.fire({
                    title: 'Thông báo hủy!',
                    text: `Đơn hàng nhập ${e.importOrder.slug} yêu cầu hủy`,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            });
    </script>


    <?php if(session('authorization')): ?>
        <?php echo e(session('authorization')); ?>

    <?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <div id="loading-overlay">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <script>
        // Show loading overlay on page transitions and form submits
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading on form submissions
            const forms = document.querySelectorAll('form:not(.no-loading)');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Kiểm tra xem form có class 'form-datalist' không
                    if (form.classList.contains('form-datalist')) {
                        // Nếu form không pass validation thì không hiện loading
                        if (!validateOrderForm()) {
                            return;
                        }
                    }
                    document.getElementById('loading-overlay').style.display = 'flex';
                });
            });

            // Show loading on page transitions (link clicks)
            document.addEventListener('click', function(e) {
                const target = e.target.closest('a');
                if (target &&
                    target.href &&
                    !target.href.includes('#') &&
                    !target.href.includes('javascript:') &&
                    target.target !== '_blank' &&
                    !target.classList.contains('no-loading')) {
                    document.getElementById('loading-overlay').style.display = 'flex';
                }
            });

            // Show loading on browser back/forward
            window.addEventListener('beforeunload', function(e) {
                if (!e.target.activeElement?.classList.contains('no-loading')) {
                    document.getElementById('loading-overlay').style.display = 'flex';
                }
            });

            // Hide loading when page is fully loaded
            window.addEventListener('load', function() {
                document.getElementById('loading-overlay').style.display = 'none';
            });
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\DuAnTotNghiep\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>