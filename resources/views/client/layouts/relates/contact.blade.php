@extends('client.layouts.master')
@section('title')
    Liên hệ
@endsection
@section('content')
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">Liên hệ</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Contact Email Area Start -->
    <div class="contact-email-area ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Liên hệ với chúng tôi</h3>
                    <p class="text-capitalize mb-40">Điều rất quan trọng là khách hàng phải chú ý đến quá trình hấp thụ.</p>
                    <form id="contact-form" class="contact-form" action="https://htmldemo.net/jantrik/jantrik/mail.php"
                        method="post">
                        <div class="address-wrapper">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="address-fname">
                                        <input type="text" name="name" placeholder="Tên">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-email">
                                        <input type="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="address-web">
                                        <input type="text" name="website" placeholder="Trang website">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="address-subject">
                                        <input type="text" name="subject" placeholder="Chủ thể">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="address-textarea">
                                        <textarea name="message" placeholder="Viết tin nhắn của bạn"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="form-message ml-15"></p>
                        <div class="col-xs-12 footer-content mail-content">
                            <div class="send-email">
                                <input type="submit" value="Gửi" class="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
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
