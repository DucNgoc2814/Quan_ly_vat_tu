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
                                            Tổng doanh thu</p>
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
                                            Tổng chi phí</p>
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
                                            Tổng doanh thu thực</p>
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
                                            {{ formatCurrency($totalRevenueThisMonth - $totalRevenueImportThisMonth) }}
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
                                            Lợi nhuận</p>
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
                                <h4 class="card-title mb-0 flex-grow-1">Thống kê theo năm</h4>

                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-light-subtle">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="7585">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Tổng đơn hàng xuất</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">$<span class="counter-value" data-target="22.9">0</span>k
                                            </h5>
                                            <p class="text-muted mb-0">Tổng đơn hàng nhập</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-3">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value" data-target="367">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Tổng doanh thu</p>
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
                        <!-- card123 -->
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Tỉ lệ chuyển đổi</h4>
                                <div class="flex-shrink-0">
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div id="store-visits-source"
                                    data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div> <!-- .card-->
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <div class="col-xl-8 w-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                            <div class="flex-shrink-0">

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Mã đơn</th>
                                            <th scope="col">Người mua</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Tổng tiền</th>
                                            <th scope="col">Đã trả</th>
                                            <th scope="col">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 0;
                                        @endphp
                                        @foreach ($latestOrders as $latestOrder)
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">{{ $stt += 1 }}</a>
                                                </td>
                                                <td>
                                                    <span class="text-success">{{ $latestOrder->slug   }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('themes/admin/assets/images/users/avatar-1.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">{{ $latestOrder->customer_name   }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ $latestOrder->number_phone   }}</td>

                                                <td>{{ $latestOrder->total_amount   }}</td>
                                                <td>{{ $latestOrder->paid_amount   }}</td>
                                                <td>
                                                    @if ($latestOrder->status_id == 1)
                                                    <span class="badge bg-warning-subtle text-warning">Chờ xử lý</span>
                                                    @elseif ($latestOrder->status_id == 2)
                                                    <span class="badge bg-primary-subtle text-primary">Đã xác nhận</span>
                                                    @elseif ($latestOrder->status_id == 3)
                                                    <span class="badge bg-info-subtle text-info">Đang giao</span>
                                                    @elseif ($latestOrder->status_id == 4)
                                                    <span class="badge bg-success-subtle text-success">Thành công</span>
                                                    @elseif ($latestOrder->status_id ==5)
                                                    <span class="badge bg-danger-subtle text-danger">Đã hủy</span>
                                                    @endif
                                                </td>
                                            </tr><!-- end tr -->
                                        @endforeach
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
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
                                                    {{ $contract->contract_number }}</h5>
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

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="showRejectModal({{ $contract->id }})">Từ chối</button>
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
                                            <h5 class="card-title mb-1">Hợp đồng: {{ $item['contract']->contract_number }}
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


<div class="modal fade" id="rejectReasonModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lý do từ chối hợp đồng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea id="rejectReason" class="form-control" rows="3" placeholder="Nhập lý do từ chối..."></textarea>
                <input type="hidden" id="contractId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitRejectReason()">Xác nhận</button>
            </div>
        </div>
    </div>
</div>


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

    <script>
        function showRejectModal(contractId) {
            $('#contractId').val(contractId);
            $('#rejectReasonModal').modal('show');
        }

        function submitRejectReason() {
            const contractId = $('#contractId').val();
            const reason = $('#rejectReason').val();

            $.ajax({
                url: "{{ route('contract.reject', '') }}/" + contractId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    reason: reason
                },
                success: function(response) {
                    if (response.success) {
                        $('#rejectReasonModal').modal('hide');
                        window.location.reload();
                    }
                }
            });
        }
        // <+====================POSEIDON====================+>
        function getChartColorsArray(e) {
            if (null !== document.getElementById(e)) {
                var t = document.getElementById(e).getAttribute('data-colors')
                if (t)
                    return (t = JSON.parse(t)).map(function(e) {
                        var t = e.replace(' ', '')
                        return -1 === t.indexOf(',') ?
                            getComputedStyle(
                                document.documentElement
                            ).getPropertyValue(t) || t :
                            2 == (e = e.split(',')).length ?
                            'rgba(' +
                            getComputedStyle(
                                document.documentElement
                            ).getPropertyValue(e[0]) +
                            ',' +
                            e[1] +
                            ')' :
                            t
                    })
                console.warn('data-colors atributes not found on', e)
            }
        }
        var today = new Date();
        var currentMonth = today.getMonth();
        var months = [
            'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
        ];
        var ordersPerMonthN = @json($ordersPerMonthN);
        var ordersPerMonthX = @json($ordersPerMonthX);
        var totalAmoutx = @json($totalAmoutx);
        var statusValues = @json($statusValues);
        console.log(statusValues)
        var reorderedMonths = months.slice(currentMonth).concat(months.slice(0, currentMonth));
        var options,
            chart,
            linechartcustomerColors = getChartColorsArray('customer_impression_charts'),
            chartDonutBasicColors =
            (linechartcustomerColors &&
                ((options = {
                        series: [{
                                name: 'Đơn xuất',
                                type: 'area',
                                data: ordersPerMonthX
                            },
                            {
                                name: 'Đơn nhập',
                                type: 'bar',
                                data: ordersPerMonthN

                            },
                            {
                                name: 'Doanh thu',
                                type: 'line',
                                data: totalAmoutx
                            }
                        ],
                        chart: {
                            height: 370,
                            type: 'line',
                            toolbar: {
                                show: !1
                            }
                        },
                        stroke: {
                            curve: 'straight',
                            dashArray: [0, 0, 8],
                            width: [2, 0, 2.2]
                        },
                        fill: {
                            opacity: [0.1, 0.9, 1]
                        },
                        markers: {
                            size: [0, 0, 0],
                            strokeWidth: 2,
                            hover: {
                                size: 4
                            }
                        },
                        xaxis: {
                            categories: reorderedMonths,
                            axisTicks: {
                                show: !1
                            },
                            axisBorder: {
                                show: !1
                            }
                        },
                        grid: {
                            show: !0,
                            xaxis: {
                                lines: {
                                    show: !0
                                }
                            },
                            yaxis: {
                                lines: {
                                    show: !1
                                }
                            },
                            padding: {
                                top: 0,
                                right: -2,
                                bottom: 15,
                                left: 10
                            }
                        },
                        legend: {
                            show: !0,
                            horizontalAlign: 'center',
                            offsetX: 0,
                            offsetY: -5,
                            markers: {
                                width: 9,
                                height: 9,
                                radius: 6
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 0
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '30%',
                                barHeight: '70%'
                            }
                        },
                        colors: linechartcustomerColors,
                        tooltip: {
                            shared: !0,
                            y: [{
                                    formatter: function(e) {
                                        return void 0 !== e ? e.toFixed(0) : e
                                    }
                                },
                                {
                                    formatter: function(e) {
                                        return void 0 !== e ?
                                            e.toFixed(2) :
                                            e
                                    }
                                },
                                {
                                    formatter: function(e) {
                                        return void 0 !== e ?
                                            e.toFixed(0) + 'Triệu' :
                                            e
                                    }
                                }
                            ]
                        }
                    }),
                    (chart = new ApexCharts(
                        document.querySelector('#customer_impression_charts'),
                        options
                    )).render()),
                getChartColorsArray('store-visits-source')),
            worldemapmarkers =
            (chartDonutBasicColors &&
                ((options = {
                        series: statusValues,
                        labels: ['Trong quá trình', 'Thành công', 'Hủy'],
                        chart: {
                            height: 333,
                            type: 'donut'
                        },
                        legend: {
                            position: 'bottom'
                        },
                        stroke: {
                            show: !1
                        },
                        dataLabels: {
                            dropShadow: {
                                enabled: !1
                            }
                        },
                        colors: chartDonutBasicColors
                    }),
                    (chart = new ApexCharts(
                        document.querySelector('#store-visits-source'),
                        options
                    )).render()),
                '')

        function loadCharts() {
            var e = getChartColorsArray('sales-by-locations')
            e &&
                ((document.getElementById('sales-by-locations').innerHTML = ''),
                    (worldemapmarkers = ''),
                    (worldemapmarkers = new jsVectorMap({
                        map: 'world_merc',
                        selector: '#sales-by-locations',
                        zoomOnScroll: !1,
                        zoomButtons: !1,
                        selectedMarkers: [0, 5],
                        regionStyle: {
                            initial: {
                                stroke: '#9599ad',
                                strokeWidth: 0.25,
                                fill: e[0],
                                fillOpacity: 1
                            }
                        },
                        markersSelectable: !0,
                        markers: [{
                                name: 'Palestine',
                                coords: [31.9474, 35.2272]
                            },
                            {
                                name: 'Russia',
                                coords: [61.524, 105.3188]
                            },
                            {
                                name: 'Canada',
                                coords: [56.1304, -106.3468]
                            },
                            {
                                name: 'Greenland',
                                coords: [71.7069, -42.6043]
                            }
                        ],
                        markerStyle: {
                            initial: {
                                fill: e[1]
                            },
                            selected: {
                                fill: e[2]
                            }
                        },
                        labels: {
                            markers: {
                                render: function(e) {
                                    return e.name
                                }
                            }
                        }
                    })))
        };
        (window.onresize = function() {
            setTimeout(() => {
                loadCharts()
            }, 0)
        }),
        loadCharts()
        var overlay,
            swiper = new Swiper('.vertical-swiper', {
                slidesPerView: 2,
                spaceBetween: 10,
                mousewheel: !0,
                loop: !0,
                direction: 'vertical',
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: !1
                }
            }),
            layoutRightSideBtn = document.querySelector('.layout-rightside-btn')
        layoutRightSideBtn &&
            (Array.from(document.querySelectorAll('.layout-rightside-btn')).forEach(
                    function(e) {
                        var t = document.querySelector('.layout-rightside-col')
                        e.addEventListener('click', function() {
                            t.classList.contains('d-block') ?
                                (t.classList.remove('d-block'), t.classList.add('d-none')) :
                                (t.classList.remove('d-none'), t.classList.add('d-block'))
                        })
                    }
                ),
                window.addEventListener('resize', function() {
                    var e = document.querySelector('.layout-rightside-col')
                    e &&
                        Array.from(
                            document.querySelectorAll('.layout-rightside-btn')
                        ).forEach(function() {
                            window.outerWidth < 1699 || 3440 < window.outerWidth ?
                                e.classList.remove('d-block') :
                                1699 < window.outerWidth && e.classList.add('d-block')
                        }),
                        'semibox' == document.documentElement.getAttribute('data-layout') &&
                        (e.classList.remove('d-block'), e.classList.add('d-none'))
                }),
                (overlay = document.querySelector('.overlay'))) &&
            document.querySelector('.overlay').addEventListener('click', function() {
                1 ==
                    document
                    .querySelector('.layout-rightside-col')
                    .classList.contains('d-block') &&
                    document
                    .querySelector('.layout-rightside-col')
                    .classList.remove('d-block')
            }),
            window.addEventListener('load', function() {
                var e = document.querySelector('.layout-rightside-col')
                e &&
                    Array.from(
                        document.querySelectorAll('.layout-rightside-btn')
                    ).forEach(function() {
                        window.outerWidth < 1699 || 3440 < window.outerWidth ?
                            e.classList.remove('d-block') :
                            1699 < window.outerWidth && e.classList.add('d-block')
                    }),
                    'semibox' == document.documentElement.getAttribute('data-layout') &&
                    1699 < window.outerWidth &&
                    (e.classList.remove('d-block'), e.classList.add('d-none'))
            })

        // <+====================POSEIDON====================+>
    </script>
@endsection
