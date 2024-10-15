@extends('admin.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('employees.index') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-arrow-left-line align-bottom me-1"></i>Trang danh sách</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-4">
            <div class="card mt-n5">
                <div class="card-body p-3">
                    <div class="text-center">
                        <form method="POST" action="{{ route('employees.update', $datae->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                                <img id="preview" src="{{ $datae->image ? \Storage::url($datae->image) : asset('themes/admin/assets/pro/default-user.jpg') }}"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                    alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" name="image"
                                        class="profile-img-file-input" onchange="previewImage(event)">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h4 class="fs-16">{{ $datae->name }}</h4>
                    </div>
                </div>
            </div>

            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-8">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                <h3>Thông tin nhân viên</h3>

                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Tên nhân viên</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $datae->name)}}"
                                            name="name">
                                    </div>
                                    @error('name')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email', $datae->email)}}"
                                            name="email">
                                    </div>
                                    @error('email')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>

                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="number_phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control @error('number_phone') is-invalid @enderror" value="{{old('number_phone', $datae->number_phone)}}"
                                            name="number_phone">
                                    </div>
                                    @error('number_phone')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror

                                </div>
                                <!--end col-->
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="payment_id" class="form-label">Căn cước công dân</label>
                                        <input type="text" class="form-control @error('cccd') is-invalid @enderror" value="{{old('cccd', $datae->cccd)}}"
                                            name="cccd">
                                    </div>
                                    @error('cccd')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>


                                <!--end col-->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="payment_id" class="form-label">Ngày sinh</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror" value="{{old('date', $datae->date)}}"
                                            name="date">
                                    </div>
                                    @error('date')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Chức vụ nhân viên</label>
                                        <select name="role_id"
                                            class="form-control @error('role_id') is-invalid @enderror">
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
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Mô tả</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="10" rows="2">{{ $datae->description }}</textarea>
                                    @error('description')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror

                                </div>

                                <div class="col-lg-6 form-check form-switch form-switch mt-3">
                                    <label class="form-label">Hiển thị</label>
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                        checked>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function previewImage(event) {
            const input = event.target;
            const previewImage = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
