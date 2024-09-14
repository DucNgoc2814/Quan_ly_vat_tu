@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách nhà cung cấp</h4>
            </div>
        </div>
        <div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-center" id="tasksList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        {{-- <h5 class="card-title mb-0 flex-grow-1">All Tasks</h5> --}}
                        <div class="flex-shrink-0">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('supplier.create') }}">
                                    <button class="btn btn-success add-btn" data-bs-toggle="modal"
                                        data-bs-target="#showModal">
                                        <i class="ri-add-line align-bottom me-1"></i>Thêm mới nhà cung cấp</button>
                                </a>
                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                                        class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <!--end col-->

                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light"
                                        placeholder="Search for tasks or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-4">
                                {{-- <input type="text" class="form-control bg-light border-light" id="demo-datepicker" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date range"> --}}
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="choices-single-default" id="idStatus">
                                        <option value="">Status</option>
                                        <option value="all" selected>All</option>
                                        <option value="New">New</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Filters
                                </button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <!--end card-body-->
                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table table-nowrap mb-0" id="tasksTable">
                            <thead class="table-light text-muted">
                                <tr>

                                    <th>#</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Email nhà cung cấp</th>
                                    <th>Số điện thoại nhà cung cấp</th>
                                    <th>Địa chỉ nhà cung cấp</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @foreach ($listsupplier as $item)
                                    <tr>

                                        <td class="id"><a href="#"
                                                class="fw-medium link-primary">{{ $item->id }}</a>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->number_phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{route('supplier.edit',$item->id)}}" class="btn btn-warning me-2">Sửa thông tin</a>
                                            <form action="{{route('supplier.destroy',$item->id)}}" method="post" onsubmit="return confitm('Bạn có muốn xóa nó không !')" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ẩn</button>
                                            </form>
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
