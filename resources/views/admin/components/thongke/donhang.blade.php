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
@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Thông kê đơn hàng</h4>
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
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Đơn hàng xuất</h4>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng đơn hàng </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($totalOrders) }}
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
                                            Đang tiến hành</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($processingOrders) }}
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
                                            Thành công</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($successfulOrders) }}
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
                                            Thất bại</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($failedOrders) }}
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
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Đơn hàng nhập</h4>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng đơn hàng </p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($totalImportOrders) }}
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
                                            Đang tiến hành</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($processingImportOrders) }}
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
                                            Thành công</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($successfulImportOrders) }}
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Thất bại</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($failedImportOrders) }}
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
                </div> <!-- end row-->
                <div class="row d-flex">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1"></h4>
                            </div><!-- end card header -->
                            <div class="m-5">
                                <select name="thoiGian" id="thoiGian" class="form-control"
                                    onchange="thoiGianChanged(event)">
                                    <option value="ngay">Theo ngày</option>
                                    <option value="tuan">Theo tuần</option>
                                    <option value="thang">Theo tháng</option>
                                    <option value="nam">Theo năm</option>
                                </select>
                            </div>
                            <div id="chart_div"></div>
                        </div><!-- end card body -->
                    </div><!-- end card -->

                </div>
                <div class="row d-flex">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1"></h4>
                            </div><!-- end card header -->
                            <div class="m-5">
                                <select name="thoiGian" id="thoiGian" class="form-control"
                                    onchange="thoiGianChanged2(event)">
                                    <option value="ngay">Theo ngày</option>
                                    <option value="tuan">Theo tuần</option>
                                    <option value="thang">Theo tháng</option>
                                    <option value="nam">Theo năm</option>
                                </select>
                            </div>
                            <div id="chart_div2"></div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    <div class="col-xl-4 w-100">
                        <!-- card123 -->
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Tỉ lệ chuyển đổi chung</h4>
                                <div class="flex-shrink-0">
                                </div>
                            </div><!-- end card header -->
                            <div class="d-flex align-items-center">
                                <div class="card-body w-50">
                                    <div id="donutchart"></div>
                                </div>
                                <div class="card-body w-50">
                                    <div id="donutchart2"></div>
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="card">
                            <div class="container mt-4">
                                <h1 class="mb-4">Thống Kê Đơn Hàng</h1>
                                 <div class="form-group row m-1">
                                <div class="col-sm-4" style="width: fit-content">
                                    <input type="date" id="startDate" class="form-control date-filter"
                                        style="width: fit-content">
                                </div>
                                TỚI
                                <div class="col-sm-4" style="width: fit-content"> <input type="date" id="endDate"
                                        class="form-control date-filter" style="width: fit-content">
                                </div>
                            </div>
                                <table id="myTable"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%; font-size:10px;">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ngày</th>
                                            <th>Đơn hàng đang chờ</th>
                                            <th>Đơn hàng thành công</th>
                                            <th>Đơn hàng thất bại</th>
                                            <th>Đơn nhập đang chờ</th>
                                            <th>Đơn nhập thành công</th>
                                            <th>Đơn nhập thất bại</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count= 0
                                        @endphp
                                        @foreach ($mergedData as $key => $item)
                                            <tr class="data-row">
                                                <td>{{ $count += 1 }}</td>
                                                <td class="date">{{ $item['date'] }}</td>
                                                <td>SL: {{ $item['orders_dangCho'] }} <br> TT :
                                                   <b> {{ number_format($item['orders_total_amount_dangCho'], 0, ',', '.') }}</b>
                                                    VND</td>
                                                <td>SL: {{ $item['orders_thanhCong'] }} <br> TT :
                                                   <b> {{ number_format($item['orders_total_amount_thanhCong'], 0, ',', '.') }}</b>
                                                    VND</td>
                                                <td>SL: {{ $item['orders_thatBai'] }} <br> TT :
                                                   <b> {{ number_format($item['orders_total_amount_thatBai'], 0, ',', '.') }}</b>
                                                    VND</td>
                                                <td>SL: {{ $item['importOrders_dangCho'] }} <br> TT :
                                                   <b> {{ number_format($item['importOrders_total_amount_dangCho'], 0, ',', '.') }}</b>
                                                    VND</td>
                                                <td>SL: {{ $item['importOrders_thanhCong'] }} <br> TT :
                                                   <b> {{ number_format($item['importOrders_total_amount_thanhCong'], 0, ',', '.') }}</b>
                                                    VND</td>
                                                <td>SL: {{ $item['importOrders_thatBai'] }} <br> TT :
                                                   <b> {{ number_format($item['importOrders_total_amount_thatBai'], 0, ',', '.') }}</b>
                                                    VND</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- .col-->
                </div> <!-- end row-->
            </div> <!-- end .h-100-->
        </div> <!-- end col -->
    </div>
    <script></script>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $('.date-filter').on('change', function() {
            filterByDate();
        }); // Hàm lọc dữ liệu theo ngày
        function filterByDate() {
            let startDate = new Date($('#startDate').val());
            let endDate = new Date($('#endDate').val());
            $('.data-row').each(function() {
                let itemDate = new Date($(this).find('.date').text());
                if (itemDate >= startDate && itemDate <= endDate) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Đang tiến hành', @json($processingImportOrders)],
                ['Thành công', @json($successfulImportOrders)],
                ['Thất bại', @json($failedImportOrders)],
            ]);
            var options = {
                title: 'Biểu đồ thị tỉ lệ chuyển đổi chung của đơn hàng nhập',
                pieHole: 0.4,
            };
            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }

        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Đang tiến hành', @json($processingOrders)],
                ['Thành công', @json($successfulOrders)],
                ['Thất bại', @json($failedOrders)],
            ]);
            var options = {
                title: 'Biểu đồ thị tỉ lệ chuyển đổi chung của đơn hàng xuất',
                pieHole: 0.4,
            };
            var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart.draw(data, options);
        }
        let orderStatusngay = @json($orderStatusTheoNgay);
        let orderStatustuan = @json($orderStatusTheoTuan);
        let orderStatusthang = @json($orderStatusTheoThang);
        let orderStatusnam = @json($orderStatusTheoNam);

        function thoiGianChanged(event) {
            var thoiGian = event.target.value;
            switch (thoiGian) {
                case 'ngay':
                    google.charts.setOnLoadCallback(drawVisualizationNgay);
                    break;
                case 'tuan':
                    google.charts.setOnLoadCallback(drawVisualizationTuan);
                    break;
                case 'thang':
                    google.charts.setOnLoadCallback(drawVisualizationThang);
                    break;
                case 'nam':
                    google.charts.setOnLoadCallback(drawVisualizationNam);
                    break;
            }
        }

        function drawVisualizationNgay() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...orderStatusngay.map(item => [
                    item.date,
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng xuất',
                vAxis: {
                    title: 'Đơn hàng xuất'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        function drawVisualizationTuan() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...orderStatustuan.map(item => [
                    item.date,
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng xuất',
                vAxis: {
                    title: 'Đơn hàng xuất'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        function drawVisualizationThang() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...orderStatusthang.map(item => [
                    item.date,
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng xuất',
                vAxis: {
                    title: 'Đơn hàng xuất'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

        function drawVisualizationNam() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...orderStatusnam.map(item => [
                    String(item.date),
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng xuất',
                vAxis: {
                    title: 'Đơn hàng xuất'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualizationNgay);


        let importOrdersStatusngay = @json($importOrdersStatusTheoNgay);
        let importOrdersStatustuan = @json($importOrdersStatusTheoTuan);
        let importOrdersStatusthang = @json($importOrdersStatusTheoThang);
        let importOrdersStatusnam = @json($importOrdersStatusTheoNam);

        function thoiGianChanged2(event) {
            var thoiGian = event.target.value;
            switch (thoiGian) {
                case 'ngay':
                    google.charts.setOnLoadCallback(drawVisualizationNgay2);
                    break;
                case 'tuan':
                    google.charts.setOnLoadCallback(drawVisualizationTuan2);
                    break;
                case 'thang':
                    google.charts.setOnLoadCallback(drawVisualizationThang2);
                    break;
                case 'nam':
                    google.charts.setOnLoadCallback(drawVisualizationNam2);
                    break;
            }
        }

        function drawVisualizationNgay2() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...importOrdersStatusngay.map(item => [
                    String(item.date), // Chuyển đổi thành chuỗi
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng nhập',
                vAxis: {
                    title: 'Đơn hàng nhập'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }

        function drawVisualizationTuan2() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...importOrdersStatustuan.map(item => [
                    String(item.date), // Chuyển đổi thành chuỗi
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng nhập',
                vAxis: {
                    title: 'Đơn hàng nhập'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }

        function drawVisualizationThang2() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...importOrdersStatusthang.map(item => [
                    String(item.date), // Chuyển đổi thành chuỗi
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng nhập',
                vAxis: {
                    title: 'Đơn hàng nhập'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }

        function drawVisualizationNam2() {
            var data = google.visualization.arrayToDataTable([
                ['Thời gian', 'Tổng', 'Thất bại', 'Tiến hành', 'Thành Công'],
                ...importOrdersStatusnam.map(item => [
                    String(item.date),
                    +item.total,
                    +item.thatBai,
                    +item.tienHanh,
                    +item.thanhCong
                ])
            ]);
            var options = {
                title: 'Biểu đồ thể hiện thông tin đơn hàng nhập',
                vAxis: {
                    title: 'Đơn hàng nhập'
                },
                hAxis: {
                    title: 'Thời gian'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };
            var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
            chart.draw(data, options);
        }

        // Tải Google Charts và vẽ biểu đồ theo ngày mặc định
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualizationNgay2);
    </script>
@endsection
