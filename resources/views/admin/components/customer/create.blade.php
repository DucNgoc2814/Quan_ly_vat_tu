@extends('admin.layouts.master')

@section('title')
    Thêm mới khách hàng
@endsection

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            {{-- <img src="" class="profile-wid-img" alt=""> --}}
            <div class="overlay-content">
                <div class="text-end p-3">
                    <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                        <div class="col-sm-auto">
                            <div>
                                <a href="{{ route('customer.index') }}" class="btn btn-success" id="addproduct-btn"><i
                                        class="ri-arrow-left-line align-bottom me-1"></i>Trang danh sách</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-6">
            <div class="card mt-n5">
                    <div class="text-center">
                        <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                            @csrf
                    </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                <h3>Thêm mới khách hàng</h3>
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
                                        <label for="customer_name" class="form-label">Tên khách hàng</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Nhập tên" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Nhập email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="number_phone" class="form-label">Số điện thoại</label>
                                        <input type="text"
                                            class="form-control @error('number_phone') is-invalid @enderror"
                                            name="number_phone" placeholder="Nhập số điện thoại" value="{{ old('number_phone') }}">
                                    </div>
                                    @error('number_phone')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="payment_id" class="form-label">Mật khẩu</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Nhập mật khẩu">
                                    </div>
                                    @error('password')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="payment_id" class="form-label">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                    </div>
                                    @error('password')
                                        <span role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
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
