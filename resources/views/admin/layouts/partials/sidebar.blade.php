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
  @php
                $id = JWTAuth::setToken(Session::get('token'))->getPayload()->get('id');
                $permission_id = App\Models\Permission_role_employee::where('role_employee_id', $id)->get('permission_id');
$employees = collect($permission_id)->pluck('permission_id')->toArray();
            @endphp
            <ul class="navbar-nav" id="navbar-nav">
               @if(in_array(1, $employees))
                <li class="nav-item"> <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                     <i class="ri-home-2-fill"></i> <span data-key="t-dashboards">Bảng điều khiển</span>
                    </a>
                </li>
                @endif
                  @if( in_array(4, $employees) || in_array(5, $employees) || in_array(6, $employees) || in_array(7, $employees) || in_array(8, $employees) || in_array(9, $employees) )
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
                @endif
                @if( in_array(111, $employees) || in_array(112, $employees) || in_array(113, $employees) || in_array(114, $employees) || in_array(115, $employees) || in_array(116, $employees) )
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
                @endif
@if( in_array(33, $employees) || in_array(34, $employees) || in_array(35, $employees) || in_array(36, $employees) || in_array(37, $employees) || in_array(38, $employees) || in_array(39, $employees) )
                <li class="nav-item">
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
                </li>
                @endif
@if( in_array(79, $employees) || in_array(80, $employees) || in_array(81, $employees) || in_array(82, $employees) || in_array(83, $employees) || in_array(99, $employees) || in_array(100, $employees) || in_array(101, $employees) || in_array(102, $employees) || in_array(103, $employees) || in_array(104, $employees) || in_array(40, $employees) || in_array(41, $employees) || in_array(42, $employees) || in_array(43, $employees) || in_array(44, $employees) || in_array(131, $employees) || in_array(132, $employees) || in_array(133, $employees) || in_array(134, $employees) || in_array(135, $employees) || in_array(136, $employees) || in_array(137, $employees) || in_array(138, $employees) || in_array(139, $employees) || in_array(140, $employees) || in_array(141, $employees) || in_array(142, $employees) || in_array(143, $employees) || in_array(144, $employees) )
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
                @endif
@if( in_array(10, $employees) || in_array(11, $employees) || in_array(12, $employees) || in_array(13, $employees) || in_array(14, $employees) || in_array(15, $employees) || in_array(16, $employees) || in_array(17, $employees) || in_array(78, $employees) )
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
                @endif
@if( in_array(45, $employees) || in_array(46, $employees) || in_array(47, $employees) || in_array(48, $employees) || in_array(49, $employees) || in_array(50, $employees) || in_array(51, $employees) || in_array(52, $employees) || in_array(53, $employees) || in_array(54, $employees) || in_array(55, $employees) || in_array(56, $employees) || in_array(57, $employees) || in_array(58, $employees) || in_array(59, $employees) )
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
                @endif
@if( in_array(60, $employees) || in_array(61, $employees) || in_array(62, $employees) || in_array(63, $employees) || in_array(64, $employees) || in_array(65, $employees) || in_array(66, $employees) || in_array(67, $employees) || in_array(84, $employees) || in_array(85, $employees) || in_array(86, $employees) || in_array(87, $employees) || in_array(88, $employees) || in_array(89, $employees) || in_array(90, $employees) || in_array(91, $employees) || in_array(92, $employees) || in_array(93, $employees) || in_array(94, $employees) || in_array(95, $employees) || in_array(96, $employees) || in_array(97, $employees) || in_array(98, $employees) )
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
                @endif
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
@if( in_array(123, $employees) || in_array(124, $employees) || in_array(125, $employees) || in_array(126, $employees) || in_array(127, $employees) || in_array(128, $employees) )
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTrips" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <i class="ri-treasure-map-fill"></i>
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
                @endif
@if( in_array(131, $employees) || in_array(132, $employees) || in_array(133, $employees) || in_array(134, $employees) || in_array(135, $employees) || in_array(136, $employees) )
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('logs.index') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <i class="ri-settings-6-fill"></i>
                        <span data-key="t-layouts">Lịch sử thao tác</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
