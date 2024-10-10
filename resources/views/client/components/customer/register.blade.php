@extends('admin.layouts.master')

@section('title')
    Đăng ký
@endsection

@section('content')

    <form action="{{ route('handleRegister') }}" method="post">
        @csrf
        
        <div class="container mb-3">
            <h1>Đăng ký</h1>

            <label for="name" class="form-label"><b>Tên tài khoản</b></label><br>
            <input type="text" class="form-control w-50" placeholder="Tên tài khoản" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <label for="email"><b>Email</b></label><br>
            <input type="email" class="form-control w-50" placeholder="Email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <label for="password"><b>Điện thoại</b></label><br>
            <input type="text" class="form-control w-50" placeholder="Mật khẩu" name="number_phone" id="password"  value="{{ old('number_phone') }}">
            @error('number_phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <label for="password"><b>Mật khẩu</b></label><br>
            <input type="password" class="form-control w-50" placeholder="Mật khẩu" name="password" id="password"  value="{{ old('password') }}">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <hr>
            <label for="psw-repeat"><b>Nhập lại mật khẩu</b></label><br>
            <input type="password" class="form-control w-50" placeholder="Nhập lại mật khẩu" name="password_confirmation" id="password_confirmation">
            <hr>
            <p>Bằng cách tạo một tài khoản, bạn đồng ý với chúng tôi <a href="#">Điều khoản & Quyền riêng tư</a>.</p>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </div>
        <br>
        
        <div class="container signin">
            <p>Bạn có sẵn sàng để tạo một tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>.</p>
        </div>
    </form>
    
@endsection
