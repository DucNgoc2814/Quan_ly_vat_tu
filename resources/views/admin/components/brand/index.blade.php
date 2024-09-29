@extends('admin.layouts.master')

@section('title')
    Danh sách thương hiệu
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách thương hiệu</h4>
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
                                <a href="{{ route('brand.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm thương hiệu </a>
                            </div>
                        </div>
                        <div class="col-sm">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">SKU</th>
                                <th data-ordering="false">Tên thương hiệu</th>
                                <th data-ordering="false">Hiển thị</th>
                                <th data-ordering="false">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->sku }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td> <div class="form-check form-switch form-switch">
                                        @if ($data->is_active == 1)
                                            <input class="form-check-input" type="checkbox" name="is_active"
                                                value="1" id="is_active" checked>
                                        @else
                                            <input class="form-check-input" type="checkbox" name="is_active"
                                                value="0" id="is_active">
                                        @endif
                                    </div></td>
                                    <td>
                                        <a href="{{ route('brand.edit', $data->sku) }}" class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                Sửa</a></li>

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

