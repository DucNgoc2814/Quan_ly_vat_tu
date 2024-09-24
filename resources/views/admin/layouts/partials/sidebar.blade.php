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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSliders" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSliders">
                        <span data-key="t-layouts">Quản lý thanh trượt</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSliders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('sliders.index') }}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh sách thanh trượt</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sliders.create') }}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới thanh trượt</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarGalleries" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarGalleries">
                        <span data-key="t-layouts">Quản lý phòng trưng bày</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGalleries">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSuppliers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSuppliers">
                        <span data-key="t-layouts">Quản lý nhà cung cấp</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSuppliers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('quan-ly-tai-khoan.danh-sach-nha-cung-cap') }}" target="_blank"
                                    class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quan-ly-tai-khoan.danh-sach-da-an-nha-cup-cap') }}" target="_blank"
                                    class="nav-link" data-key="t-horizontal">Danh sách đã ẩn</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUnits" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarUnits">
                        <span data-key="t-layouts">Quản lý đơn vị</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUnits">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBrands" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarBrands">
                        <span data-key="t-layouts">Quản lý thương hiệu</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBrands">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAttributeValues" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarAttributeValues">
                        <span data-key="t-layouts">Quản lý thuộc tính giá trị</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAttributeValues">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPayments" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPayments">
                        <span data-key="t-layouts">Quản lý thanh toán</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPayments">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link menu-link text-warning" href="#sidebarContractTypes" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarContractTypes">
                        <span data-key="t-layouts">Quản lý loại hợp đồng</span> 
=======
                    <a class="nav-link menu-link" href="#sidebarContractTypes" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarContractTypes">
                        <span data-key="t-layouts">Quản lý loại hợp đồng</span>
>>>>>>> 94c31b33e6440523dcff8e4c1874171dcc1f070f
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarContractTypes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('ContractTypes.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">danh sách loại hợp đồng</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('ContractTypes.create')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới loại hợp đồng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCargoCarTypers" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarCargoCarTypers">
                        <span data-key="t-layouts">Quản lý lái xe</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCargoCarTypers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarVariations" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarVariations">
                        <span data-key="t-layouts">Quản lý biến thể</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarVariations">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCustomers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCustomers">
                        <span data-key="t-layouts">Quản lý khách hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCustomers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarContractStatus" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarContractStatus">
                        <span data-key="t-layouts">Quản lý trạng thái hợp đồng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarContractStatus">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCustomerRanks" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarCustomerRanks">
                        <span data-key="t-layouts">Quản lý xếp hạng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCustomerRanks">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCargoCars" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarCargoCars">
                        <span data-key="t-layouts">Quản lý xe chở hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCargoCars">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRoleEmployees" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarRoleEmployees">
                        <span data-key="t-layouts">Quản lý vai trò nhân viên</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRoleEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPermissionRoleEmployees" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarPermissionRoleEmployees">
                        <span data-key="t-layouts">Quản lý phân quyền</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPermissionRoleEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
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
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrderCanceled" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarOrderCanceled">
                        <span data-key="t-layouts">Quản lý đơn hàng đã hủy</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrderCanceled">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link text-warning" href="#sidebarTrips" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarTrips">
                        <span data-key="t-layouts">Quản lý vận chuyển</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTrips">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('CargoCars.index') }}" target="_blank" class="nav-link "
                                    data-key="t-horizontal">Danh sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('CargoCars.create') }}" target="_blank" class="nav-link"
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
                                <a href="{{ url('quan-ly-tai-khoan.danh-sach-nhan-vien') }}" target="_blank"
                                    class="nav-link" data-key="t-horizontal">Danh sách nhân viên</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarRequests" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarRequests">
                        <span data-key="t-layouts">Quản lý yêu cầu</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRequests">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Thêm mới</a>
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
                                <a href="{{route('order.index')}}" class="nav-link text-danger"
                                    data-key="t-horizontal">Đơn hàng bán ra</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Đơn hàng nhập vào</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-horizontal.html" class="nav-link"
                                    data-key="t-horizontal">Đơn hàng đã hủy</a>
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
