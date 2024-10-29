@extends('client.layouts.master')

@section('title')
    Thông tin tài khoản
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active"><a href="login.html">Thông tin tài khoản</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- LogIn Page Start -->
    <div class="my-account white-bg pb-60">
        <div class="container">
            <div class="account-dashboard">
                <div class="dashboard-upper-info">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="d-single-info">
                                <p class="user-name">Xin chào <span>yourmail@info</span></p>
                                <p>(not yourmail@info? <a href="#">Log Out</a>)</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="d-single-info">
                                <p>Bạn cần hỗ trợ? Dịch vụ khách hàng tại</p>
                                <p>admin@example.com.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="d-single-info">
                                <p>Gửi email cho họ tại </p>
                                <p>support@example.com</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="d-single-info text-center">
                                <a class="view-cart" href="cart.html"><i class="fa fa-cart-plus" aria-hidden="true"></i>view
                                    cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column dashboard-list" role="tablist">
                            <li><a class="active" data-bs-toggle="tab" href="#dashboard">Bảng điều khiển</a></li>
                            <li><a data-bs-toggle="tab" href="#orders">Đơn hàng</a></li>
                            <li><a data-bs-toggle="tab" href="#address">Địa chỉ</a></li>
                            <li><a data-bs-toggle="tab" href="#account-details">Chi tiết tài khoản</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-10">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard-content mt-all-40">
                            <div id="dashboard" class="tab-pane active">
                                <h3>Bảng điều khiển </h3>
                                <p>Từ bảng điều khiển tài khoản của bạn, bạn có thể dễ dàng kiểm tra và xem <a
                                        href="#">các đơn hàng gần đây</a>, quản lý <a href="#">địa chỉ giao hàng
                                        và thanh toán cũng như </a> <a href="#">chỉnh sửa mật khẩu và thông tin tài
                                        khoản.</a></p>
                            </div>
                            <div id="orders" class="tab-pane fade">
                                <h3>Đơn hàng</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Đặt hàng</th>
                                                <th>Ngày</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng cộng</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Ngày 10 tháng 5 năm 2018</td>
                                                <td>Xử lý</td>
                                                <td>25,00 đô la cho 1 sản phẩm </td>
                                                <td><a class="view" href="cart.html">Xem</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Ngày 10 tháng 5 năm 2018</td>
                                                <td>Xử lý</td>
                                                <td>17,00 đô la cho 1 sản phẩm </td>
                                                <td><a class="view" href="cart.html">Xem</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="address" class="tab-pane">
                                <p>Các địa chỉ sau đây sẽ được sử dụng trên trang thanh toán theo mặc định.</p>
                                <h4 class="billing-address">Địa chỉ thanh toán</h4>
                                <a class="view" href="#">Chính sửa</a>
                                <p>Việt Nam</p>
                            </div>
                            <div id="account-details" class="tab-pane fade">
                                <h3>Chi tiết tài khoản </h3>
                                <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="register-form login-form clearfix">
                                        <div class="card mt-n5">
                                            <div class="card-body p-3">
                                                <div class="text-center">
                                                    <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                                                        <img src="{{ Storage::url($user->image) }}"
                                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                            alt="user-profile-image">
                                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                            <input id="profile-img-file-input" type="file"
                                                                class="profile-img-file-input" name="image">
                                                            <label for="profile-img-file-input"
                                                                class="profile-photo-edit avatar-xs">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-light text-body">
                                                                    <i class="ri-camera-fill"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <h4 class="fs-16">{{ $user->name }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="f-name" class="col-lg-3 col-md-4 col-form-label">Tên tài
                                                khoản</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="f-name" name="nameupdate"
                                                    value="{{ $user->name }}">
                                            </div>
                                            @error('nameupdate')
                                                <label for="" class="text-danger">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-lg-3 col-md-4 col-form-label">Địa chỉ
                                                email</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="email"
                                                    value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputpassword" class="col-lg-3 col-md-4 col-form-label">Số điện
                                                thoại</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="text" class="form-control" id="number_phone"
                                                    value="{{ $user->number_phone }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputpassword" class="col-lg-3 col-md-4 col-form-label">Tổng tiền
                                                đã mua hàng</label>
                                            <div class="col-lg-6 col-md-8">
                                                <label for="inputpassword"
                                                    class="col-lg-3 col-md-4 col-form-label">{{ $user->amount }}
                                                    VNĐ</label>
                                            </div>
                                        </div>
                                        <div class="register-box mt-40">
                                            <button type="submit" class="return-customer-btn f-right">Cập nhật tài
                                                khoản</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LogIn Page End -->
    <!-- Brand Logo Start -->
    <div class="brand-area pb-60">
        <div class="container">
            <!-- Brand Banner Start -->
            <div class="brand-banner owl-carousel">
                <div class="single-brand">
                    <a href="#"><img class="img" src="{{ asset('themes/client/template/img/brand/1.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/2.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/3.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/4.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/5.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img class="img" src="{{ asset('themes/client/template/img/brand/1.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/2.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/3.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/4.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/template/img/brand/5.png') }}"
                            alt="brand-image"></a>
                </div>
            </div>
            <!-- Brand Banner End -->
        </div>
    </div>
    <!-- Brand Logo End -->
@endsection
