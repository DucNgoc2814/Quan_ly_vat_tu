@extends('admin.layouts.master')

@section('title')
Sửa thương hiệu
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa thương hiệu</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Thương hiệu</a></li>
                        <li class="breadcrumb-item active">Sửa thương hiệu</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('brand.index') }}" class="btn btn-success" id="addproduct-btn"><i
                    class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('brand.update', $brand) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-8">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" name="name" value="{{ $brand->name }}" class="form-control"><br>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="ms-3 col-lg-8 form-check form-switch form-switch">
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


