@extends('client.layouts.master')

@section('title')
    Xác thực OTP
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active"><a href="register.html">Xác thực OTP</a></li>
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
                        <h3 class="mb-10">Xác thực OTP</h3>
                    </div>
                </div>
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-sm-12">
                    <form class="form-horizontal" action="{{ route('verifyOtp') }}" method="post">
                        @csrf
                        <fieldset>
                            <legend>Vui lòng nhập mã OTP đã được gửi đến email của bạn.</legend>
                            <div class="form-group">
                                <label class="control-label" for="f-name"><span class="require">*</span>OTP</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="email" value="{{ session('email') }}">
                                    <input type="text" class="form-control w-50 mt-2" placeholder="Nhập mã OTP"
                                        name="otp" id="otp" required><br>
                                    <div class="d-flex">
                                        <h5>Thời gian để nhập mã OTP của bạn là: </h5>
                                        <h5 id="countdown" class="ms-1 text-danger">60</h5>
                                    </div>
                                    @error('otp')
                                        <label for="" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons newsletter-input">
                            {{-- <div class="pull-right">I have read and agree to the <a href="#" class="agree"><b>Privacy
                                        Policy</b></a> --}}
                            <div class="pull-left">
                                {{-- <input type="checkbox" name="agree" value="1"> &nbsp; --}}
                                <button type="submit" class="newsletter-btn" id="submitOTP">Xác thực</button>
                                {{-- <input type="submit" value="Xác thực" class="newsletter-btn" id="submitOTP"> --}}
                                <a href="{{ route('forgotPassword') }}">
                                    <p class="newsletter-btn">Quay lại</p>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container signin">
                    <p class="mt-3">Nếu bạn đã có tài khoản hãy: <a href="{{ route('login') }}"
                            class="active ">Đăng Nhập</a>.</p>
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
<script>
    function startCountdown() {
        let timeLeft = 60;
        const countdownElement = document.getElementById('countdown');
        const submitButton = document.getElementById('submitOTP');

        const countdownTimer = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                countdownElement.textContent = "Hết hạn";
                submitButton.style.display = 'none'; // Ẩn nút "Xác thực"
            } else {
                countdownElement.textContent = timeLeft;
                timeLeft--;
            }
        }, 1000);
    }
    window.onload = startCountdown;
</script>
