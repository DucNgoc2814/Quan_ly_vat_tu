@extends('client.layouts.master')
@section('content')
    <div class="contact-email-area ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Contact Us</h3>
                    <p class="text-capitalize mb-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <form id="contact-form" class="contact-form" action="{{ route('feedback.store') }}" method="post">
                        @csrf
                        <div class="address-wrapper">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="address-fname">
                                        <label for="">Tên</label>
                                        <input type="text" name="name" placeholder="Nhập tên">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-email">
                                        <label for="">Email</label>
                                        <input type="email" name="email" placeholder="Nhập Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-web">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" name="number_" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="address-textarea">

                                        <textarea name="content" placeholder="Nhập nội dung phản hồi"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="form-message ml-15"></p>
                        <div class="col-xs-12 footer-content mail-content">
                            <div class="send-email">
                                <input type="submit" value="Submit" class="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="review-wrapper" style="display: flex; justify-content: center; align-items: center;">
        <div class="review border-default universal-padding mt-30">
            <h2 class="review-title mb-30">Bạn đang xem xét: <br><span>Go-Get'</span></h2>
            <p class="review-mini-title">Đánh giá của bạn</p>
            

            <!-- Reviews Field Start -->
            <div class="mt-40">
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="req" for="sure-name">Tên</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-lg-12">
                            <label class="req" for="email">email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="col-lg-12">
                            <label class="req" for="subject">SĐT</label>
                            <input type="text" class="form-control" name="number_phone">
                        </div>
                        <div class="col-lg-12">
                            <label class="req" for="content">Nội dung đánh giá</label>
                            <textarea class="form-control" rows="5" name="content"></textarea> <br>
                        </div>
                        <div class="col-lg-12">
                            <label class="req" for="content">Ngày Phản hồi</label>
                            <input type="date" class="form-control" name="created_at" value="{{ date('Y-m-d') }}"> <br>
                        </div>
                    </div>
                    <div class="mt-3" style="justify-content: center; display: flex;">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
            <!-- Reviews Field End -->
        </div>
    </div> --}}
@endsection
