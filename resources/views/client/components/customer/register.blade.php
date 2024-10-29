@extends('client.layouts.master')

@section('title')
    Đăng ký
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active"><a href="register.html">Đăng ký</a></li>
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
                        <h3 class="mb-10">ĐĂNG KÝ TÀI KHOẢN</h3>
                        <p class="mb-10">Nếu bạn đã có tài khoản với chúng tôi, vui lòng đăng nhập tại trang đăng nhập.</p>
                    </div>
                </div>
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal" action="{{ route('handleRegister') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Chi tiết cá nhân của bạn</legend>
                            <div class="form-group">
                                <label class="control-label" for="f-name"><span class="require">*</span>Tên tài
                                    khoản</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control mt-2" placeholder="Tên tài khoản"
                                        name="name" id="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="l-name"><span class="require">*</span>Điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control mt-2" placeholder="Số điên thoại"
                                        name="number_phone" id="password" value="{{ old('number_phone') }}">
                                    @error('number_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email"><span class="require">*</span>Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control mt-2"
                                        placeholder="Nhập địa chỉ email của bạn vào đây..." name="email" id="email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                        </fieldset>
                        <fieldset>
                            <legend>Mật khẩu của bạn</legend>
                            <div class="form-group">
                                <label class="control-label" for="pwd"><span class="require">*</span>Mật khẩu</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control mt-2" placeholder="Mật khẩu" name="password"
                                        id="password" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="pwd-confirm"><span class="require">*</span>Nhập lại mật
                                    khẩu</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control mt-2" placeholder="Nhập lại mật khẩu"
                                        name="password_confirmation" id="password_confirmation">
                                </div>
                            </div>
                        </fieldset>
                        {{-- <fieldset class="newsletter-input">
                            <legend>Newsletter</legend>
                            <div class="form-group">
                                <label class="control-label">Subscribe</label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="newsletter" value="1"> Yes</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="newsletter" value="0" checked="checked">
                                        No</label>
                                </div>
                            </div>
                        </fieldset> --}}
                        <div class="buttons newsletter-input">
                            {{-- <div class="pull-right">I have read and agree to the <a href="#" class="agree"><b>Privacy
                                        Policy</b></a> --}}
                            <div class="pull-left">
                                {{-- <input type="checkbox" name="agree" value="1"> &nbsp; --}}
                                <input type="submit" value="TIẾP TỤC" class="newsletter-btn">
                            </div>

                        </div>
                    </form>
                </div>
                <div class="container signin">
                    <p class="mt-3">Nếu bạn đã có tài khoản, hãy <a href="{{ route('login') }}" class="active ">Đăng Nhập</a>.</p>
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
