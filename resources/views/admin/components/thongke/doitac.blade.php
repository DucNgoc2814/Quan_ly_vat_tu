@extends('admin.layouts.master')

@section('title')
    Thống kê đối tác
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thống kê đối tác</h4>
            </div>
        </div>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="row">
        <!-- Thống kê nhà cung cấp -->
        <div class="col-xl-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted mb-1">Top nhà cung cấp tháng</h6>
                            <h4>{{ $topPartners['supplier']->name ?? 'Chưa có' }}</h4>
                            <p class="mb-0">
                                Doanh số: {{ number_format($topPartners['supplier']->total_value ?? 0) }} đ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê khách hàng -->
        <div class="col-xl-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-muted mb-1">Top khách hàng tháng</h6>
                            <h4>{{ $topPartners['customer']->name ?? 'Chưa có' }}</h4>
                            <p class="mb-0">
                                Doanh số: {{ number_format($topPartners['customer']->total_value ?? 0) }} đ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thống kê tài chính -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Thống kê tài chính đối tác</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#supplier-finance" role="tab">
                                Nhà cung cấp
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#customer-finance" role="tab">
                                Khách hàng
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="supplier-finance" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Tổng phải trả</th>
                                            <th>Đã thanh toán</th>
                                            <th>Còn nợ</th>
                                            <th>Giá trị đơn TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($financeStats['suppliers'] as $stat)
                                        <tr>
                                            <td>{{ $stat->name }}</td>
                                            <td>{{ number_format($stat->total_payable) }} đ</td>
                                            <td>{{ number_format($stat->total_paid) }} đ</td>
                                            <td>{{ number_format($stat->remaining_debt) }} đ</td>
                                            <td>{{ number_format($stat->average_order_value) }} đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="customer-finance" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Tên khách hàng</th>
                                            <th>Tổng phải thu</th>
                                            <th>Đã thanh toán</th>
                                            <th>Còn nợ</th>
                                            <th>Giá trị đơn TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($financeStats['customers'] as $stat)
                                        <tr>
                                            <td>{{ $stat->name }}</td>
                                            <td>{{ number_format($stat->total_payable) }} đ</td>
                                            <td>{{ number_format($stat->total_paid) }} đ</td>
                                            <td>{{ number_format($stat->remaining_debt) }} đ</td>
                                            <td>{{ number_format($stat->average_order_value) }} đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thống kê sản phẩm -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Thống kê sản phẩm theo đối tác</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#supplier-products" role="tab">
                                Nhà cung cấp
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#customer-products" role="tab">
                                Khách hàng
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="supplier-products" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Nhà cung cấp</th>
                                            <th>Sản phẩm</th>
                                            <th>Số đơn hàng</th>
                                            <th>Tổng số lượng</th>
                                            <th>Tổng giá trị</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productStats['suppliers'] as $stat)
                                        <tr>
                                            <td>{{ $stat->partner_name }}</td>
                                            <td>{{ $stat->product_name }}</td>
                                            <td>{{ $stat->order_count }}</td>
                                            <td>{{ number_format($stat->total_quantity) }}</td>
                                            <td>{{ number_format($stat->total_value) }} đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="customer-products" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Khách hàng</th>
                                            <th>Sản phẩm</th>
                                            <th>Số đơn hàng</th>
                                            <th>Tổng số lượng</th>
                                            <th>Tổng giá trị</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productStats['customers'] as $stat)
                                        <tr>
                                            <td>{{ $stat->partner_name }}</td>
                                            <td>{{ $stat->product_name }}</td>
                                            <td>{{ $stat->order_count }}</td>
                                            <td>{{ number_format($stat->total_quantity) }}</td>
                                            <td>{{ number_format($stat->total_value) }} đ</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Code cũ giữ nguyên... -->
@endsection

@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $('.myTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
                }
            });
        });

        // Code cũ giữ nguyên...
    </script>
@endpush
