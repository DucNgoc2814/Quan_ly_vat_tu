@extends('client.layouts.master')

@section('title')
    Đổi mật khẩu
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active"><a href="login.html">Đổi mật khẩu</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- LogIn Page Start -->
    <div class="register-account pb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="register-title">
                        <h3 class="mb-10">Đổi mật khẩu</h3>
                    </div>
                </div>
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal" action="{{ route('passwordUser') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Vui lòng điền vào mẫu này để đổi mật khẩu</legend>
                            <div class="form-group">
                                <label class="control-label" for="old-password"><span class="require">*</span>Mật khẩu
                                    cũ</label>
                                <div class="col-sm-10">
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control"
                                            placeholder="Nhập mật khẩu cũ của bạn vào đây..." name="old_password"
                                            id="old-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100 rounded-0" onclick="togglePassword('old-password')">
                                                <i class="fa fa-eye" id="toggle-old-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('old_password')
                                        <label for="" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="new-password"><span class="require">*</span>Mật khẩu
                                    mới</label>
                                <div class="col-sm-10">
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control"
                                            placeholder="Nhập mật khẩu mới của bạn vào đây..." name="new_password"
                                            id="new-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100 rounded-0" onclick="togglePassword('new-password')">
                                                <i class="fa fa-eye" id="toggle-new-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('new_password')
                                        <label for="" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="confirm-password"><span class="require">*</span>Nhập lại
                                    mật khẩu mới</label>
                                <div class="col-sm-10">
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control"
                                            placeholder="Nhập lại mật khẩu mới của bạn vào đây..." name="confirm_password"
                                            id="confirm-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100 rounded-0" onclick="togglePassword('confirm-password')">
                                                <i class="fa fa-eye" id="toggle-confirm-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('confirm_password')
                                        <label for="" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons newsletter-input">
                            <div class="pull-left">
                                <input type="submit" value="Đổi mật khẩu" class="newsletter-btn">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container signin">
                    <p class="mt-3">Nếu bạn đã có tài khoản hãy: <a href="{{ route('login') }}" class="active ">Đăng
                            Nhập</a>.</p>
                </div>
                <div class="container signin">
                    <p>Nếu bạn chưa có tài khoản hãy: <a href="{{ route('register') }}">Đăng ký</a>.</p>
                </div>
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
