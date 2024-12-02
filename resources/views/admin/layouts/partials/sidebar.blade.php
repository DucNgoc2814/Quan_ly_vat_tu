<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('themes/admin/assets/images/gemo2.png') }}" alt="" height="180">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('themes/admin/assets/images/gemo2.png') }}" alt="" height="180">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <a href="{{ route('admin.dashboard') }}" class="d-block">
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
            @php
                $id = JWTAuth::setToken(Session::get('token'))->getPayload()->get('id');
                $permission_id = App\Models\Permission_role_employee::where('role_employee_id', $id)->get(
                    'permission_id',
                );
                $employees = collect($permission_id)->pluck('permission_id')->toArray();
            @endphp
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item"> <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-home-2-fill"></i> <span data-key="t-dashboards">Bảng điều khiển</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarGalleries" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarGalleries">
                        <i class="ri-product-hunt-fill"></i>
                        <span data-key="t-layouts">Sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGalleries">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link " data-key="t-horizontal">Quản lý
                                    sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link " data-key="t-horizontal">Danh
                                    mục sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('units.index') }}" class="nav-link " data-key="t-horizontal">Đơn
                                    vị tính</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand.index') }}" class="nav-link " data-key="t-horizontal">Thương
                                    hiệu</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('valueVariations.index') }}" class="nav-link"
                                    data-key="t-horizontal">Loại biến thể</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('inventories.index') }}" class="nav-link "
                                    data-key="t-horizontal">Kho hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarOrders">
                        <i class="ri-swap-box-fill"></i>
                        <span data-key="t-layouts">Quản lý bán hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link " data-key="t-horizontal">Đơn
                                    bán lẻ</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contract.index') }}" class="nav-link" data-key="t-horizontal">Danh
                                    sách hợp đồng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBrands" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarBrands">
                        <i class="ri-edit-box-fill"></i>
                        <span data-key="t-layouts">Quản lý nhập hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBrands">
                        <ul class="nav nav-sm flex-column">

                            <li class="nav-item">
                                <a href="{{ route('importOrder.index') }}" class="nav-link "
                                    data-key="t-horizontal">Quản lý phiếu nhập hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarEmployees" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarEmployees">
                        <i class="ri-file-user-fill"></i>
                        <span data-key="t-layouts">Quản lý nhân sự</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('employees.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh
                                    sách nhân sự</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employees.listPermissions') }}" class="nav-link "
                                    data-key="t-horizontal">Quyền truy cập nhân sự</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSliders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSliders">
                        <i class="ri-slideshow-3-fill"></i>
                        <span data-key="t-layouts">Quản lý nội dung</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSliders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('sliders.index') }}" class="nav-link "
                                    data-key="t-horizontal">Danh sách thanh trượt</a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSuppliers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSuppliers">
                        <i class="ri-team-fill"></i>
                        <span data-key="t-layouts">Đối tác</span>
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



                {{--
                <li class="nav-item">
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
                    <a class="nav-link menu-link" href="#sidebarTrips" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <i class="ri-treasure-map-fill"></i>
                        <span data-key="t-layouts">Quản lý vận chuyển</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTrips">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">

                                <a href="{{ route('trips.index') }}" class="nav-link" data-key="t-horizontal">Quản
                                    lý chuyến đi</a>
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
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebartk" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebartk">
                        <i class="ri-treasure-map-fill"></i>
                        <span data-key="t-layouts">Thống kê</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebartk">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">

                                <a href="{{ route('payment.index') }}" class="nav-link" data-key="t-horizontal">Thu
                                    chi</a>
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
