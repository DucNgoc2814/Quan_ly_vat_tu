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
                    <h4 class="card-title mb-0">Top 5 sản phẩm bán chạy nhất</h4>
                    <select id="topProductsSelect" class="form-select" style="width: 200px;">
                        <option value="day">Thống kê theo ngày</option>
                        <option value="week">Thống kê theo tuần</option>
                        <option value="month">Thống kê theo tháng</option>
                        <option value="year">Thống kê theo năm</option>
                    </select>
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
                                        <td class="{{ $item->current_stock < 10 ? 'text-danger' : '' }}">
                                            {{ number_format($item->current_stock) }}
                                        </td>
                                        <td>{{ $item->last_import_date ? date('d/m/Y', strtotime($item->last_import_date)) : 'Chưa có' }}
                                        </td>
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

    <!-- Biểu đồ thống kê theo thời gian -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Biểu đồ doanh số theo thời gian</h4>
                    <div class="d-flex gap-2">
                        <div class="position-relative" style="width: 200px;">
                            <input 
                                type="text" 
                                class="form-control" 
                                id="productSearch" 
                                placeholder="Tìm sản phẩm..."
                                autocomplete="off"
                            >
                            <div 
                                id="productDropdown" 
                                class="position-absolute w-100 mt-1 shadow bg-white rounded-2 d-none" 
                                style="max-height: 200px; overflow-y: auto; z-index: 1000;"
                            >
                                <div class="p-2 border-bottom product-item" data-id="all">
                                    <strong>Tất cả sản phẩm</strong>
                                </div>
                                @foreach($products as $product)
                                    <div class="p-2 border-bottom product-item" data-id="{{ $product->id }}">
                                        <strong>{{ $product->name }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <select class="form-select" id="timeSelect" style="width: 150px;">
                            <option value="daily">Theo ngày</option>
                            <option value="weekly">Theo tuần</option>
                            <option value="monthly">Theo tháng</option>
                            <option value="yearly">Theo năm</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div style="width: 80%; margin: 0 auto;">
                        <canvas id="revenueChart" height="250"></canvas>
                    </div>
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

        const topProductsData = @json($topProductsData); // Check this line in the browser console


        function changeSelect(event) {
            const period = event.target.value;
            const data = topProductsData[period]; // Access the selected period's data
            let html = '';

            // Check if the data exists for the selected period
            if (data && Array.isArray(data)) {
                data.forEach(product => {
                    html += `
                    <tr>
                        <td>${product.sku}</td>
                        <td>${product.variation_name}</td>
                        <td>${product.total_sold}</td>
                    <td>${formatCurrency(product.total_revenue)}
                    </tr>
                `;
                });
            } else {
                console.log("Data is not available for the selected period.");
            }

            document.getElementById('topProductsBody').innerHTML = html;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const defaultPeriod = document.querySelector('select').value;
            changeSelect({
                target: {
                    value: defaultPeriod
                }
            });
        });

        function formatCurrency(value) {
            value = parseFloat(value); // Ensure the value is a number
            if (isNaN(value)) {
                return ''; // Return empty string if value is not a valid number
            }

            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            }).format(value);
        }
    </script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const productSearch = document.getElementById('productSearch');
    const productDropdown = document.getElementById('productDropdown');
    const productItems = document.querySelectorAll('.product-item');
    const timeSelect = document.getElementById('timeSelect');
    let revenueChart = null;
    let selectedProductId = 'all'; // Default to all products

    const timeBasedStats = @json($timeBasedStats);

    // Set default value for product search
    productSearch.value = 'Tất cả sản phẩm';

    function updateChart() {
        const selectedTime = timeSelect.value;
        const data = processChartData(timeBasedStats[selectedTime], selectedProductId);

        if (revenueChart) {
            revenueChart.destroy();
        }

        revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Doanh thu',
                        data: data.revenues,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Số lượng bán',
                        data: data.quantities,
                        type: 'line',
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderWidth: 2,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Doanh thu (VNĐ)'
                        },
                        ticks: {
                            callback: function(value) {
                                return new Intl.NumberFormat('vi-VN', {
                                    style: 'currency',
                                    currency: 'VND',
                                    maximumFractionDigits: 0
                                }).format(value);
                            }
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Số lượng'
                        },
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                if (context.datasetIndex === 0) {
                                    return 'Doanh thu: ' + new Intl.NumberFormat('vi-VN', {
                                        style: 'currency',
                                        currency: 'VND',
                                        maximumFractionDigits: 0
                                    }).format(context.parsed.y);
                                }
                                return 'Số lượng: ' + context.parsed.y;
                            }
                        }
                    }
                }
            }
        });
    }

    // Product selection handling
    productItems.forEach(item => {
        item.addEventListener('click', () => {
            selectedProductId = item.dataset.id;
            productSearch.value = item.textContent.trim();
            productDropdown.classList.add('d-none');
            updateChart();
        });
    });

    // Time period selection handling
    timeSelect.addEventListener('change', updateChart);

    function processChartData(data, productId) {
        if (!data) return { labels: [], revenues: [], quantities: [] };

        let filteredData = productId === 'all' ? data : data.filter(item => item.product_id == productId);
        let groupedData = {};

        // Group data based on selected time period
        switch(timeSelect.value) {
            case 'daily':
                filteredData.forEach(item => {
                    const date = new Date(item.date).toLocaleDateString('vi-VN');
                    if (!groupedData[date]) {
                        groupedData[date] = {
                            total_revenue: 0,
                            total_quantity: 0
                        };
                    }
                    groupedData[date].total_revenue += parseFloat(item.total_revenue);
                    groupedData[date].total_quantity += parseInt(item.total_quantity);
                });
                break;

            case 'weekly':
                filteredData.forEach(item => {
                    const weekKey = `${item.week}-${item.year}`;
                    if (!groupedData[weekKey]) {
                        groupedData[weekKey] = {
                            week: item.week,
                            year: item.year,
                            total_revenue: 0,
                            total_quantity: 0
                        };
                    }
                    groupedData[weekKey].total_revenue += parseFloat(item.total_revenue);
                    groupedData[weekKey].total_quantity += parseInt(item.total_quantity);
                });
                break;

            case 'monthly':
                filteredData.forEach(item => {
                    const monthKey = `${item.month}-${item.year}`;
                    if (!groupedData[monthKey]) {
                        groupedData[monthKey] = {
                            month: item.month,
                            year: item.year,
                            total_revenue: 0,
                            total_quantity: 0
                        };
                    }
                    groupedData[monthKey].total_revenue += parseFloat(item.total_revenue);
                    groupedData[monthKey].total_quantity += parseInt(item.total_quantity);
                });
                break;

            case 'yearly':
                filteredData.forEach(item => {
                    const year = item.year;
                    if (!groupedData[year]) {
                        groupedData[year] = {
                            year: year,
                            total_revenue: 0,
                            total_quantity: 0
                        };
                    }
                    groupedData[year].total_revenue += parseFloat(item.total_revenue);
                    groupedData[year].total_quantity += parseInt(item.total_quantity);
                });
                break;
        }

        // Convert grouped data back to array and sort
        const sortedData = Object.values(groupedData).sort((a, b) => {
            if (timeSelect.value === 'yearly') return a.year - b.year;
            if (timeSelect.value === 'monthly') return a.year === b.year ? a.month - b.month : a.year - b.year;
            if (timeSelect.value === 'weekly') return a.year === b.year ? a.week - b.week : a.year - b.year;
            return new Date(a.date) - new Date(b.date);
        });

        // Create labels and data arrays
        const labels = sortedData.map(item => {
            switch(timeSelect.value) {
                case 'daily': return item.date;
                case 'weekly': return `Tuần ${item.week}/${item.year}`;
                case 'monthly': return `${item.month}/${item.year}`;
                case 'yearly': return `Năm ${item.year}`;
            }
        });

        return {
            labels,
            revenues: sortedData.map(item => item.total_revenue),
            quantities: sortedData.map(item => item.total_quantity)
        };
    }

    // Initial chart render
    updateChart();
});
</script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSearch = document.getElementById('productSearch');
    const productDropdown = document.getElementById('productDropdown');
    const productItems = document.querySelectorAll('.product-item');
    let selectedProductId = 'all';

    // Show/hide dropdown
    productSearch.addEventListener('focus', () => {
        productDropdown.classList.remove('d-none');
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!productSearch.contains(e.target) && !productDropdown.contains(e.target)) {
            productDropdown.classList.add('d-none');
        }
    });

    // Filter products
    productSearch.addEventListener('input', (e) => {
        const searchText = e.target.value.toLowerCase();
        
        productItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchText) || item.dataset.id === 'all') {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        productDropdown.classList.remove('d-none');
    });

    // Handle product selection
    productItems.forEach(item => {
        item.addEventListener('click', () => {
            selectedProductId = item.dataset.id;
            productSearch.value = item.textContent.trim();
            productDropdown.classList.add('d-none');
            updateChart(); // Call your existing chart update function
        });
    });
});
</script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const productSearch = document.getElementById('productSearch');
    const productDropdown = document.getElementById('productDropdown');
    const productItems = document.querySelectorAll('.product-item');
    const timeSelect = document.getElementById('timeSelect');
    let revenueChart = null;
    let selectedProductId = 'all'; // Default to all products

    const timeBasedStats = @json($timeBasedStats);

    // Search and dropdown handling
    productSearch.addEventListener('input', (e) => {
        const searchText = e.target.value.toLowerCase();
        let hasResults = false;

        productItems.forEach(item => {
            if (item.dataset.id === 'all') {
                item.style.display = 'none'; // Hide "All products" option when searching
                return;
            }
            
            const productName = item.textContent.toLowerCase();
            if (searchText === '' || productName.includes(searchText)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide dropdown based on search results
        if (searchText === '') {
            productDropdown.classList.add('d-none');
        } else {
            productDropdown.classList.remove('d-none');
        }
    });

    // Handle product selection
    productItems.forEach(item => {
        item.addEventListener('click', () => {
            selectedProductId = item.dataset.id;
            if (selectedProductId === 'all') {
                productSearch.value = ''; // Clear search when selecting all products
            } else {
                productSearch.value = item.textContent.trim();
            }
            productDropdown.classList.add('d-none');
            updateChart();
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!productSearch.contains(e.target) && !productDropdown.contains(e.target)) {
            productDropdown.classList.add('d-none');
        }
    });

    // Rest of your existing chart code...
});
</script>
@endpush

@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

<style>
.product-item {
    cursor: pointer;
}
.product-item:hover {
    background-color: #f8f9fa;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const topProductsData = @json($topProductsData);
    const topProductsSelect = document.getElementById('topProductsSelect');

    function changeSelect(event) {
        try {
            const period = event.target.value;
            const data = topProductsData[period];
            let html = '';

            if (data && Array.isArray(data)) {
                data.forEach(product => {
                    html += `
                    <tr>
                        <td>${product.sku}</td>
                        <td>${product.variation_name}</td>
                        <td>${product.total_sold}</td>
                        <td>${formatCurrency(product.total_revenue)}</td>
                    </tr>
                    `;
                });
            } else {
                html = '<tr><td colspan="4" class="text-center">Không có dữ liệu</td></tr>';
            }

            document.getElementById('topProductsBody').innerHTML = html;
        } catch (error) {
            console.error('Error updating top products:', error);
            document.getElementById('topProductsBody').innerHTML = 
                '<tr><td colspan="4" class="text-center">Đã xảy ra lỗi khi tải dữ liệu</td></tr>';
        }
    }

    // Add event listener
    topProductsSelect.addEventListener('change', changeSelect);

    // Initial load
    changeSelect({ target: topProductsSelect });
});

function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        maximumFractionDigits: 0
    }).format(value);
}
</script>
@endpush
