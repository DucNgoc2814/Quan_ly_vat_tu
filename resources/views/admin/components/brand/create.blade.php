@extends('admin.layouts.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm thương hiệu</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Thương hiệu</a></li>
                        <li class="breadcrumb-item active">Thêm thương hiệu</li>
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
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" name="name" placeholder="Nhập tên thương hiệu"
                                    class="form-control">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 form-check form-switch form-switch ms-3 mt-3">
                                <label class="form-label">Hiển thị</label>
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                id="is_active" checked>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class = "btn btn-success text ">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>

        </div><!--end col-->
    </div>
@endsection

