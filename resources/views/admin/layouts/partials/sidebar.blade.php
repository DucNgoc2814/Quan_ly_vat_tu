<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('themes/admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('themes/admin/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('themes/admin/assets/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('themes/admin/assets/images/logo-light.png') }}" alt="" height="17">
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
                    <a class="nav-link menu-link" href="#sidebarDashboards" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards"><span data-key="t-dashboards">Bảng điều khiển</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCategories">
                        <span data-key="t-layouts">Quản lý danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách danh mục</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Quản lý thương hiệu</a>
                            </li>
                        </ul>
                    </div>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Quản lý slide</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sliders.create') }}" class="nav-link"
                                    data-key="t-horizontal">Thêm mới thanh trượt</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarProducts">
                        <span data-key="t-layouts">Quản lý sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Quản lý đơn vị</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarFeedbacks" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarFeedbacks">
                        <span data-key="t-layouts">Quản lý phản hồi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarFeedbacks">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSuppliers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSuppliers">
                        <span data-key="t-layouts">Quản lý tài khoản</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSuppliers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('supplier.index') }}" class="nav-link"
                                    data-key="t-horizontal">Quản lý nhà cung cấp</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supplier.index') }}" class="nav-link"
                                    data-key="t-horizontal">Quản lý khách hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarContractTypes" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarContractTypes">
                        <span data-key="t-layouts">Quản lý hợp đồng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarContractTypes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách hợp đồng</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Lịch sử chuyển tiền</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCargoCarTypers" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarCargoCarTypers">
                        <span data-key="t-layouts">Quản lý xe</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCargoCarTypers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách xe</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Quản lý loại xe</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLocations" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLocations">
                        <span data-key="t-layouts">Quản lý địa điểm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLocations">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRoleEmployees" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarRoleEmployees">
                        <span data-key="t-layouts">Quản lý nhân viên</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRoleEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarOrders">
                        <span data-key="t-layouts">Quản lý đơn hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách đơn đặt</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Danh sách đơn mua</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDebts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDebts">
                        <span data-key="t-layouts">Quản lý công nợ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDebts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPaymentHistories" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarPaymentHistories">
                        <span data-key="t-layouts">Quản lý lịch sử thanh toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPaymentHistories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTripDetails" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarTripDetails">
                        <span data-key="t-layouts">Quản lý chi tiết chuyến đi</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTripDetails">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPermissons" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPermissons">
                        <span data-key="t-layouts">Quản lý quyền hạn</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPermissons">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDebtTypes" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDebtTypes">
                        <span data-key="t-layouts">Quản lý loại nợ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDebtTypes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
