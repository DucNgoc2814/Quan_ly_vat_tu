@extends('client.layouts.master')

@section('title')
    Cập nhật tài khoản
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li class="active"><a href="login.html">Cập nhật tài khoản</a></li>
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
                <!-- Returning Customer Start -->
                <div class="col-sm-6">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">Cập nhật tài khoản</h3>
                            <p class="mb-10"><strong>Tôi là khách hàng quay lại</strong></p>
                            <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="register-form login-form clearfix">
                                    <div class="card mt-n5">
                                        <div class="card-body p-3">
                                            <div class="text-center">
                                                <div class="profile-user position-relative d-inline-block mx-auto mb-3">
                                                    @if ($user->image)
                                                        <img src="{{ Storage::url($user->image) }}"
                                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                            alt="user-profile-image">
                                                    @else
                                                        <img src="{{ asset('themes/admin/assets/images/users/avatar-1.jpg') }}"
                                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                            alt="user-profile-image">
                                                    @endif
                                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                        <input id="profile-img-file-input" type="file"
                                                            class="profile-img-file-input" name="image">
                                                        <label for="profile-img-file-input"
                                                            class="profile-photo-edit avatar-xs">
                                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                                <i class="ri-camera-fill"></i>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="f-name" class="col-lg-3 col-md-4 col-form-label">Tên tài
                                            khoản</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="f-name" name="nameupdate"
                                                value="{{ $user->name }}">
                                        </div>
                                        @error('nameupdate')
                                            <label for="" class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-lg-3 col-md-4 col-form-label">Địa chỉ
                                            email</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="email"
                                                value="{{ $user->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputpassword" class="col-lg-3 col-md-4 col-form-label">Số điện
                                            thoại</label>
                                        <div class="col-lg-6 col-md-8">
                                            <input type="text" class="form-control" id="number_phone"
                                                value="{{ $user->number_phone }}" readonly>
                                        </div>
                                    </div>
                                    <div class="register-box mt-40">
                                        <button type="submit" class="return-customer-btn">Cập nhật tài
                                            khoản</button>
                                    </div>
                                </div>
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
