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
            <div class="card-header">
                <h4 class="card-title mb-0">Top 5 sản phẩm bán chạy nhất</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã nhập hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng đã bán</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $product)
                            <tr>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->variation_name }}</td>
                                <td>{{ number_format($product->total_sold) }}</td>
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
                <h4 class="card-title mb-0">Top 5 sản phẩm tồn kho nhiều nhất</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã nhập hàng</th>
                                <th>Sản phẩm</th>
                                <th>Tồn kho</th>
                                <th>Lần nhập gần nhất</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventory as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->variation_name }}</td>
                                <td class="{{ $item->current_stock < 10 ? 'text-danger' : '' }}">
                                    {{ number_format($item->current_stock) }}
                                </td>
                                <td>{{ $item->last_import_date ? date('d/m/Y', strtotime($item->last_import_date)) : 'Chưa có' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thống kê chi tiết -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Thống kê chi tiết sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="myTable table table-striped" id="myTable">
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
                            @foreach($productStats as $stat)
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

<!-- Biểu đồ thống kê theo thời gian -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Biểu đồ doanh số theo thời gian</h4>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    // Khởi tạo DataTable
    $(document).ready(function() {
        $('#productStatsTable').DataTable();
    });

    // Chuẩn bị dữ liệu cho biểu đồ
    const monthlyData = @json($monthlyStats);
    const labels = [...new Set(monthlyData.map(item => `${item.month}/${item.year}`))];
    const datasets = [];
    
    // Tạo dataset cho từng sản phẩm
    const products = [...new Set(monthlyData.map(item => item.product_name))];
    products.forEach(product => {
        const data = labels.map(label => {
            const [month, year] = label.split('/');
            const entry = monthlyData.find(item => 
                item.product_name === product && 
                item.month === parseInt(month) && 
                item.year === parseInt(year)
            );
            return entry ? entry.total_revenue : 0;
        });

        datasets.push({
            label: product,
            data: data,
            borderColor: `#${Math.floor(Math.random()*16777215).toString(16)}`,
            fill: false
        });
    });

    // Vẽ biểu đồ
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(value);
                        }
                    }
                }
            }
        }
    });
</script>
@endpush

@push('css')
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
