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
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">Tên hợp đồng</th>
                                <th data-ordering="false">Bên B</th>
                                <th data-ordering="false">Số điện thoại bên B</th>
                                <th data-ordering="false">Email bên B</th>
                                <th data-ordering="false">Trạng thái</th>
                                <th data-ordering="false">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contracts as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->contract_name }}</td>
                                    <td>{{ $data->customer_name }}</td>
                                    <td>{{ $data->customer_phone }}</td>
                                    <td>{{ $data->customer_email }}</td>
                                    <td>
                                        @if ($data->contract_status_id == 1)
                                            <form action="{{ route('contract.sendToManager', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Gửi giám đốc
                                                </button>
                                            </form>
                                        @elseif ($data->contract_status_id == 2)
                                            <form action="{{ route('contract.sendToCustomer', $data->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Gửi cho khách hàng
                                                </button>
                                            </form>
                                        @else
                                            {{ $data->contractStatus->name }}
                                        @endif
                                    </td>

                                    <td class="d-flex flex-column gap-2">
                                        @if ($data->contract_status_id == 1)
                                            <a href="{{ route('contract.index', $data) }}" class="btn btn-primary btn-sm">
                                                <i class="ri-pencil-fill align-bottom me-2"></i>Sửa
                                            </a>
                                        @elseif ($data->contract_status_id == 3 || $data->contract_status_id == 7)
                                            <a href="{{ route('contract.index', $data) }}" class="btn btn-warning btn-sm">
                                                <i class="ri-pencil-fill align-bottom me-2"></i>Thay đổi
                                            </a>
                                            <form action="{{ route('contract.sendToManager', $data->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">
                                                    <i class="ri-send-plane-fill align-bottom me-2"></i>Gửi giám đốc
                                                </button>
                                            </form>
                                        @elseif ($data->contract_status_id == 6)
                                            <a href="{{ route('contract.index', $data) }}" class="btn btn-info btn-sm">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
                                            <form action="{{ route('contract.sendToManager', $data->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">
                                                    <i class="ri-send-plane-fill align-bottom me-2"></i>Gửi giám đốc
                                                </button>
                                            </form>
                                            <a href="{{ route('order.createordercontract', ['contract_id' => $data->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="ri-add-fill align-bottom me-2"></i>Tạo đơn hàng
                                            </a>
                                        @else
                                            <a href="{{ route('contract.index', $data) }}" class="btn btn-info btn-sm">
                                                <i class="ri-eye-fill align-bottom me-2"></i>Xem
                                            </a>
                                            <form action="{{ route('contract.sendToManager', $data->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100">
                                                    <i class="ri-send-plane-fill align-bottom me-2"></i>Gửi giám đốc
                                                </button>
                                            </form>
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
    {{ $contracts->links() }}
@endsection
