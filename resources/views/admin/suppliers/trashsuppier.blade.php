@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách đã ẩn nhà cung cấp</h4>
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
            <div class="card text-center" id="tasksList">
                <div class="card-header border-0">


                    <div class="row g-4">
                        <div class="col-sm-auto">
                            <div>
                                {{-- <a href="{{ route('them-moi-nha-cung-cap') }}" class="btn btn-success"
                                    id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i>Thêm mới nhà cung cấp </a> --}}
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                {{-- <form class="search-box ms-2" method="GET" action="{{ route('danh-sach-nha-cung-cap') }}">
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        value="{{ old('search') }}" placeholder="Tìm dữ liệu...">
                                    <i class="ri-search-line search-icon"></i>
                                </form> --}}
                                <a href="{{ route('danh-sach-nha-cung-cap') }}"><button
                                        class="btn btn-secondary">Quay lại danh sách nhà cung cấp</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end card-body-->
                <div class="card-body">
                    <div class="table-responsive table-card mb-4 ">
                        <table class="table table-nowrap mb-0" id="tasksTable">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Email nhà cung cấp</th>
                                    <th>Số điện thoại nhà cung cấp</th>
                                    <th>Địa chỉ nhà cung cấp</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all text-muted">
                                @foreach ($listTrashSupplier as $item)
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
                                                    <li><a onclick="return confirm('Bạn có muốn khôi phục lại nhà cung cấp không ?')" href="{{ route('khoi-phuc', ['id' => $item->id]) }}"
                                                            class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Khôi phục nhà cung cấp</a></li>
                                                    <li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end table-->
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 200k+ tasks We did not find any tasks
                                    for you search.</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-end mt-2">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div> --}}
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
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

