@extends('admin.layouts.master')

@section('title')
Danh sách khách hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách khách hàng</h4>
                <div>
                    <a href="{{ route('customer.create') }}" class="btn btn-success" id="addproduct-btn"><i
                            class="ri-add-line align-bottom me-1"></i>Thêm mới tài khoản</a>
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
                                <th data-ordering="false">Tên khách hàng</th>
                                <th data-ordering="false">Xếp hạng</th>
                                <th data-ordering="false">Ảnh khách hàng</th>
                                <th data-ordering="false">Số điện thoại</th>
                                <th data-ordering="false">Email</th>
                                <th data-ordering="false">Tích lũy</th>
                                <th data-ordering="false">Hiển thị</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->customerRank->name }}</td>
                                    <td><img src="{{ asset('storage/' . $customer->image) }}" width="100px" alt="">
                                    </td>
                                    <td>{{ $customer->number_phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->total_amount }}</td>
                                    <td>
                                        <div class="form-check form-switch form-switch">
                                            @if ($customer->is_active == 1)
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    value="1" id="is_active" checked>
                                            @else
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    value="0" id="is_active">
                                            @endif
                                        </div>
                                    <td>
                                        {{-- <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <form action="" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item remove-list" type="submit"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa slider này không?')">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Xóa
                                                    </button>
                                                </form>
                                                </li>
                                            </ul>
                                        </div> --}}

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
