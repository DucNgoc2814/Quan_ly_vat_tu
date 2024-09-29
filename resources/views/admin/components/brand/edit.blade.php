@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>
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
                                <a href="{{ route('brand.index') }}" class="btn btn-success" id="addproduct-btn">Danh
                                    sách thương hiệu </a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-end">
                                <form class="search-box ms-2" method="GET" action="">
                                    <input type="text" class="form-control" id="searchProductList" name="search"
                                        placeholder="Tìm dữ liệu...">
                                    <i class="ri-search-line search-icon"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand.update', $brand) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" name="name" value="{{ $brand->name }}" class="form-control">
                                @error('description')
                                    <p class="text-danger">{{ $name }}</p>
                                @enderror
                            </div>
                            <div class=" col-lg-4 form-check form-switch form-switch">
                                <label class="form-label">Hiển thị</label>
                                @if ($brand->is_active == 1)
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        id="is_active" checked>
                                @else
                                    <input class="form-check-input" type="checkbox" name="is_active" value="0"
                                        id="is_active">
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class = "btn btn-success text">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection


