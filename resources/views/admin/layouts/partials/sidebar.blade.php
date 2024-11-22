<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('themes/admin/assets/images/a-removebg-preview (1).png') }}" alt="" height="180">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('themes/admin/assets/images/a-removebg-preview (1).png') }}" alt="" height="180">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            {{-- <span class="logo-sm">
                <img src="{{ asset('themes/admin/assets/images/gemo2.png') }}" alt="" height="180">
            </span> --}}
            <a href="das" class="d-block">
                <img src="{{ asset('themes/admin/assets/images/gemo2.png') }}" alt="" height="150">
            </a>
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
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-home-2-fill"></i>
                        <span data-key="t-dashboards">Bảng điều khiển</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEmployees" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarEmployees">
                        <i class="ri-file-user-fill"></i>
                        <span data-key="t-layouts">Quản lý nhân sự</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('employees.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách nhân sự</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employees.listPermissions') }}" class="nav-link "
                                    data-key="t-horizontal">Quyền truy cập nhân sự</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCategories" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarCategories">
                        <i class="ri-stack-fill"></i>
                        <span data-key="t-layouts">Quản lý danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCategories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách danh mục</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSliders" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarSliders">
                        <i class="ri-slideshow-3-fill"></i>
                        <span data-key="t-layouts">Quản lý thanh trượt</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSliders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('sliders.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách thanh trượt</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarGalleries" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarGalleries">
                        <i class="ri-product-hunt-fill"></i>
                        <span data-key="t-layouts">Quản lý sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGalleries">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('units.index') }}" class="nav-link "
                                    data-key="t-horizontal">Quản lý đơn vị</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand.index') }}" class="nav-link "
                                    data-key="t-horizontal">Quản lý thương hiệu</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventories.index') }}" class="nav-link "
                                    data-key="t-horizontal">Quản lý kho hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('valueVariations.index') }}" class="nav-link"
                                    data-key="t-horizontal">Quản lý loại biến thể</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSuppliers" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarSuppliers">
                        <i class="ri-team-fill"></i>
                        <span data-key="t-layouts">Quản lý đối tác</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSuppliers">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ route('suppliers.index') }}" class="nav-link"
                                    data-key="t-horizontal">Danh sách nhà cung cấp</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.index') }}" class="nav-link"
                                    data-key="t-horizontal">Danh sách khách hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBrands" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarBrands">
                        <i class="ri-edit-box-fill"></i>
                        <span data-key="t-layouts">Quản lý hợp đồng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBrands">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('contract.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách hợp đồng</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link "
                                    data-key="t-horizontal">Lịch sử chuyển tiền</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarOrders">
                        <i class="ri-swap-box-fill"></i>
                        <span data-key="t-layouts">Quản lý xuất nhập</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link "
                                    data-key="t-horizontal">Đơn hàng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('importOrder.index') }}" class="nav-link "
                                    data-key="t-horizontal">Quản lý phiếu nhập hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDebts" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarDebts">
                        <i class="ri-hand-coin-fill"></i>
                        <span data-key="t-layouts">Quản lý công nợ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDebts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link "
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPaymentHistories"
                        data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarPaymentHistories">
                        <i class="ri-wallet-fill"></i>
                        <span data-key="t-layouts">Quản lý lịch sử thanh toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPaymentHistories">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link "
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTrips" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <i class="ri-truck-fill"></i>
                        <span data-key="t-layouts">Quản lý vận chuyển</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTrips">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">

                                <a href="{{ route('trips.index') }}" class="nav-link" data-key="t-horizontal">Danh
                                    sách chuyến đi</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('CargoCars.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách xe</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cargo_car_types.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách loại xe</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('logs.index') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <i class="ri-settings-6-fill"></i>
                        <span data-key="t-layouts">Lịch sử thao tác</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
