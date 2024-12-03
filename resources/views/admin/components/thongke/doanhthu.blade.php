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
                <div class="col-xl-3 col-md-6" style="width: 33%;">
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
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6" style="width: 33%;">
                    <!-- card -->
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
                <div class="col-xl-3 col-md-6" style="width: 33%;">
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
                                        {{ formatCurrency($tongDoanhThu - $tongDoanhThuThuc) }} đ
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
                <div class="col-xl-3 col-md-6" style="width: 33%;">
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
                </div>
                <div class="col-xl-3 col-md-6" style="width: 33%;">

                    <!-- card -->
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
                <div class="col-xl-3 col-md-6" style="width: 33%;">
                    <!-- card -->
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
                <div class="col-xl-8 w-50">
                    <div class="card p-3">
                        <h3 class="m-3">Khoản thu</h3>
                        <div class="input-group gap-5" style="margin-bottom: 20px">
                            <select name="" id="" class="form-select" onchange="changeSelect(event)">
                                <option value="ngay">Thống kê theo ngày</option>
                                <option value="tuan">Thống kê theo tuần</option>
                                <option value="thang">Thống kê theo tháng</option>
                                <option value="nam">Thống kê theo năm</option>
                            </select>
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
                                <div style="width: 20px; height: 20px; background: blue; margin: 3px"></div> <span>Doanh
                                    thu </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 w-50">
                    <div class="card p-3">
                        <h3 class="m-3">Khoản chi</h3>
                        <div class="input-group gap-5" style="margin-bottom: 20px">
                            <select name="" id="" class="form-select" onchange="changeSelect222(event)">
                                <option value="ngay">Thống kê theo ngày</option>
                                <option value="tuan">Thống kê theo tuần</option>
                                <option value="thang">Thống kê theo tháng</option>
                                <option value="nam">Thống kê theo năm</option>
                            </select>
                        </div>
                        <canvas id="myChart2" style="width:100%"></canvas>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="d-flex">
                                <div style="width: 20px; height: 20px; background: red; margin: 3px"></div> <span>Công
                                    nợ cần trả</span>
                            </div>
                            <div class="d-flex">
                                <div style="width: 20px; height: 20px; background: green; margin: 3px"></div> <span>Tổng
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
                                <div class="col-sm-4" style="width: fit-content"> <input type="date" id="endDate"
                                        class="form-control date-filter" style="width: fit-content">
                                </div>
                            </div>
                        </div>
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th data-ordering="false">STT</th>
                                    <th style="background: rgb(0, 162, 255)" data-ordering="false">Ngày</th>
                                    <th data-ordering="false" style="background: red">Tổng doanh thu</th>
                                    <th data-ordering="false" style="background: red">Tổng doanh thu thực</th>
                                    <th data-ordering="false" style="background: red">Công nợ cần đòi</th>
                                    <th data-ordering="false" style="background: green">Tổng khoản chi</th>
                                    <th data-ordering="false" style="background: green">Tổng khoản chi thực</th>
                                    <th data-ordering="false" style="background: green">Công nợ cần trả</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach ($mergedData as $item)
                                <tr class="data-row">
                                    <td style="text-align: center">{{ $count += 1 }}</td>
                                    <td style="background: rgb(136, 206, 246)" class="date">{{ $item['date'] }}
                                    </td>
                                    <td style="background: rgb(217, 132, 132)">{{ $item['total_doanhthu'] }}</td>
                                    <td style="background: rgb(217, 132, 132)">{{ $item['paid_doanhthu'] }}</td>
                                    <td style="background: rgb(217, 132, 132)">
                                        {{ $item['total_doanhthu'] - $item['paid_doanhthu'] }}</td>
                                    <td style="background: rgb(104, 217, 104)">{{ $item['total_khoanchi'] }}</td>
                                    <td style="background: rgb(104, 217, 104)">{{ $item['paid_khoanchi'] }}</td>
                                    <td style="background: rgb(104, 217, 104)">
                                        {{ $item['total_khoanchi'] - $item['paid_khoanchi'] }}</td>
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
        let congNo = doanhThu.map((value, index) => value - doanhThuThuc[index]);
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

        function changeSelect(event) {
            if (event.target.value == 'ngay') {
                const xValues = @json($tongDoanhThuThucTheoNgay->pluck('date'));
                let doanhThuThuc = @json($tongDoanhThuThucTheoNgay->pluck('paid_amount'));
                let doanhThu = @json($tongDoanhThuTheoNgay->pluck('total_amount'));
                let congNo = doanhThu.map((value, index) => value - doanhThuThuc[index]);

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
            } else if (event.target.value == 'tuan') {
                let weeks = @json($tongDoanhThuThucTheoTuan->pluck('week'));
                let years = @json($tongDoanhThuThucTheoTuan->pluck('year'));
                const xValues = weeks.map((week, index) => `Tuần ${week}/${years[index]}`);
                let doanhThuThuc = @json($tongDoanhThuThucTheoTuan->pluck('paid_amount'));
                let doanhThu = @json($tongDoanhThuTheoTuan->pluck('total_amount'));
                let congNo = doanhThu.map((value, index) => value - doanhThuThuc[index]);

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
            } else if (event.target.value == 'thang') {
                let months = @json($tongDoanhThuThucTheoThang->pluck('month'));
                let years = @json($tongDoanhThuThucTheoThang->pluck('year'));
                const xValues = months.map((month, index) => `${month}/${years[index]}`);
                let doanhThuThuc = @json($tongDoanhThuThucTheoThang->pluck('paid_amount'));
                let doanhThu = @json($tongDoanhThuTheoThang->pluck('total_amount'));
                let congNo = doanhThu.map((value, index) => value - doanhThuThuc[index]);

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
            } else if (event.target.value == 'nam') {
                const xValues = @json($tongDoanhThuThucTheoNam->pluck('year'));
                let doanhThuThuc = @json($tongDoanhThuThucTheoNam->pluck('paid_amount'));
                let doanhThu = @json($tongDoanhThuTheoNam->pluck('total_amount'));
                let congNo = doanhThu.map((value, index) => value - doanhThuThuc[index]);

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
            }
        }
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
    function changeSelect222(event) {
            if (event.target.value == 'ngay') {
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
            } else if (event.target.value == 'tuan') {
                let weeks = @json($tongKhoanChiThucTheoTuan->pluck('week'));
                let years = @json($tongKhoanChiThucTheoTuan->pluck('year'));
                let xValues2 = weeks.map((week, index) => `Tuần ${week}/${years[index]}`);
                let KhoanChiThuc = @json($tongKhoanChiThucTheoTuan->pluck('paid_amount'));
                let KhoanChi = @json($tongKhoanChiTheoTuan->pluck('total_amount'));
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
            } else if (event.target.value == 'thang') {
                let months = @json($tongKhoanChiThucTheoThang->pluck('month'));
                let years = @json($tongKhoanChiThucTheoThang->pluck('year'));
                let xValues2 = months.map((month, index) => `${month}/${years[index]}`);
                let KhoanChiThuc = @json($tongKhoanChiThucTheoThang->pluck('paid_amount'));
                let KhoanChi = @json($tongKhoanChiTheoThang->pluck('total_amount'));
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
            } else if (event.target.value == 'nam') {
                let xValues2 = @json($tongKhoanChiThucTheoNam->pluck('year'));
                let KhoanChiThuc = @json($tongKhoanChiThucTheoNam->pluck('paid_amount'));
                let KhoanChi = @json($tongKhoanChiTheoNam->pluck('total_amount'));
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
            }
        }
</script>
@endsection