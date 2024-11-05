@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách danh mục hợp đồng</h4>
                <div class="col-sm-auto">
                    <div>
                        <a href="{{ route('contractType.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                class="ri-add-line align-bottom me-1"></i>Thêm danh mục hợp đồng </a>
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
                                <th data-ordering="false">Tên loại hợp đồng</th>
                                <th data-ordering="false">Mô tả</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contract_types as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            
                                            <a href="{{ route('contractType.edit', $item->id) }}"
                                                class="dropdown-item edit-item-btn btn-hover-warning" ><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                Gửi</a>
                                            
                                        </div>
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
