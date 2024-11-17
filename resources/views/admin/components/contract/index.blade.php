@extends('admin.layouts.master')

@section('title')
    Danh sách hợp đồng
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách hợp đồng</h4>
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
                                <a href="{{ route('contract.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm hợp đồng </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">Mã hợp đồng</th>
                                <th data-ordering="false">Tên người đại diện</th>
                                <th data-ordering="false">Email</th>
                                <th data-ordering="false">Số điện thoại</th>
                                <th data-ordering="false">Tổng tiền</th>
                                <th data-ordering="false">Ngày tạo</th>
                                <th data-ordering="false">Trạng thái</th>
                                <th data-ordering="false">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $data)
                                <tr>
                                    <td>{{ $data->contract_number }}</td>
                                    <td>{{ $data->customer_name}}</td>
                                    <td>{{ $data->customer_email }}</td>
                                    <td>{{ $data->number_phone }}</td>
                                    <td>{{ $data->total_amount }}</td>
                                    <td>{{ $data->created_at}}</td>
                                    <td>{{ $data->contractStatus->name }}</td>
                                    <td>
                                        <a href="{{ route('contract.edit', $data->contract_number) }}"
                                            class="dropdown-item edit-item-btn"><i
                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
    {{ $contracts->links() }}
@endsection
