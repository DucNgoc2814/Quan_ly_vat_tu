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
                                            class="text-success fs-14 mb-0 ">
                                            <i
                                                class="ri-arrow-right-line fs-13 align-middle "></i>
                                             %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            đ
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
                                            class="text-success fs-14 mb-0   ">
                                            <i
                                                class="ri-arrow-right--line fs-13 align-middle "></i>
                                             %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            đ
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
                                            class="text-success fs-14 mb-0 ">
                                            <i
                                                class="ri-arrow-right--line fs-13 align-middle "></i>

                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">

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
                                            class="text-success fs-14 mb-0  ">
                                            <i
                                                class="ri-arrow-right--line fs-13 align-middle "></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
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

                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
                <div class="row ">
                    <div class="col-xl-6  w-100">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bán chạy</h4>
                                <div class="flex-shrink-0">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card  w-100">

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
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-4">

                    </div> <!-- .col-->


                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->


    </div>
@endsection


@section('scripts')
    @parent

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
            layoutRightSideBtn = document.querySelector('.layout-rightside-btn');
        if (layoutRightSideBtn) {
            (Array.from(document.querySelectorAll('.layout-rightside-btn')).forEach(
                function(e) {
                    var t = document.querySelector('.layout-rightside-col')
                    e.addEventListener('click', function() {
                        t.classList.contains('d-block') ?
                            (t.classList.remove('d-block'), t.classList.add('d-none')) :
                            (t.classList.remove('d-none'), t.classList.add('d-block'))
                    })
                }))
        }
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
            (overlay = document.querySelector('.overlay')) &&
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
