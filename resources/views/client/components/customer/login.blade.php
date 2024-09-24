@extends('admin.layouts.master')

@section('title')
    Đăng nhập
@endsection

@section('content')
    <form action="{{ route('handleLogin') }}" method="post">
        @csrf
        <div class="container mb-3">
            <h1>Đăng nhập</h1>
            <hr>
            <label for="email"><b>Email</b></label><br>
            <input type="email" class="form-control w-50" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <label for="password"><b>Mật khẩu</b></label><br>
            <input type="password" class="form-control w-50" placeholder="Mật khẩu" name="password" id="password"  value="{{ old('password') }}">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <p>Bằng cách tạo một tài khoản, bạn đồng ý với chúng tôi <a href="#">Điều khoản & Quyền riêng tư</a>.</p>
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </div>
        <br>
        <div class="container signin">
            <p>Bạn có sẵn sàng để tạo một tài khoản? <a href="{{ route('register') }}">Đăng ký</a>.</p>
        </div>
        <div class="container signin">
            <p>Nếu bạn quên mật khẩu <a href="{{ route('forgotPassword') }}">Lấy lại mật khẩu</a>.</p>
        </div>
    </form>
@endsection
