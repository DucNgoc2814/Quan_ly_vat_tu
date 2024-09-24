@extends('admin.layouts.master')

@section('title')
    Sửa thông tin nhân viên
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sửa thông tin nhân viên</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Danh sách</a></li>
                        <li class="breadcrumb-item active">Sửa thông tin nhân viên</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form method="POST" action="{{ route('employees.update', $datae->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Chức vụ nhân viên</label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                <option value="">Chọn chức vụ</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('role_id', $datae->role_id) == $item->id ? 'selected' : '' }}>
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
                                placeholder="Nhập tên nhân viên" name="name" value="{{ old('name', $datae->name) }}">
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
                            <label class="form-label" for="product-title-input">Email</label>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                placeholder="Nhập email" name="email" value="{{ old('email', $datae->email) }}">
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
                            <label class="form-label" for="product-title-input">Hình ảnh</label>
                            <input type="file" id="image-input"
                                class="form-control  @error('image') is-invalid @enderror" name="image"
                                value="{{ old('image') }}" accept="image/*" onchange="previewImage(event)">
                            @error('image')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror

                            <div id="image-preview" class="mt-3">
                                {{-- <h5>Hình ảnh hiện tại:</h5> --}}
                                <img style="border-radius:4px" width="200px" id="preview"
                                    src="{{ url('storage/', $datae->image) }}" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">CCCD/CMND</label>
                            <input type="text" class="form-control  @error('cccd') is-invalid @enderror"
                                placeholder="Nhập số điện thoại" name="cccd" value="{{ old('cccd', $datae->cccd) }}">
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
                            <label class="form-label" for="product-title-input">Số điện thoại</label>
                            <input type="text" class="form-control  @error('number_phone') is-invalid @enderror"
                                placeholder="Nhập số điện thoại" name="number_phone"
                                value="{{ old('number_phone', $datae->number_phone) }}">
                            @error('number_phone')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Ngày sinh</label>
                            <input type="date" class="form-control  @error('date') is-invalid @enderror"
                                name="date" value="{{ old('date', $datae->date) }}">
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
                            <label class="form-label" for="product-title-input">Mô tả</label>
                            <textarea name="description" class="form-control" cols="30" rows="10">{{ $datae->description }}</textarea>
                            @error('description')
                                <span role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="col-lg-6 form-check form-switch form-switch ms-3 mt-3">
                                <label class="form-label">Hiển thị</label>
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Cập nhật nhân viên</button>
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
