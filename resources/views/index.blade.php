@extends('client.layouts.master')

@section('title')
    Home
@endsection

@section('content')
    <!-- Slider Area Start -->
    <div class="slider-area slider-style-three">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="slider-wrapper theme-default">
                        <!-- Slider Background  Image Start-->
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <a href="shop.html">
                                        <img src="{{ asset('themes/client/jantrik/img/slider/5.jpg') }}" class="d-block w-100" alt="">
                                    </a>
                                    <div class="carousel-caption">
                                        <div class="text-content-wrapper">
                                            <div class="text-content">
                                                <h4 class="title2 wow bounceInLeft text-white mb-16" data-wow-duration="2s" data-wow-delay="0s">Big Sale</h4>
                                                <h1 class="title1 wow bounceInRight text-white mb-16" data-wow-duration="2s" data-wow-delay="1s">Hand Tools <br>Power Saw Machine</h1>
                                                <div class="banner-readmore wow bounceInUp mt-35" data-wow-duration="2s" data-wow-delay="2s">
                                                    <a class="button slider-btn" href="shop.html" style="background-color: #ffd700; color: #fff; padding: 8px 20px; border-radius: 20px; font-size: 15px; font-weight: 500; text-transform: uppercase; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);">Shop Now</a>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="carousel-item">
                                    <a href="shop.html">
                                        <img src="{{ asset('themes/client/jantrik/img/slider/6.jpg') }}" class="d-block w-100" alt="">
                                    </a>
                                    <div class="carousel-caption">
                                        <div class="text-content-wrapper">
                                            <div class="text-content slide-2">
                                                <h4 class="title2 wow bounceInLeft text-white mb-16" data-wow-duration="1s" data-wow-delay="1s">Big Sale</h4>
                                                <h1 class="title1 wow flipInX text-white mb-16" data-wow-duration="1s" data-wow-delay="2s">Hand Tools <br>Power Saw Machine</h1>
                                                <div class="banner-readmore wow bounceInUp mt-35" data-wow-duration="2s" data-wow-delay="2s">
                                                    <a class="button slider-btn" href="shop.html" style="background-color: #ffd700; color: #fff; padding: 8px 20px; border-radius: 20px; font-size: 15px; font-weight: 500; text-transform: uppercase; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);">Shop Now</a>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Single Banner Start -->
                    <div class="single-banner zoom mb-20">
                        <a href="#"><img src="{{ asset('themes/client/jantrik/img/banner/9.jpg') }}"
                                alt="slider-banner"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner zoom">
                        <a href="#"><img src="{{ asset('themes/client/jantrik/img/banner/10.jpg') }}"
                                alt="slider-banner"></a>
                    </div>
                    <!-- Single Banner End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End -->
    <!-- Product Area Start -->
    <div class="product-area pt-30">
        <div class="container">
            <div class="row">
                <!-- Single Product Start -->
                @foreach ($products as $product)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="product.html">
                                    <img class="primary-img" src="{{ asset('themes/client/jantrik/img/products/1.jpg') }}"
                                        alt="single-product">
                                    <img class="secondary-img" src="{{ asset('themes/client/jantrik/img/products/2.jpg') }}"
                                        alt="single-product">
                                </a>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content">
                                <h4><a href="product.html">{{ $product->name }}</a></h4>
                                <p><span class="price">{{ $product->price }}.đ</span></p>
                                <div class="pro-actions">
                                    <div class="actions-secondary">
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i
                                                class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add
                                            To
                                            Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i
                                                class="fa fa-signal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Product Area End -->
    <!-- Banner Start -->
    <div class="upper-banner banner pb-60">
        <div class="container">
            <div class="row">
                <!-- Single Banner Start -->
                <div class="col-sm-6">
                    <div class="single-banner zoom">
                        <a href="#"><img src="{{ asset('themes/client/jantrik/img/banner/1.png') }}"
                                alt="slider-banner"></a>
                    </div>
                </div>
                <!-- Single Banner End -->
                <!-- Single Banner Start -->
                <div class="col-sm-6">
                    <div class="single-banner zoom">
                        <a href="#"><img src="{{ asset('themes/client/jantrik/img/banner/2.png') }}"
                                alt="slider-banner"></a>
                    </div>
                </div>
                <!-- Single Banner End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Banner End -->
    <!-- New Products Start -->
    <div class="new-products pb-60">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2">
                    <div class="side-product-list">
                        <div class="group-title">
                            <h2>Sản phẩm hàng đầu </h2>
                        </div>
                        <!-- Deal Pro Activation Start -->
                        <div class="slider-right-content side-product-list-active owl-carousel">
                            <!-- Double Product Start -->
                            <div class="double-pro">
                                <!-- Single Product Start -->
                                @foreach ($products as $product)
                                    <div class="single-product">
                                        <div class="pro-img">
                                            <a href="product.html"><img class="img"
                                                    src="{{ asset('themes/client/jantrik/img/products/1.jpg') }}"
                                                    alt="product-image"></a>
                                        </div>
                                        <div class="pro-content">
                                            <h4><a href="product.html">{{ $product->name }}</a></h4>
                                            <p><span class="price">{{ $product->price }}</span></p>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Single Product End -->
                            </div>
                            <!-- Double Product End -->
                        </div>
                        <!-- Deal Pro Activation End -->
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8  order-lg-2">
                    <!-- New Pro Content End -->
                    <div class="new-pro-content">
                        <div class="pro-tab-title border-line">
                            <!-- Featured Product List Item Start -->
                            <ul class="nav product-list product-tab-list">
                                <li><a class="active" data-bs-toggle="tab" href="#new-arrival">Sản phẩm nổi bật</a></li>
                            </ul>
                            <!-- Featured Product List Item End -->
                        </div>
                        <div class="tab-content product-tab-content jump">
                            <div id="new-arrival" class="tab-pane active">
                                <!-- New Products Activation Start -->
                                <div class="new-pro-active owl-carousel">
                                    <!-- Single Product Start -->
                                    @foreach ($products as $product)
                                        <div class="single-product">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="product.html">
                                                    <img class="primary-img"
                                                        src="{{ asset('themes/client/jantrik/img/products/1.jpg') }}"
                                                        alt="single-product">
                                                    <img class="secondary-img"
                                                        src="{{ asset('themes/client/jantrik/img/products/2.jpg') }}"
                                                        alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <h4><a href="product.html">{{ $product->name }}</a></h4>
                                                <p><span class="price">{{ $product->price }}</span><del
                                                        class="prev-price">$32.00</del>
                                                </p>
                                                <div class="pro-actions">
                                                    <div class="actions-secondary">
                                                        <a href="wishlist.html" data-toggle="tooltip"
                                                            title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                        <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                            title="Add to Cart">Add To Cart</a>
                                                        <a href="compare.html" data-toggle="tooltip"
                                                            title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                    @endforeach
                                    <!-- Single Product End -->
                                </div>
                                <!-- New Products Activation End -->
                            </div>
                            <!-- New Products End -->
                            <div id="toprated" class="tab-pane">
                                <!-- New Products Activation Start -->
                                <div class="new-pro-active owl-carousel">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/4.jpg') }}"
                                                    alt="single-product">
                                                <img class="secondary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/3.jpg') }}"
                                                    alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>
                                            <div class="pro-actions">
                                                <div class="actions-secondary">
                                                    <a href="wishlist.html" data-toggle="tooltip"
                                                        title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                    <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                        title="Add to Cart">Add To Cart</a>
                                                    <a href="compare.html" data-toggle="tooltip"
                                                        title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/3.jpg') }}"
                                                    alt="single-product">
                                                <img class="secondary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/2.jpg') }}"
                                                    alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>
                                            <div class="pro-actions">
                                                <div class="actions-secondary">
                                                    <a href="wishlist.html" data-toggle="tooltip"
                                                        title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                    <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                        title="Add to Cart">Add To Cart</a>
                                                    <a href="compare.html" data-toggle="tooltip"
                                                        title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        <span class="sticker-new">-30%</span>
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/1.jpg') }}"
                                                    alt="single-product">
                                                <img class="secondary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/2.jpg') }}"
                                                    alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>
                                            <div class="pro-actions">
                                                <div class="actions-secondary">
                                                    <a href="wishlist.html" data-toggle="tooltip"
                                                        title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                    <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                        title="Add to Cart">Add To Cart</a>
                                                    <a href="compare.html" data-toggle="tooltip"
                                                        title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/1.jpg') }}"
                                                    alt="single-product">
                                                <img class="secondary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/2.jpg') }}"
                                                    alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>
                                            <div class="pro-actions">
                                                <div class="actions-secondary">
                                                    <a href="wishlist.html" data-toggle="tooltip"
                                                        title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                    <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                        title="Add to Cart">Add To Cart</a>
                                                    <a href="compare.html" data-toggle="tooltip"
                                                        title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/2.jpg') }}"
                                                    alt="single-product">
                                                <img class="secondary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/3.jpg') }}"
                                                    alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>
                                            <div class="pro-actions">
                                                <div class="actions-secondary">
                                                    <a href="wishlist.html" data-toggle="tooltip"
                                                        title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                    <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                        title="Add to Cart">Add To Cart</a>
                                                    <a href="compare.html" data-toggle="tooltip"
                                                        title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="product.html">
                                                <img class="primary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/3.jpg') }}"
                                                    alt="single-product">
                                                <img class="secondary-img"
                                                    src="{{ asset('themes/client/jantrik/img/products/4.jpg') }}"
                                                    alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">Products Name Here</a></h4>
                                            <p><span class="price">$30.00</span><del class="prev-price">$32.00</del></p>
                                            <div class="pro-actions">
                                                <div class="actions-secondary">
                                                    <a href="wishlist.html" data-toggle="tooltip"
                                                        title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                    <a class="add-cart" href="cart.html" data-toggle="tooltip"
                                                        title="Add to Cart">Add To Cart</a>
                                                    <a href="compare.html" data-toggle="tooltip"
                                                        title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                <!-- New Products Activation End -->
                            </div>
                        </div>
                        <!-- Tab-Content End -->
                        <div class="single-banner zoom mt-30 mt-sm-10">
                            <a href="#"><img src="{{ asset('themes/client/jantrik/img/banner/tab-banner.jpg') }}"
                                    alt="slider-banner"></a>
                        </div>
                    </div>
                    <!-- New Pro Content End -->
                </div>
            </div>

        </div>
        <!-- Container End -->
    </div>
    <!-- New Products End -->
    <!-- Company Policy Start -->
    <div class="company-policy pb-60">
        <div class="container">
            <div class="row">
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="{{ asset('themes/client/jantrik/img/icon/1.png') }}" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Free Delivery</h3>
                            <p>Free shipping on all order</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="{{ asset('themes/client/jantrik/img/icon/2.png') }}" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Online Support 24/7</h3>
                            <p>Support online 24 hours</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="{{ asset('themes/client/jantrik/img/icon/3.png') }}" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Money Return</h3>
                            <p>Back guarantee under 7 days</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="{{ asset('themes/client/jantrik/img/icon/4.png') }}" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Member Discount</h3>
                            <p>Onevery order over $30.00</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
            </div>
        </div>
    </div>
    <!-- Company Policy End -->
    <!-- Best Products Start -->
    <!-- Best Product End -->
    <!-- Blog Page Start -->

    <!-- Blog Page End -->
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
