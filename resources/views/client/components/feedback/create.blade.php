@extends('client.layouts.master')
@section('content')
    <div class="review-wrapper" style="display: flex; justify-content: center; align-items: center;">
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
    </div>
@endsection

@section('css')
    <style>
        .rating {
            display: inline-block;
            margin-top: 10px;
        }

        .rating input {
            display: none; /* Ẩn radio button */
        }

        .rating label {
            font-size: 30px;
            cursor: pointer;
            color: white; /* Màu mặc định là trắng khi chưa chọn */
        }

        /* Khi radio được chọn thì áp dụng màu vàng */
        .rating input:checked ~ label {
            color: gold;
        }

        /* Hiệu ứng hover */
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
        }

        /* Khoảng cách giữa các ngôi sao */
        .rating label {
            margin-right: 5px;
        }
    </style>
@endsection
