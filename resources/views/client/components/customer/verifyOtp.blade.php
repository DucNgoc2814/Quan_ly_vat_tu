@extends('admin.layouts.master')

@section('title')
    Xác thực OTP
@endsection

@section('content')
    <form action="{{ route('khach-hang.verifyOtp') }}" method="post">
        @csrf
        <div class="container">
            <h1>Xác thực OTP</h1>
            <p>Vui lòng nhập mã OTP đã được gửi đến email của bạn.</p>
            <hr>
            <input type="hidden" name="email" value="{{ session('email') }}">
            <label for="otp"><b>OTP</b></label><br>
            <input type="text" class="form-control w-50" placeholder="Nhập mã OTP" name="otp" id="otp" required><br>
            <div class="d-flex">
                <h5>Thời gian để nhập mã OTP của bạn là: </h5><h5 id="countdown" class="ms-1 text-danger">60</h5>
            </div>
            @error('otp')
                <label for="" class="text-danger">{{ $message }}</label>
            @enderror
            <hr>
            <button type="submit" class="btn btn-primary" id="submitOTP">Xác thực</button>
            <a href="{{ route('khach-hang.quen-mat-khau') }}">
                <p class="btn btn-primary mt-3 ms-3">Quay lại</p>
            </a>
        </div>
    </form>
@endsection

<script>
    function startCountdown() {
        let timeLeft = 60;
        const countdownElement = document.getElementById('countdown');

        const countdownTimer = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                countdownElement.textContent = "Hết hạn";
                // Thực hiện hành động khi hết hạn, ví dụ: vô hiệu hóa nút gửi OTP
                document.getElementById('submitOTP').disabled = true;
            } else {
                countdownElement.textContent = timeLeft;
                timeLeft--;
            }
        }, 1000);
    }

    // Gọi hàm khi trang được tải
    window.onload = startCountdown;
</script>
