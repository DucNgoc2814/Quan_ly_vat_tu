@extends('client.layouts.master')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">Đăng nhập</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- LogIn Page Start -->
    <div class="log-in pb-60">
        <div class="container">
            <div class="row">
                <!-- New Customer Start -->
                <div class="col-sm-6">
                    <div class="well">
                        <div class="new-customer">
                            <h3>KHÁCH HÀNG MỚI</h3>
                            <p class="mtb-10"><strong>Đăng ký</strong></p>
                            <p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái đơn hàng và
                                theo dõi các đơn hàng bạn đã thực hiện trước đó.</p>
                            <a class="customer-btn" href="{{ route('register') }}">TIẾP TỤC</a>
                        </div>
                    </div>
                </div>
                <!-- New Customer End -->
                <!-- Returning Customer Start -->
                <div class="col-sm-6">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">KHÁCH HÀNG TRỞ LẠI</h3>
                            <p class="mb-10"><strong>Tôi là khách hàng quay lại</strong></p>
                            <form action="{{ route('handleLogin') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-2">Email</label>
                                    <input type="text" name="email" placeholder="Nhập địa chỉ email của bạn vào đây..."
                                        id="input-email" class="form-control" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-2">Mật khẩu</label>
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control"
                                            placeholder="Nhập mật khẩu cũ của bạn vào đây..." name="password"
                                            id="old-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100 rounded-0"
                                                onclick="togglePassword('old-password')">
                                                <i class="fa fa-eye" id="toggle-old-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <label for="" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <p class="lost-password"><a href="{{ route('forgotPassword') }}">Quên mật khẩu?</a></p>
                                <input type="submit" value="ĐĂNG NHẬP" class="return-customer-btn">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Returning Customer End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
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
