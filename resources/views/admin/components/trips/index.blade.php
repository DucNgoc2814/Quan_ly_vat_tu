@extends('admin.layouts.master')

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
                            <div>
                                <a href="{{ route('suppliers.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm nhà cung cấp</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Tên xe</th>
                                <th data-ordering="false">Tên nhân viên</th>
                                <th data-ordering="false">Trang thái</th>
                                <th data-ordering="false">Hàh động</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trips as $data)
                                <tr>
                                    <td>{{ $data->cargoCar->cargoCarType->name }}</td>

                                    <td>{{ $data->employee->name }}</td>
                                    <td>
                                        @if ($data->status == 1)
                                            <span style="color: green" class=" badge-soft-success">Đang vận chuyển</span>
                                        @else
                                            <span style="color: red" class=" badge-soft-danger">Chờ xác nhận</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{ route('trips_details.index', ['id' => $data->id]) }}" class="btn btn-secondary">
                                            Chi tiết
                                        </a>
                                       
                                    </td>
                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
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
