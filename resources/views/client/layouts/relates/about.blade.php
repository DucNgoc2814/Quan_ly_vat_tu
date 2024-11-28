@extends('client.layouts.master')
@section('title')
    Giới thiệu
@endsection
@section('content')
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="active">Giới thiệu</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Contact Email Area Start -->
    <div class="about-main-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="about-img">
                        <img class="img" src="{{ asset('themes/client/jantrik/img/banner/about.jpg') }}" alt="about-us">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="about-content">
                        <h3>Chúng tôi là ai?</h3>
                        <p>Là đơn vị tiên phong trong lĩnh vực cung cấp vật liệu xây dựng trực tuyến, chúng tôi tự hào mang đến giải pháp mua sắm toàn diện và thuận tiện nhất cho khách hàng. Với hơn 10 năm kinh nghiệm trong ngành, chúng tôi cam kết cung cấp sản phẩm chất lượng cao với giá cả cạnh tranh nhất.</p>
                        <p>Đội ngũ chuyên gia của chúng tôi luôn sẵn sàng tư vấn và hỗ trợ khách hàng lựa chọn vật liệu phù hợp nhất cho công trình của họ.</p>
                        <ul class="mt-20 about-content-list">
                            <li><a href="#">Sản phẩm chính hãng 100%</a></li>
                            <li><a href="#">Giao hàng nhanh chóng toàn quốc</a></li>
                            <li><a href="#">Đội ngũ tư vấn chuyên nghiệp</a></li>
                            <li><a href="#">Chính sách bảo hành rõ ràng</a></li>
                            <li><a href="#">Giá cả cạnh tranh nhất thị trường</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-bottom pt-50 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="ht-single-about pb-sm-40">
                        <h3>KINH NGHIỆM CỦA CHÚNG TÔI</h3>
                        <h5>Đối tác tin cậy trong lĩnh vực vật liệu xây dựng</h5>
                        <p>Với hơn một thập kỷ hoạt động trong ngành vật liệu xây dựng, chúng tôi đã xây dựng được mạng lưới đối tác rộng khắp và được tin tưởng bởi hàng nghìn khách hàng. Đội ngũ chuyên gia của chúng tôi không ngừng cập nhật những xu hướng mới nhất về vật liệu xây dựng để mang đến những sản phẩm tốt nhất cho khách hàng.</p>
                        <p>Chúng tôi tự hào là nhà cung cấp vật liệu xây dựng cho nhiều công trình trọng điểm, từ các dự án nhà ở đến các công trình công nghiệp quy mô lớn. Sự hài lòng của khách hàng chính là thước đo cho sự thành công của chúng tôi.</p>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="ht-single-about">
                        <h3>DỊCH VỤ CỦA CHÚNG TÔI</h3>
                        <div class="ht-about-work">
                            <span>1</span>
                            <div class="ht-work-text">
                                <h5><a href="#">TƯ VẤN CHUYÊN NGHIỆP</a></h5>
                                <p>Đội ngũ tư vấn giàu kinh nghiệm, hỗ trợ khách hàng chọn vật liệu phù hợp nhất</p>
                            </div>
                        </div>
                        <div class="ht-about-work">
                            <span>2</span>
                            <div class="ht-work-text">
                                <h5><a href="#">GIAO HÀNG TẬN NƠI</a></h5>
                                <p>Dịch vụ vận chuyển nhanh chóng, đảm bảo hàng hóa đến tay khách hàng an toàn</p>
                            </div>
                        </div>
                        <div class="ht-about-work">
                            <span>3</span>
                            <div class="ht-work-text">
                                <h5><a href="#">HỖ TRỢ SAU BÁN HÀNG</a></h5>
                                <p>Chính sách bảo hành rõ ràng, hỗ trợ kỹ thuật 24/7</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="ht-single-about">
                        <h3>KINH NGHIỆM CỦA CHÚNG TÔI</h3>
                        <h5>Với hơn 10 năm kinh nghiệm trong ngành vật liệu xây dựng</h5>
                        <p>Chúng tôi tự hào là đối tác tin cậy của hàng nghìn công trình xây dựng trên toàn quốc. Từ các dự án nhà ở đến các công trình công nghiệp quy mô lớn, chúng tôi luôn đảm bảo cung cấp vật liệu chất lượng cao, đáp ứng mọi yêu cầu kỹ thuật.</p>
                        <p>Với hệ thống kho bãi rộng khắp và đội ngũ nhân viên chuyên nghiệp, chúng tôi cam kết mang đến trải nghiệm mua sắm trực tuyến thuận tiện và đáng tin cậy nhất cho khách hàng.</p>
                    </div>
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
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/2.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/3.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/4.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/5.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img class="img" src="{{ asset('themes/client/jantrik/img/brand/1.png') }}"
                            alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/2.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/3.png') }}" alt="brand-image"></a>
                </div>
                <div class="single-brand">
                    <a href="#"><img src="{{ asset('themes/client/jantrik/img/brand/4.png') }}" alt="brand-image"></a>
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
