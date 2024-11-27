@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ $title }}</h4>

                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('CargoCars.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm vận chuyển </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th data-ordering="false">Loại xe vận chuyển. </th>
                                <th data-ordering="false">Biển số xe</th>
                                <th data-ordering="false">Trạng thái.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cargo_car as $item)
                                <tr>
                                    <td>
                                        <span class="text-xs font-weight-bold">{{ $item->cargoCarType->name }}</span>
                                    </td>
                                    <td>{{ $item->license_plate }}</td>

                                    <td>
                                        @if ($item->is_active == 1)
                                            <span style="color: green" class=" badge-soft-success">Đang vận chuyển</span>
                                        @elseif ($item->is_active == 0)
                                            <span style="color: rgb(17, 47, 216)" class=" badge-soft-danger">Đang trống</span>
                                        @else
                                            <span style="color: red" class=" badge-soft-danger">Chờ xác nhận</span>
                                        @endif
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
