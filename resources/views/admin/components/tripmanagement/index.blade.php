@extends('admin.layouts.masternv')

@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách chuyến xe</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            {{-- <div>
                                <a href="{{ route('trips.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm chuyến xe</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Tên xe</th>
                                <th data-ordering="false">Biển số xe</th>
                                <th data-ordering="false">Tên nhân viên</th>
                                <th data-ordering="false">Trang thái</th>
                                <th data-ordering="false">Hàh động</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trips as $trip)
                                <tr>
                                    <td>
                                        {{ $trip->cargoCar->cargoCarType->name }}
                                    </td>
                                    <td> {{ $trip->cargoCar->license_plate }}
                                    </td>
                                    <td> {{ $trip->employee->name }}
                                    </td>
                                    <td>
                                        @if ($trip->status == 1)
                                            <span style="color: green" class=" badge-soft-success">Đang vận chuyển</span>
                                        @else
                                            <span style="color: rgb(2, 80, 72)" class=" badge-soft-info">Hoàn thành</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('orderconfirm.show', ['id' => $trip->id]) }}"
                                            class="btn btn-secondary">
                                            Chi tiết
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.opacity = '0';
                    setTimeout(function() {
                        successAlert.style.display = 'none';
                    }, 600);
                }, 5000);
            }
        });
    </script>
@endsection
