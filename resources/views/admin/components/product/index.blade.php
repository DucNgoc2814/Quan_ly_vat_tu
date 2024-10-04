@extends('admin.layouts.master')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách sản phẩm</h4>
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
                                <a href="{{ route('product.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm sản phẩm</a>
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
                                <th data-ordering="false">Tên sản phẩm</th>
                                <th data-ordering="false">Danh mục</th>
                                <th data-ordering="false">Thương hiệu</th>
                                <th data-ordering="false">Số lượng</th>
                                <th data-ordering="false">Đơn vị</th>
                                <th data-ordering="false">AVG nhập</th>
                                <th data-ordering="false">Hiển thị</th>
                                <th data-ordering="false">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->category->name }}</td>
                                    <td>{{ $data->brand->name }}</td>
                                    <td>{{ $data->variations->sum('stock') }}</td>
                                    <td>{{ $data->unit->name }}</td>
                                    <td>
                                        @foreach ($data->variations as $variation)
                                            {{ $variation->importOrderDetails->avg('price') > 0 ? $variation->importOrderDetails->avg('price') : 0 }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-switch">
                                            @if ($data->is_active == 1)
                                             <input onchange="changeStatus('products', {{ $data->id }},0)" class="form-check-input"
                                             type="checkbox" name="is_active"
       value="1" id="is_active" checked>
                                            @else
                                                <input onchange="changeStatus('products', {{ $data->id }},1)"
                                                 class="form-check-input" type="checkbox" name="is_active"
                                                    value="0" id="is_active">
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $data) }}" class="dropdown-item edit-item-btn"><i
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

@endsection

