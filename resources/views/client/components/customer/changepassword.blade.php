@extends('admin.layouts.master')

@section('title')
    Đổi mật khẩu
@endsection

@section('content')
    <form action="{{ route('passwordchange') }}" method="post">
        @csrf
        <div class="container">
            <h1>Đổi mật khẩu</h1>
            <p>Vui lòng điền vào mẫu này để đổi mật khẩu.</p>
            <hr>
            <input type="hidden" name="email" value="{{ session('email') }}">
            <label for="password"><b>Mật khẩu mới</b></label><br>
            <input type="password" class="form-control w-50" placeholder="Mật khẩu" name="password" id="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <label for="psw-repeat"><b>Nhập lại mật khẩu mới</b></label><br>
            <input type="password" class="form-control w-50" placeholder="Nhập lại mật khẩu mới" name="password_confirmation" id="password_confirmation">
            <hr>
            <hr>
            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
        </div><br>
        <div class="container signin">
            <p>Nếu bạn chưa có tài khoản: <a href="{{ route('register') }}">Đăng ký</a>.</p>
        </div>
        <div class="container signin">
            <p>Nếu bạn đã có tài khoản: <a href="{{ route('login') }}">Đăng nhập</a>.</p>
        </div>
    </form>
@endsection
