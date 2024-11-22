@extends('admin.layouts.master')
@php
    if (!function_exists('formatCurrency')) {
        /**
         * Định dạng số thành tiền Việt Nam (VND)
         *
         * @param float $number
         * @return string
         */
        function formatCurrency($number)
        {
            return number_format($number, 0, ',', '.');
        }
    }

@endphp
@section('title')
    Dashboard
@endsection
@php
    use App\Models\Import_order;
    use App\Models\Order;
    $pendingCancelRequests = Import_order::where('status', 1)->whereNotNull('cancel_reason')->get();
    $orderCancelRequests = Order::whereNotNull('cancel_reason')->get();

    $pendingContracts = App\Models\Contract::where('contract_status_id', 4)->get();

    $pendingContractPdfs = session('pending_contract_pdfs', []);
    $currentTime = now()->timestamp;
    $twoHours = 2 * 60 * 60;
    $validContracts = array_filter($pendingContractPdfs, function ($item) use ($currentTime, $twoHours) {
        return $currentTime - $item['timestamp'] < $twoHours;
    });
    session(['pending_contract_pdfs' => $validContracts]);

@endphp
@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Xin chào!</h4>
                                <p class="text-muted mb-0">Chào mừng đến với thống kê trong tháng này của Gemo</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control border-0 dash-filter-picker shadow"
                                                    data-provider="flatpickr" data-range-date="true"
                                                    data-date-format="d M, Y"
                                                    data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-auto">
                                            <button type="button"
                                                class="btn btn-soft-danger waves-effect waves-light layout-rightside-btn"><i
                                                    class="ri-notification-2-line align-middle me-1"></i>
                                                Thông Báo Xác Nhận</button>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Doanh thu</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5
                                            class="text-success fs-14 mb-0  {{ $growthRateRevenue < 0 ? 'text-danger' : '' }} ">
                                            <i
                                                class="ri-arrow-right-{{ $growthRateRevenue < 0 ? 'down' : 'up' }}-line fs-13 align-middle "></i>
                                            {{ $growthRateRevenue }} %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($totalRevenueThisMonth - $totalRevenueImportThisMonth) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->




                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Đơn hàng nhập</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5
                                            class="text-success fs-14 mb-0  {{ $growthRateImportRevenue < 0 ? 'text-danger' : '' }} ">
                                            <i
                                                class="ri-arrow-right-{{ $growthRateImportRevenue < 0 ? 'down' : 'up' }}-line fs-13 align-middle "></i>
                                            {{ $growthRateImportRevenue }} %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($totalRevenueImportThisMonth) }} đ
                                        </h4>

                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Đơn hàng bán</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5
                                            class="text-success fs-14 mb-0  {{ $growthRateRevenue < 0 ? 'text-danger' : '' }} ">
                                            <i
                                                class="ri-arrow-right-{{ $growthRateRevenue < 0 ? 'down' : 'up' }}-line fs-13 align-middle "></i>
                                            {{ $growthRateRevenue }} %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($totalRevenueThisMonth) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Khách hàng</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5
                                            class="text-success fs-14 mb-0  {{ $growthRateCustomers < 0 ? 'text-danger' : '' }} ">
                                            <i
                                                class="ri-arrow-right-{{ $growthRateCustomers < 0 ? 'down' : 'up' }}-line fs-13 align-middle "></i>
                                            {{ $growthRateCustomers }} %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($totalCustomersThisMonth) }}
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                <div>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        ALL
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        1M
                                    </button>
                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                        6M
                                    </button>
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        1Y
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-light-subtle">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">$<span class="counter-value" data-target="22.89">0</span>k
                                            </h5>
                                            <p class="text-muted mb-0">Earnings</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="367">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Refunds</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                                            <h5 class="mb-1 text-success"><span class="counter-value"
                                                    data-target="18.92">0</span>%</h5>
                                            <p class="text-muted mb-0">Conversation Ratio</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="customer_impression_charts"
                                        data-colors='["--vz-primary", "--vz-success", "--vz-danger"]' class="apex-charts"
                                        dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <!-- card -->
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                        Export Report
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <!-- card body -->
                            <div class="card-body">

                                <div id="sales-by-locations" data-colors='["--vz-light", "--vz-success", "--vz-primary"]'
                                    style="height: 269px" dir="ltr"></div>

                                <div class="px-2 py-2 mt-1">
                                    <p class="mb-1">Canada <span class="float-end">75%</span></p>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                            style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75">
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                                    </p>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                            style="width: 47%" aria-valuenow="47" aria-valuemin="0" aria-valuemax="47">
                                        </div>
                                    </div>

                                    <p class="mt-3 mb-1">Russia <span class="float-end">82%</span>
                                    </p>
                                    <div class="progress mt-2" style="height: 6px;">
                                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                            style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="82">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold text-uppercase fs-12">Sort by:
                                            </span><span class="text-muted">Today<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">Yesterday</a>
                                            <a class="dropdown-item" href="#">Last 7 Days</a>
                                            <a class="dropdown-item" href="#">Last 30 Days</a>
                                            <a class="dropdown-item" href="#">This Month</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/products/img-1.png') }}"
                                                                alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1"><a
                                                                    href="apps-ecommerce-product-details.html"
                                                                    class="text-reset">Branded
                                                                    T-Shirts</a></h5>
                                                            <span class="text-muted">24 Apr
                                                                2021</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$29.00</h5>
                                                    <span class="text-muted">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">62</h5>
                                                    <span class="text-muted">Orders</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">510</h5>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$1,798</h5>
                                                    <span class="text-muted">Amount</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/products/img-2.png') }}"
                                                                alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1"><a
                                                                    href="apps-ecommerce-product-details.html"
                                                                    class="text-reset">Bentwood
                                                                    Chair</a></h5>
                                                            <span class="text-muted">19 Mar
                                                                2021</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$85.20</h5>
                                                    <span class="text-muted">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">35</h5>
                                                    <span class="text-muted">Orders</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal"><span
                                                            class="badge bg-danger-subtle text-danger">Out
                                                            of stock</span> </h5>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$2982</h5>
                                                    <span class="text-muted">Amount</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/products/img-3.png') }}"
                                                                alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1"><a
                                                                    href="apps-ecommerce-product-details.html"
                                                                    class="text-reset">Borosil Paper
                                                                    Cup</a></h5>
                                                            <span class="text-muted">01 Mar
                                                                2021</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$14.00</h5>
                                                    <span class="text-muted">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">80</h5>
                                                    <span class="text-muted">Orders</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">749</h5>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$1120</h5>
                                                    <span class="text-muted">Amount</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/products/img-4.png') }}"
                                                                alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1"><a
                                                                    href="apps-ecommerce-product-details.html"
                                                                    class="text-reset">One Seater
                                                                    Sofa</a></h5>
                                                            <span class="text-muted">11 Feb
                                                                2021</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$127.50</h5>
                                                    <span class="text-muted">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">56</h5>
                                                    <span class="text-muted">Orders</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal"><span
                                                            class="badge bg-danger-subtle text-danger">Out
                                                            of stock</span></h5>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$7140</h5>
                                                    <span class="text-muted">Amount</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/products/img-5.png') }}"
                                                                alt="" class="img-fluid d-block" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1"><a
                                                                    href="apps-ecommerce-product-details.html"
                                                                    class="text-reset">Stillbird
                                                                    Helmet</a></h5>
                                                            <span class="text-muted">17 Jan
                                                                2021</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$54</h5>
                                                    <span class="text-muted">Price</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">74</h5>
                                                    <span class="text-muted">Orders</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">805</h5>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">$3996</h5>
                                                    <span class="text-muted">Amount</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div
                                    class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Showing <span class="fw-semibold">5</span> of <span
                                                class="fw-semibold">25</span> Results
                                        </div>
                                    </div>
                                    <div class="col-sm-auto  mt-3 mt-sm-0">
                                        <ul
                                            class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link">←</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">→</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Report<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Download
                                                Report</a>
                                            <a class="dropdown-item" href="#">Export</a>
                                            <a class="dropdown-item" href="#">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/companies/img-1.png') }}"
                                                                alt="" class="avatar-sm p-2" />
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">
                                                                <a href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">iTest
                                                                    Factory</a>
                                                            </h5>
                                                            <span class="text-muted">Oliver
                                                                Tyler</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Bags and Wallets</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">8547</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$541200</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">32%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/companies/img-2.png') }}"
                                                                alt="" class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 my-1 fw-medium"><a
                                                                    href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Digitech
                                                                    Galaxy</a></h5>
                                                            <span class="text-muted">John
                                                                Roberts</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Watches</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">895</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$75030</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">79%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/companies/img-3.png') }}"
                                                                alt="" class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-gow-1">
                                                            <h5 class="fs-14 my-1 fw-medium"><a
                                                                    href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Nesta
                                                                    Technologies</a></h5>
                                                            <span class="text-muted">Harley
                                                                Fuller</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Bike Accessories</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">3470</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$45600</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">90%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/companies/img-8.png') }}"
                                                                alt="" class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 my-1 fw-medium"><a
                                                                    href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Zoetic
                                                                    Fashion</a></h5>
                                                            <span class="text-muted">James
                                                                Bowen</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Clothes</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">5488</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$29456</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">40%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/companies/img-5.png') }}"
                                                                alt="" class="avatar-sm p-2" />
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 my-1 fw-medium">
                                                                <a href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">Meta4Systems</a>
                                                            </h5>
                                                            <span class="text-muted">Zoe Dennis</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Furniture</span>
                                                </td>
                                                <td>
                                                    <p class="mb-0">4100</p>
                                                    <span class="text-muted">Stock</span>
                                                </td>
                                                <td>
                                                    <span class="text-muted">$11260</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 mb-0">57%<i
                                                            class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                    </h5>
                                                </td>
                                            </tr><!-- end -->
                                        </tbody>
                                    </table><!-- end table -->
                                </div>

                                <div
                                    class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Showing <span class="fw-semibold">5</span> of <span
                                                class="fw-semibold">25</span> Results
                                        </div>
                                    </div>
                                    <div class="col-sm-auto  mt-3 mt-sm-0">
                                        <ul
                                            class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                            <li class="page-item disabled">
                                                <a href="#" class="page-link">←</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a href="#" class="page-link">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a href="#" class="page-link">→</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div> <!-- .card-body-->
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Report<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Download
                                                Report</a>
                                            <a class="dropdown-item" href="#">Export</a>
                                            <a class="dropdown-item" href="#">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div id="store-visits-source"
                                    data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate
                                        Report
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Vendor</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2112</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/users/avatar-1.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Alex Smith</div>
                                                    </div>
                                                </td>
                                                <td>Clothes</td>
                                                <td>
                                                    <span class="text-success">$109.00</span>
                                                </td>
                                                <td>Zoetic Fashion</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">Paid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">5.0<span
                                                            class="text-muted fs-11 ms-1">(61
                                                            votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2111</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/users/avatar-2.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Jansh Brown</div>
                                                    </div>
                                                </td>
                                                <td>Kitchen Storage</td>
                                                <td>
                                                    <span class="text-success">$149.00</span>
                                                </td>
                                                <td>Micro Design</td>
                                                <td>
                                                    <span class="badge bg-warning-subtle text-warning">Pending</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.5<span
                                                            class="text-muted fs-11 ms-1">(61
                                                            votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2109</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/users/avatar-3.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Ayaan Bowen</div>
                                                    </div>
                                                </td>
                                                <td>Bike Accessories</td>
                                                <td>
                                                    <span class="text-success">$215.00</span>
                                                </td>
                                                <td>Nesta Technologies</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">Paid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.9<span
                                                            class="text-muted fs-11 ms-1">(89
                                                            votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2108</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/users/avatar-4.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Prezy Mark</div>
                                                    </div>
                                                </td>
                                                <td>Furniture</td>
                                                <td>
                                                    <span class="text-success">$199.00</span>
                                                </td>
                                                <td>Syntyce Solutions</td>
                                                <td>
                                                    <span class="badge bg-danger-subtle text-danger">Unpaid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.3<span
                                                            class="text-muted fs-11 ms-1">(47
                                                            votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2107</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/users/avatar-6.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Vihan Hudda</div>
                                                    </div>
                                                </td>
                                                <td>Bags and Wallets</td>
                                                <td>
                                                    <span class="text-success">$330.00</span>
                                                </td>
                                                <td>iTest Factory</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">Paid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.7<span
                                                            class="text-muted fs-11 ms-1">(161
                                                            votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->

        <div class="col-auto layout-rightside-col">
            <div class="overlay"></div>
            <div class="layout-rightside">
                <div class="card h-100 rounded-0">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <h6 class="text-muted mb-0 text-uppercase fw-semibold">Yêu Cầu Xác Nhận
                            </h6>
                        </div>

                        <div class="p-3 mt-2">
                            @foreach ($orderCancelRequests as $request)
                                <div class="col mb-3">
                                    <div class="card card-body">
                                        <div class="d-flex mb-4 align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-delete-bin-2-line text-danger fs-24"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h5 class="card-title mb-1">Yêu cầu hủy đơn hàng bán ra</h5>
                                            </div>
                                        </div>
                                        <p class="card-text text-muted">
                                            Đơn hàng - {{ $request->slug }}, yêu cầu hủy -
                                            {{ $request->cancel_reason }}
                                        </p>
                                        <div>
                                            <a href="{{ route('order.updateStatus', ['slug' => $request->slug]) }}"
                                                onclick="event.preventDefault(); document.getElementById('update-status-{{ $request->slug }}').submit();"
                                                class="btn btn-info btn-sm">Xác Nhận</a>
                                            <a href="{{ route('order.updateStatus', ['slug' => $request->slug]) }}"
                                                onclick="event.preventDefault(); document.getElementById('reject-status-{{ $request->slug }}').submit();"
                                                class="btn btn-danger btn-sm">Từ Chối</a>
                                            <form id="update-status-{{ $request->slug }}"
                                                action="{{ route('order.updateStatus', ['slug' => $request->slug]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="status" value="5">
                                            </form>
                                            <form id="reject-status-{{ $request->slug }}"
                                                action="{{ route('order.updateStatus', ['slug' => $request->slug]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="status" value="1">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($pendingNewOrders as $request)
                                <div class="col mb-3">
                                    <div class="card card-body">
                                        <div class="d-flex mb-4 align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="ri-information-line text-primary fs-24"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <h5 class="card-title mb-1">Yêu cầu thêm mới đơn hàng nhập:
                                                    {{ $request->importOrder->slug }}</h5>
                                            </div>
                                        </div>
                                        <p class="card-text text-muted">
                                            Sản phẩm:
                                        <ul>
                                            @foreach ($request->importOrder->newOrderRequests as $item)
                                                <li>{{ $item->variation->name }} - Số lượng: {{ $item->quantity }}</li>
                                            @endforeach
                                        </ul>
                                        </p>
                                        <div>
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="confirmImportOrder('{{ $request->importOrder->slug }}')">
                                                Xác Nhận
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="rejectImportOrder('{{ $request->importOrder->slug }}')">
                                                Từ Chối
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-3 mt-2">
                            <div id="cancelRequestsContainer">
                            </div>
                        </div>
                        <div class="mt-2">
                            @foreach ($pendingContracts as $contract)
                                <div class="col mb-3">
                                    <div class="card card-body">
                                        <div class="d-flex mb-4 align-items-center">
                                            <div class="flex-grow-1 ms-2">
                                                <h5 class="card-title mb-1">Yêu cầu xác nhận hợp đồng:
                                                    {{ $contract->contract_name }}</h5>
                                                <p>Khách hàng: {{ $contract->customer_name }}</p>
                                                <div class="mt-3">
                                                    <a href="/storage/{{ $contract->file }}" target="_blank"
                                                        class="btn btn-info btn-sm">Xem hợp đồng</a>
                                                    <form action="{{ route('contract.confirm', $contract->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">Xác
                                                            nhận</button>
                                                    </form>

                                                    <form action="{{ route('contract.reject', $contract->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Từ
                                                            chối</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        @foreach ($validContracts as $item)
                            <div class="col mb-3">
                                <div class="card card-body">
                                    <div class="d-flex mb-4 align-items-center">
                                        <div class="flex-grow-1 ms-2">
                                            <h5 class="card-title mb-1">Hợp đồng: {{ $item['contract']->contract_name }}
                                            </h5>
                                            <div class="mt-3">
                                                <a href="/storage/{{ $item['contract']->file_pdf }}" target="_blank"
                                                    class="btn btn-info btn-sm">
                                                    <i class="ri-eye-fill align-bottom me-2"></i>Xem hợp đồng
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div> <!-- end card-->
            </div> <!-- end .rightbar-->

        </div> <!-- end col -->
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        function confirmImportOrder(slug) {
            fetch("{{ route('importOrder.confirmOrder', ['slug' => ':slug']) }}".replace(':slug', slug), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Thành công',
                            text: data.message,
                            icon: 'success'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
        }

        function rejectImportOrder(slug) {
            fetch("{{ route('importOrder.rejectOrder', ['slug' => ':slug']) }}".replace(':slug', slug), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Đã từ chối',
                            text: data.message,
                            icon: 'success'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm để tạo danh sách sản phẩm

            function checkPendingRequests() {
                // Kiểm tra nếu có yêu cầu hủy
                if (@json($pendingCancelRequests).length > 0) {
                    showPendingCancelRequests();
                } else {
                    // Nếu không có yêu cầu hủy thì hiển thị yêu cầu thêm mới
                    showPendingNewOrders();
                }
            }

            // Hiển thị yêu cầu thêm mới hoặc hủy ngay khi trang dashboard load
            checkPendingRequests();

        });
    </script>
    <script>
        function checkPendingCancelRequests() {
            fetch("{{ route('importOrder.pendingCancelRequests') }}")
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('cancelRequestsContainer');
                    if (data.length > 0) {
                        data.forEach(request => {
                            const requestElement = document.createElement('div');
                            requestElement.className = 'col mb-3';
                            requestElement.innerHTML = `
                        <div class="card card-body">
                            <div class="d-flex mb-4 align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-delete-bin-2-line text-danger fs-24"></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h5 class="card-title mb-1">Yêu cầu hủy đơn hàng nhập vào</h5>
                                </div>
                            </div>
                            <p class="card-text text-muted">
                                Đơn hàng ${request.slug} yêu cầu hủy: ${request.cancel_reason}
                            </p>
                            <div>
                                <button onclick="handleCancelConfirm('${request.slug}')" class="btn btn-info btn-sm">Xác nhận hủy</button>
                                <button onclick="handleCancelReject('${request.slug}')" class="btn btn-danger btn-sm">Từ chối</button>
                            </div>
                        </div>
                    `;
                            container.appendChild(requestElement);
                        });
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkPendingCancelRequests();
        });
    </script>
@endsection
