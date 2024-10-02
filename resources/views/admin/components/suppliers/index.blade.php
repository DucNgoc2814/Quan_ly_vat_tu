@extends('admin.layouts.master')

@section('title')
    Danh sách nhà cung cấp
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách nhà cung cấp</h4>
            </div>
        </div>
        <div>
            @if (session('success'))
                <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="tasksList">
                <div class="card-header border-0">
                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('suppliers.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm mới nhà cung cấp
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
                <!--end card-body-->
                <div class="card-body">
                    <div class="table-responsive table-card mb-4 ">
                        <table id="myTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Email nhà cung cấp</th>
                                    <th>Số điện thoại nhà cung cấp</th>
                                    <th>Địa chỉ nhà cung cấp</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listsupplier as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->number_phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td style="text-align: center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{ route('suppliers.edit', ['id' => $item->id]) }}"
                                                            class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Sửa thông tin</a></li>
                                                    <li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
    </div>
@endsection



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
