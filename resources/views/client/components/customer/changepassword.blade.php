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
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">Đổi mật khẩu</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Register Account Start -->
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
                    <form class="form-horizontal" action="{{ route('passwordchange') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Vui lòng điền vào mẫu này để đổi mật khẩu.</legend>
                            <div class="form-group">
                                <label class="control-label" for="f-name"><span class="require">*</span>Mật khẩu
                                    mới</label>
                                <div class="col-sm-10">
                                    <div class="input-group mt-2">
                                        <input type="hidden" name="email" value="{{ session('email') }}">
                                        <input type="password" class="form-control" placeholder="Mật khẩu mới"
                                            name="password" id="old-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100 rounded-0"
                                                onclick="togglePassword('old-password')">
                                                <i class="fa fa-eye" id="toggle-old-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="f-name"><span class="require">*</span>Nhập lại mật khẩu
                                    mới</label>
                                <div class="col-sm-10">
                                    <div class="input-group mt-2">
                                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới"
                                            name="password_confirmation" id="new-password">
                                        <div class="input-group-append">
                                            <span class="input-group-text h-100 rounded-0"
                                                onclick="togglePassword('new-password')">
                                                <i class="fa fa-eye" id="toggle-new-password"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons newsletter-input">
                            {{-- <div class="pull-right">I have read and agree to the <a href="#" class="agree"><b>Privacy
                                        Policy</b></a> --}}
                            <div class="pull-left">
                                {{-- <input type="checkbox" name="agree" value="1"> &nbsp; --}}
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
    <!-- Register Account End -->
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
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/2.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/3.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/4.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/5.png') }}" alt="brand-image"></a>
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
