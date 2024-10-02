<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(asset('themes/admin/assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('themes/admin/assets/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(asset('themes/admin/assets/assets/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset('themes/admin/assets/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarDashboards" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards"><span data-key="t-dashboards">Bảng điều khiển</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCategories">
                        <span data-key="t-layouts">Quản lý danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('category.index')); ?>"  class="nav-link text-danger"
                                    data-key="t-horizontal">Danh sách danh mục</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarSliders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSliders">
                        <span data-key="t-layouts">Quản lý thanh trượt</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSliders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarGalleries" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarGalleries">
                        <span data-key="t-layouts">Quản lý sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGalleries">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('product.index')); ?>"  class="nav-link text-danger"
                                    data-key="t-horizontal">Danh sách sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html"  class="nav-link text-danger"
                                    data-key="t-horizontal">Quản lý đơn vị</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html"  class="nav-link text-danger"
                                    data-key="t-horizontal">Quản lý thương hiệu</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarFeedbacks" role="button"
                        aria-expanded="false" aria-controls="sidebarFeedbacks">
                        <span data-key="t-layouts">Danh sách phản hồi</span>
                    </a>
                    
                </li>

                
                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarSuppliers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSuppliers">
                        <span data-key="t-layouts">Quản lý tài khoản</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSuppliers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('suppliers.index')); ?>" class="nav-link"
                                    data-key="t-horizontal">Danh sách nhà cung cấp</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('suppliers.index')); ?>" class="nav-link"
                                    data-key="t-horizontal">Danh sách khách hàng</a>
                            </li>
                         
                        </ul>
                    </div>
                </li>
               
          
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarContracts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarContracts">
                        <span data-key="t-layouts">Quản lý hợp đồng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarContracts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách hợp đồng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCargoCars" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCargoCars">
                        <span data-key="t-layouts">Quản lý xe</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCargoCars">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html"  class="nav-link text-danger"
                                    data-key="t-horizontal">Danh sách xe</a>
                            </li>
                        </ul>
                    </div>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link text-danger menu-link" href="#sidebarDebts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDebts">
                        <span data-key="t-layouts">Quản lý công nợ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDebts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html"  class="nav-link text-danger"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTrips" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <span data-key="t-layouts">Quản lý chuyến đi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTrips">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEmployees" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarEmployees">
                        <span data-key="t-layouts">Quản lý nhân viên</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('employees.index')); ?>" class="nav-link"
                                    data-key="t-horizontal">Danh sách nhân viên</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                       <span data-key="t-apps"> Quản lý đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarCalendar" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarCalendar" data-key="t-calender">
                                    Đơn hàng nhập
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCalendar1">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-calendar.html" class="nav-link" data-key="t-main-calender">
                                                thêm  </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-calendar-month-grid.html" class="nav-link"
                                                data-key="t-month-grid"> danh sách </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCalendar" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarCalendar" data-key="t-calender">
                                    Đơn hàng bán
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCalendar2">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-calendar-month-grid.html" class="nav-link"
                                                data-key="t-month-grid"> danh sách </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCalendar" class="nav-link" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarCalendar3" data-key="t-calender">
                                    Đơn đã hủy
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<?php /**PATH C:\laragon\www\DuAnTotNghiep\resources\views/admin/layouts/partials/sidebar.blade.php ENDPATH**/ ?>