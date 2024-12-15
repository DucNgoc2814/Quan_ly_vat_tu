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
                                <h4 class="fs-16 mb-1">Thông kê doanh thu</h4>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
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
                    <div class="col-xl-3 col-md-6" style="width: 25%;">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng doanh thu</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 id="tongDoanhThu" class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongDoanhThu) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng doanh thu thực</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongDoanhThuThuc) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" style="width: 25%;">
                        <!-- card -->

                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng chi</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongKhoanChi) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng tiền đã chi</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongKhoanChiThuc) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" style="width: 25%;">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Công nợ phải thu</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongDoanhThu - $tongDoanhThuThuc - $tongDaHoanTien) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Công nợ phải trả</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongKhoanChi - $tongKhoanChiThuc) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" style="width: 25%;">
                        <!-- card -->

                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng tiền hoàn</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongHoanTien) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Tổng đã hoàn tiền</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0 ">
                                            <i class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            {{ formatCurrency($tongDaHoanTien) }} đ
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 w-50">
                        <div class="card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Doanh thu</h4>
                                <div class="d-flex gap-3">
                                    <input type="date" id="start_date" class="form-control form-select-sm"
                                        onchange="changeSelect()">
                                    <span class="align-self-center">đến</span>
                                    <input type="date" id="end_date" class="form-control form-select-sm"
                                        onchange="changeSelect()">
                                </div>
                            </div>
                            <canvas id="myChart" style="width:100%"></canvas>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="d-flex">
                                    <div style="width: 20px; height: 20px; background: red; margin: 3px"></div> <span>Công
                                        nợ </span>
                                </div>
                                <div class="d-flex">
                                    <div style="width: 20px; height: 20px; background: green; margin: 3px"></div>
                                    <span>Doanh thu thực </span>
                                </div>
                                <div class="d-flex">
                                    <div style="width: 20px; height: 20px; background: blue; margin: 3px"></div>
                                    <span>Doanh
                                        thu </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 w-50">
                        <div class="card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Chi phí</h4>
                                <div class="d-flex gap-3">
                                    <input type="date" id="start_date2" class="form-control form-select-sm"
                                        onchange="changeSelect222()">
                                    <span class="align-self-center">đến</span>
                                    <input type="date" id="end_date2" class="form-control form-select-sm"
                                        onchange="changeSelect222()">
                                </div>
                            </div>
                            <canvas id="myChart2" style="width:100%"></canvas>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="d-flex">
                                    <div style="width: 20px; height: 20px; background: red; margin: 3px"></div> <span>Công
                                        nợ cần trả</span>
                                </div>
                                <div class="d-flex">
                                    <div style="width: 20px; height: 20px; background: green; margin: 3px"></div>
                                    <span>Tổng
                                        chi thực </span>
                                </div>
                                <div class="d-flex">
                                    <div style="width: 20px; height: 20px; background: blue; margin: 3px"></div> <span>Tổng
                                        chi </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 w-100">
                        <div class="card-body card">
                            <div class="d-flex w-75">
                                <h3 class="m-3">Khoản thu</h3>
                                <div class="form-group row m-1">
                                    <div class="col-sm-4" style="width: fit-content">
                                        <input type="date" id="startDate" class="form-control date-filter"
                                            style="width: fit-content">
                                    </div>
                                    TỚI
                                    <div class="col-sm-4" style="width: fit-content"> <input type="date"
                                            id="endDate" class="form-control date-filter" style="width: fit-content">
                                    </div>
                                </div>
                            </div>
                            <table id="myTable"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="background: rgb(0, 162, 255)" data-ordering="false">Ngày</th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Doanh thu</th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Doanh thu thực
                                        </th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Công nợ cần đòi
                                        </th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Chi phí</th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Đã chi
                                        </th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Công nợ cần trả
                                        </th>
                                        <th data-ordering="false" style="background: rgb(0, 162, 255)">Tiền hoàn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mergedData as $item)
                                        <tr class="data-row">
                                            <td style="background: rgb(136, 206, 246)" class="date">{{ $item['date'] }}
                                            </td>
                                            <td style="background: rgb(217, 132, 132)">{{ $item['total_doanhthu'] }}</td>
                                            <td style="background: rgb(78, 79, 80)">{{ $item['paid_doanhthu'] }}</td>
                                            <td style="background: rgb(217, 132, 132)">
                                                {{ $item['total_doanhthu'] - $item['paid_doanhthu'] }}</td>
                                            <td style="background: rgb(104, 217, 104)">{{ $item['total_khoanchi'] }}</td>
                                            <td style="background: rgb(104, 217, 104)">{{ $item['paid_khoanchi'] }}</td>
                                            <td style="background: rgb(104, 217, 104)">
                                                {{ $item['total_khoanchi'] - $item['paid_khoanchi'] }}</td>
                                            <td style="background: rgb(104, 217, 104)">
                                                {{ $item['tienHoan'] }}</td>
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

    <script>
        // Bắt sự kiện thay đổi của các thẻ input date
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
        } // Hiển thị dữ liệu ban đầu khi trang load
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        const xValues = @json($tongDoanhThuThucTheoNgay->pluck('date'));
        let doanhThuThuc = @json($tongDoanhThuThucTheoNgay->pluck('paid_amount'));
        let doanhThu = @json($tongDoanhThuTheoNgay->pluck('total_amount'));
        let tongHoanTien = @json($tongHoanTienTheoNgay->pluck('refund_amount'));
        let congNo = doanhThu.map((value, index) => {
            const total = Number(value);
            const paid = Number(doanhThuThuc[index] || 0);
            const refund = Number(tongHoanTien[index] || 0);
            return Math.max(0, total - (paid + refund));
        });
        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: congNo,
                    borderColor: "red",
                    fill: false
                }, {
                    data: doanhThuThuc,
                    borderColor: "green",
                    fill: false
                }, {
                    data: doanhThu,
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });

        let myChart;

        function changeSelect() {
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();

            if (!startDate || !endDate) return;

            $('#myChart').css('opacity', '0.5');

            $.ajax({
                url: '{{ route('admin.thongke.revenue') }}',
                type: 'GET',
                data: {
                    start_date: startDate + ' 00:00:00',
                    end_date: endDate + ' 23:59:59'
                },
                success: function(response) {
                    $('#myChart').css('opacity', '1');
                    console.log('Response:', response);

                    let dates = response.dates.length ? response.dates : [startDate];
                    let paid_amounts = response.paid_amounts.length ? response.paid_amounts : [0];
                    let total_amounts = response.total_amounts.length ? response.total_amounts : [0];
                    let refund_amounts = response.refund_amounts || new Array(dates.length).fill(0);

                    // Calculate công nợ mới
                    let debt = dates.map((date, index) => {
                        const total = Number(total_amounts[index] || 0);
                        const paid = Number(paid_amounts[index] || 0);
                        const refund = Number(refund_amounts[date] || 0);
                        return Math.max(0, total - paid - refund);
                    });

                    if (myChart) {
                        myChart.destroy();
                    }

                    const ctx = document.getElementById('myChart');
                    myChart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: dates,
                            datasets: [{
                                data: debt,
                                borderColor: "red",
                                fill: false,
                                label: 'Công nợ'
                            }, {
                                data: paid_amounts,
                                borderColor: "green",
                                fill: false,
                                label: 'Doanh thu thực'
                            }, {
                                data: total_amounts,
                                borderColor: "blue",
                                fill: false,
                                label: 'Tổng doanh thu'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    min: 0
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#myChart').css('opacity', '1');
                }
            });
        }

        $(document).ready(function() {
            $('#start_date, #end_date').on('change', function() {
                console.log('Date changed:', {
                    start: $('#start_date').val(),
                    end: $('#end_date').val()
                });
                changeSelect();
            });
        });
    </script>
    <script>
        let xValues2 = @json($tongKhoanChiThucTheoNgay->pluck('date'));
        let KhoanChiThuc = @json($tongKhoanChiThucTheoNgay->pluck('paid_amount'));
        let KhoanChi = @json($tongKhoanChiTheoNgay->pluck('total_amount'));
        let congNo2 = KhoanChi.map((value, index) => value - KhoanChiThuc[index]);

        new Chart("myChart2", {
            type: "line",
            data: {
                labels: xValues2,
                datasets: [{
                    data: congNo2,
                    borderColor: "red",
                    fill: false
                }, {
                    data: KhoanChiThuc,
                    borderColor: "green",
                    fill: false
                }, {
                    data: KhoanChi,
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    </script>
    <script>
        let myChart2;

        function changeSelect222() {
            let startDate = $('#start_date2').val();
            let endDate = $('#end_date2').val();

            if (!startDate || !endDate) return;

            $('#myChart2').css('opacity', '0.5');

            $.ajax({
                url: '{{ route('admin.thongke.dateRange') }}',
                type: 'GET',
                data: {
                    start_date: startDate + ' 00:00:00',
                    end_date: endDate + ' 23:59:59'
                },
                success: function(response) {
                    $('#myChart2').css('opacity', '1');

                    // Set default data if empty
                    let dates = response.dates.length ? response.dates : [startDate];
                    let paid_amounts = response.paid_amounts.length ? response.paid_amounts : [0];
                    let total_amounts = response.total_amounts.length ? response.total_amounts : [0];

                    if (myChart2) {
                        myChart2.destroy();
                    }

                    const ctx = document.getElementById('myChart2');
                    myChart2 = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: dates,
                            datasets: [{
                                data: total_amounts.map((total, i) => total - paid_amounts[i]),
                                borderColor: "red",
                                fill: false,
                                label: 'Công nợ'
                            }, {
                                data: paid_amounts,
                                borderColor: "green",
                                fill: false,
                                label: 'Chi thực tế'
                            }, {
                                data: total_amounts,
                                borderColor: "blue",
                                fill: false,
                                label: 'Tổng chi'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    $('#myChart2').css('opacity', '1');
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi lấy dữ liệu');
                }
            });
        }
    </script>
@endsection
