@extends('admin.layouts.master')

@section('title')
    Thống kê sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thống kê sản phẩm</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Top 5 sản phẩm bán chạy -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Top 5 sản doanh thu cao nhất</h5>
                    <div class="d-flex align-items-center">
                        <div class="form-group me-2">
                            <input type="date" id="startDate1" name="start_date1" class="form-control"
                                value="{{ $startDate }}">
                        </div>
                        <div class="form-group me-2">
                            <input type="date" id="endDate1" name="end_date1" class="form-control"
                                value="{{ $endDate }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped fs-12">
                            <thead>
                                <tr>
                                    <th>Mã nhập hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng đã bán</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody id="topProductsBody">
                                @foreach ($topProducts as $product)
                                    <tr>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->variation_name }}</td>
                                        <td>{{ $product->total_sold }}</td>
                                        <td>{{ number_format($product->total_revenue) }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê tồn kho -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0" style="line-height: 39px">Top 5 sản phẩm tồn kho nhiều nhất</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped fs-12">
                            <thead>
                                <tr>
                                    <th>Mã nhập hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Tồn kho</th>
                                    <th>Lần nhập gần nhất</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventory as $item)
                                    <tr>
                                        <td>{{ $item->sku }}</td>
                                        <td>{{ $item->variation_name }}</td>
                                        <td>{{ $item->current_stock }}</td>
                                        <td>{{ $item->last_import_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Thống kê chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="myTable table table-striped fs-13" id="myTable">
                            <thead>
                                <tr>
                                    <th>Mã nhập hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn vị tính</th>
                                    <th>Số lượng đã bán</th>
                                    <th>Số đơn hàng</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productStats as $stat)
                                    <tr>
                                        <td>{{ $stat->sku }}</td>
                                        <td>{{ $stat->variation_name }}</td>
                                        <td>{{ $stat->unit_name }}</td>
                                        <td>{{ number_format($stat->total_sold) }}</td>
                                        <td>{{ number_format($stat->total_orders) }}</td>
                                        <td>{{ number_format($stat->total_revenue) }} đ</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Biểu đồ sản phẩm bán và nhập</h4>
                    <div class="d-flex align-items-center">
                        <div class="form-group me-2">
                            <select id="chartVariationSelect" class="form-control">
                                <option value="">Tất cả sản phẩm</option>
                                @foreach($variations as $variation)
                                    <option value="{{ $variation->id }}">{{ $variation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group me-2">
                            <input type="date" id="chartStartDate" class="form-control form-control-sm"
                                style="width: 120px;" value="{{ $startDate }}">
                        </div>
                        <div class="form-group me-2">
                            <input type="date" id="chartEndDate" class="form-control form-control-sm"
                                style="width: 120px;" value="{{ $endDate }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="productChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatCurrency(value) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(value);
            }

            function updateTopProducts(startDate1, endDate1) {
                $.ajax({
                    url: '{{ route('thongKeSanPham') }}',
                    method: 'GET',
                    data: {
                        variation_id: variationId,
                        start_date1: startDate1,
                        end_date1: endDate1
                    },
                    success: function(response) {
                        let topProductsBody = $('#topProductsBody');
                        topProductsBody.empty();
                        response.topProducts.forEach(product => {
                            topProductsBody.append(`
    <tr>
        <td>${product.sku}</td>
        <td>${product.variation_name}</td>
        <td>${product.total_sold}</td>
        <td>${formatCurrency(product.total_revenue)}</td>
    </tr>
    `);
                        });
                        updateChart(response.productData, response.importData);
                    }
                });
            }

            function updateChart(productData, importData) {
                const productLabels = productData.map(data => data.date);
                const productSold = productData.map(data => data.total_sold);
                const productImported = importData.map(data => data.total_imported);

                const ctx = document.getElementById('productChart').getContext('2d');
                const productChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: productLabels,
                        datasets: [{
                                label: 'Số lượng bán',
                                data: productSold,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                            },
                            {
                                label: 'Số lượng nhập',
                                data: productImported,
                                borderColor: 'rgba(192, 75, 75, 1)',
                                backgroundColor: 'rgba(192, 75, 75, 0.2)',
                                fill: true,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            $('#startDate1, #endDate1').on('change', function() {
                let startDate1 = $('#startDate1').val();
                let endDate1 = $('#endDate1').val();
                updateTopProducts(startDate1, endDate1);
            });

            $(document).ready(function() {
                let startDate1 = $('#startDate1').val();
                let endDate1 = $('#endDate1').val();
                updateTopProducts(startDate1, endDate1);
            });
        });
    </script>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let myChart = null;

            function updateChartData() {
                const variationId = $('#chartVariationSelect').val();
                const startDate = $('#chartStartDate').val();
                const endDate = $('#chartEndDate').val();

                console.log('Updating chart with:', {
                    variationId,
                    startDate,
                    endDate
                });

                if (!startDate || !endDate || new Date(startDate) > new Date(endDate)) {
                    alert('Vui lòng chọn khoảng thời gian hợp lệ');
                    return;
                }

                $.ajax({
                    url: '{{ route('thongKeSanPham') }}',
                    method: 'GET',
                    data: {
                        variation_id: variationId,
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        console.log('Response:', response);

                        // Always destroy existing chart
                        if (myChart) {
                            myChart.destroy();
                        }

                        const ctx = document.getElementById('productChart');
                        if (!ctx) {
                            console.error('Canvas element not found');
                            return;
                        }

                        myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                datasets: [{
                                        label: 'Số lượng bán',
                                        data: response.productData.map(item => ({
                                            x: item.date,
                                            y: parseInt(item.total_sold)
                                        })),
                                        borderColor: 'rgb(75, 192, 192)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        fill: true
                                    },
                                    {
                                        label: 'Số lượng nhập',
                                        data: response.importData.map(item => ({
                                            x: item.date,
                                            y: parseInt(item.total_imported)
                                        })),
                                        borderColor: 'rgb(255, 99, 132)',
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        fill: true
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        type: 'time',
                                        time: {
                                            unit: 'day',
                                            parser: 'YYYY-MM-DD',
                                            tooltipFormat: 'DD/MM/YYYY'
                                        },
                                        title: {
                                            display: true,
                                            text: 'Ngày'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Số lượng'
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error('Ajax error:', xhr);
                        alert('Có lỗi xảy ra khi tải dữ liệu');
                    }
                });
            }

            // Event listeners
            $('#chartVariationSelect, #chartStartDate, #chartEndDate').on('change', updateChartData);

            // Initial load
            updateChartData();
        });
    </script>
@endpush
