@extends('admin.layouts.master')

@section('title')
    Quên mật khẩu
@endsection

@section('content')
    <form action="{{ route('khach-hang.sendMaill') }}" method="post">
        @csrf
        <div class="container">
            <h1>Quên mật khẩu</h1>
            <p>Vui lòng điền vào mẫu này để Lấy lại mật khẩu.</p>
            <hr>
            <label for="email"><b>Email</b></label><br>
            <input type="text" class="form-control w-50" placeholder="Email" name="email" id="email">
            @error('email')
                <label for="" class="text-danger">{{ $message }}</label>
            @enderror
            <hr>
            <button type="submit" class="btn btn-primary">Lấy lại mật khẩu</button>
        </div><br>
        <div class="container signin">
            <p>Nếu bạn chưa có tài khoản: <a href="{{ route('khach-hang.dang-ky') }}">Đăng ký</a>.</p>
        </div>
        <div class="container signin">
            <p>Nếu bạn đã có tài khoản: <a href="{{ route('khach-hang.dang-nhap') }}">Đăng nhập</a>.</p>
        </div>
    </form>
@endsection
