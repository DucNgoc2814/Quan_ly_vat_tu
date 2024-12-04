@extends('admin.layouts.master')

@section('title')
    Thêm nhân sự
@endsection

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới nhân viên</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Danh sách nhân sự</a></li>
                        <li class="breadcrumb-item active">Thêm mới nhân sự</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <div class="card-header border-0 mb-4">
        <div class="row g-4">
            <div class="col-sm-auto">
                <a href="{{ route('employees.index') }}" class="btn btn-success" id="addproduct-btn"><i
                    class="ri-arrow-left-line align-bottom me-1"></i>Quay lại</a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Chức vụ nhân viên</label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                <option value="">Chọn chức vụ</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}" {{ old('role_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
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
                            <label class="form-label" for="product-title-input">Tên nhân viên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nhập tên nhân viên" name="name" value="{{ old('name') }}">
                            @error('name')
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
                            <label class="form-label" for="product-title-input">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Nhập email" name="email" value="{{ old('email') }}">
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
                            <label class="form-label" for="product-title-input">Căn cước công dân</label>
                            <input type="text" class="form-control @error('cccd') is-invalid @enderror"
                                placeholder="Nhập căn cước công dân" name="cccd" value="{{ old('cccd') }}">
                            @error('cccd')
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
                            <label class="form-label" for="product-title-input">Mô tả</label>
                            <textarea name="description" class="form-control" cols="10" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Nhập mật khẩu đang nhập vào hệ thống" name="password"
                                value="{{ old('name') }}">
                            @error('password')
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
                            <label class="form-label" for="product-title-input">Hình ảnh</label>
                            <input type="file" id="image-input" class="form-control @error('image') is-invalid @enderror"
                                name="image" value="{{ old('image') }}" accept="image/*"
                                onchange="previewImage(event)">
                            @error('image')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                            <div id="image-preview" class="mt-3" style="display: none">
                                <h5>Hình ảnh đã chọn:</h5>
                                <img style="border-radius:4px" width="200px" id="preview" src=""
                                    alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Số điện thoại</label>
                            <input type="text" class="form-control @error('number_phone') is-invalid @enderror"
                                placeholder="Nhập số điện thoại" name="number_phone" value="{{ old('number_phone') }}">
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
                            <label class="form-label" for="product-title-input">Ngày sinh</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                value="{{ old('date') }}">
                            @error('date')
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
                            <div class="col-lg-6 form-check form-switch form-switch ms-3 mt-3">
                                <label class="form-label">Hiển thị</label>
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    id="is_active">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Thêm mới nhân viên</button>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

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

    <script>
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);

            } else {
                previewContainer.style.display = 'none';
            }
        }
    </script>
@endsection
