
@extends('admin.layouts.master')


@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách sản phẩm</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('product.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm sản phẩm</a>
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
                                <th data-ordering="false">ID</th>
                                <th data-ordering="false">Tên sản phẩm</th>
                                <th data-ordering="false">Danh mục</th>
                                <th data-ordering="false">Thương hiệu</th>
                                <th data-ordering="false">Số lượng tồn kho</th>
                                <th data-ordering="false">Đơn vị tính</th>
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
                                        <a href="{{ route('product.edit', $data->slug) }}" class="dropdown-item edit-item-btn"><i
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
