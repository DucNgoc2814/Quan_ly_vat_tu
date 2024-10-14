@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách thanh trượt</h4>

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
                                <a href="{{ route('sliders.create') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-add-line align-bottom me-1"></i>Thêm thanh trượt </a>
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
                                <th data-ordering="false">Ảnh</th>
                                <th data-ordering="false">Mô tả thanh trượt</th>
                                <th data-ordering="false">Ngày bắt đầu</th>
                                <th data-ordering="false">Ngày kết thúc</th>
                                <th data-ordering="false">Hiển thị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $item)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $item->url) }}" width="100px" height="100px" alt=""></td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->date_start }}</td>
                                    <td>{{ $item->date_end }}</td>
                                    <td>
                                        <div class="form-check form-switch form-switch">
                                            @if ($item->status == 1)
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    value="1" id="is_active" checked>
                                            @else
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    value="0" id="is_active">
                                            @endif
                                        </div>


                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                {{-- <li><a href="#!" class="dropdown-item"><i
                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                </li> --}}
                                                <li><a href="{{ route('sliders.edit', $item->id) }}"
                                                        class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a></li>
                                                <li>

                                                    <form action="{{ route('sliders.destroy', $item->id) }}"
                                                        method="post">
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


