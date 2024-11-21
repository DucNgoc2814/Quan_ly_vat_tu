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
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">Thông tin tài khoản</li>
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
                                <p class="user-name">Xin chào <span>{{ $user->name }}</span></p>
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
                                <h3>Chi tiết tài khoản</h3>
                                <div class="register-form login-form clearfix">
                                    <div class="card mt-n5">
                                        <div class="card-body p-3">
                                            <div class="text-center">
                                                <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                                                    @if ($user->image)
                                                        <img src="{{ Storage::url($user->image) }}"
                                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                            alt="user-profile-image">
                                                    @else
                                                        <img src="{{ asset('themes/admin/assets/images/users/avatar-1.jpg') }}"
                                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                            alt="user-profile-image">
                                                    @endif
                                                </div>
                                                <h4 class="fs-16">{{ Session::get('customer_name') }}</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-4">Tên tài khoản:</label>
                                        <div class="col-lg-6 col-md-8">
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-4">Địa chỉ email:</label>
                                        <div class="col-lg-6 col-md-8">
                                            <span>{{ $user->email }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-4">Số điện thoại:</label>
                                        <div class="col-lg-6 col-md-8">
                                            <span>{{ $user->number_phone }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-md-4">Tổng tiền đã mua hàng:</label>
                                        <div class="col-lg-6 col-md-8">
                                            <span>{{ $user->amount }} VNĐ</span>
                                        </div>
                                    </div>

                                    <div class="register-box mt-40">
                                        <a href="{{ route('profileUser') }}" class="return-customer-btn f-right">Cập nhật
                                            tài khoản</a>
                                    </div>
                                </div>
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
                    <a href="#"><img class="img" src="{{ asset('themes/client/jantrik/img/brand/1.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/2.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/3.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/4.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/5.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img class="img" src="{{ asset('themes/client/jantrik/img/brand/1.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/2.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/3.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/4.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/5.png') }}"
                            alt="brand-image"></a>
                </div>
            </div>
            <!-- Brand Banner End -->
        </div>
    </div>
    <!-- Brand Logo End -->
@endsection
