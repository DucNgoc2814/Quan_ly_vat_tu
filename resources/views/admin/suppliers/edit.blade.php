@extends('admin.layouts.master')

@section('title')
    Thêm bài viết
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa thông tin nhà cung cấp</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách</a></li>
                        <li class="breadcrumb-item active">Sửa thông tin nhà cung cấp</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('supplier.update', $supplier->id) }}"
        onsubmit="return confirm('Bạn có muốn cập nhật thông tin không !')">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Tên nhà cung cấp</label>
                            <input type="text" class="form-control" placeholder="Nhập tên nhà cung cấp" name="name"
                                value="{{ $supplier->name }}">
                            @error('name')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Email nhà cung cấp</label>
                            <input type="text" class="form-control" placeholder="Nhập email" name="email"
                                value="{{ $supplier->email }}">
                            @error('email')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Số điện thoại nhà cung cấp</label>
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="number_phone"
                                value="{{ $supplier->number_phone }}">
                            @error('number_phone')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Địa chỉ nhà cung cấp</label>
                            <input type="text" class="form-control" placeholder="Nhập địa chỉ nhà cung cấp"
                                name="address" value="{{ $supplier->address }}">
                            @error('address')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Xác nhận cập nhật thông tin</button>
                </div>
            </div>
            <!-- end col -->
        </div>
    </form>



    <script>
        document.getElementById('product-image-input').addEventListener('change', function(event) {
            var output = document.getElementById('product-img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        });
    </script>
@endsection
