@extends('client.layouts.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><a href="shop.html">Sản phẩm</a></li>
                    <li class="active"><a href="product.html">Product</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail pb-60">
        <div class="container">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane active">
                            <a data-fancybox="images" href="img/products/1.jpg"><img
                                    src="{{ asset('storage/' . $product->image) }}" alt="product-view"></a>
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->

                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail">
                        <div class="thumb-menu nav">
                            @foreach ($galleries as $index => $gallery)
                                <a class="{{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#thumb{{ $index + 1 }}">
                                    <img src="{{ asset('storage/' . $gallery->url) }}" alt="product-thumbnail">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7">
                    <div class="thubnail-desc fix">
                        <h2 class="product-header" style="text-align: left;">{{ $product->name }}</h2>

                        <div class="pro-price mb-10 mt-10" style="display: flex; flex-direction: column;">
                            <h5 style="margin-bottom: 10px;">Giá: <span class="price"
                                    style="color: red; font-size: 20px">{{ number_format($product->price, 0, ',', '.') }}</span>
                            </h5>
                            <p style="margin: 0;">
                                <span class="in-stock">Số lượng tồn kho:</span>
                                <span class="sku" id="stockCount">{{ $variations->sum('stock') }}</span>
                            </p>
                        </div>
                        <div class="product-variants mb-15">
                            <label for="variants">Biến thể sản phẩm:</label>
                            <div id="variants" class="form-control">
                                @if($attributes->isEmpty() || $attributes->every(fn($attribute) => $attribute->attributeValues->isEmpty()))
                                    <p>Không có biến thể</p>
                                @else
                                    @foreach ($attributes as $attribute)
                                        <div style="margin-bottom: 10px;">
                                            <span class="variant" style="margin-right: 10px; display: inline-block; font-size: 14px;">{{ $attribute->name }}:</span>
                                            @if($attribute->attributeValues->isEmpty())
                                                <p>Không có giá trị thuộc tính</p>
                                            @else
                                                @foreach ($attribute->attributeValues as $value)
                                                    @php
                                                        // Lấy số lượng tồn kho cho biến thể dựa trên attribute_value_id
                                                        $variationsWithValue = $variations->filter(function ($variation) use ($value) {
                                                            return $variation->attributeValues &&
                                                                $variation->attributeValues->contains('attribute_value_id', $value->id);
                                                        });
                                                        
                                                        // Tính tổng số lượng tồn kho cho tất cả các biến thể có giá trị thuộc tính
                                                        $totalStock = $variationsWithValue->sum('stock');
                                                    @endphp
                                                    <span class="variant"
                                                        style="display: inline-block; border: 1px solid #ccc; padding: 5px; margin-right: 5px; width: 50px; text-align: center; font-size: 12px; cursor: pointer;"
                                                        onclick="selectVariant('{{ $attribute->id }}', '{{ $value->id }}', {{ $totalStock }})">
                                                        <input type="radio" name="variant_{{ $attribute->id }}" id="variant_{{ $value->id }}" value="{{ $value->id }}" style="display: none;">
                                                        {{ $value->value }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="box-quantity">
                            <form action="#">
                                <div>
                                    <label for="">Số lượng</label>
                                    <input class="number" id="numeric" type="number" min="1" value="1"><br>
                                </div>
                                <div class="mt-10">
                                    <a class="add-cart" href="cart.html" style="width: 150px">Thêm giỏ hàng</a>
                                    <button class="add-cart" href="cart.html" style="background: red;">Đặt hàng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail End -->
    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc pb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <!-- Product Thumbnail Tab Content Start -->
                    <div class="tab-content thumb-content border-default">
                        <h3>Mô tả</h3>
                        <div id="dtail" class="tab-pane in active">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    <!-- Product Thumbnail Tab Content End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail Description End -->
    <!-- Related Products Start -->
    <div class="related-product pb-30">
        <div class="container">
            <div class="related-box">
                <div class="group-title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
                <!-- Related Product Activation Start -->
                <div class="new-upsell-pro owl-carousel">
                    @foreach ($relatedProducts as $relatedProduct)
                    <div class="single-product">
                        <div class="pro-img">
                            <a href="{{ route('productDetail', $relatedProduct->slug) }}">
                                <img class="primary-img" src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}">
                                <img class="secondary-img" src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}">
                            </a>
                        </div>
                        <div class="pro-content">
                            <h4><a href="{{ route('productDetail', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a></h4>
                            <p><span class="in-stock">Số lượng tồn kho:</span><span class="sku">{{ $relatedProduct->stock }}</span></p>
                            <p><span class="price">{{ number_format($relatedProduct->price, 0, ',', '.') }} VNĐ</span></p>
                            <a class="add-cart" href="{{ route('productDetail', $relatedProduct->slug) }}" style="width: 150px">Xem sản phẩm</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Related Product Activation End -->
            </div>
        </div>
    </div>
@endsection
<style>
    .product-header {
        font-size: 24px;
        /* Kích thước chữ lớn hơn cho tên sản phẩm */
        font-weight: bold;
        /* Chữ đậm */
        color: #333;
        /* Màu chữ tối */
        margin-bottom: 10px;
        /* Khoảng cách dưới */
        text-align: center;
        /* Căn giữa */
    }

    .pro-ref {
        font-size: 14px;
        /* Kích thước chữ cho thông tin tồn kho */
        color: #666;
        /* Màu xám cho thông tin */
        text-align: center;
        /* Căn giữa */
        margin-bottom: 10px;
        /* Khoảng cách dưới */
    }

    .price {
        font-size: 20px;
        /* Kích thước chữ lớn hơn cho giá */
        color: #ff5722;
        /* Màu chữ cho giá */
        font-weight: bold;
        /* Chữ đậm */
        text-align: center;
        /* Căn giữa */
        margin-bottom: 15px;
        /* Khoảng cách dưới */
    }

    .add-cart {
        background-color: #ff9800;
        /* Màu nền cho nút */
        color: #fff;
        /* Màu chữ trắng */
        padding: 12px 20px;
        /* Khoảng cách bên trong nút */
        border-radius: 5px;
        /* Bo góc cho nút */
        text-decoration: none;
        /* Bỏ gạch chân */
        display: inline-block;
        /* Để nút có thể căn giữa */
        text-align: center;
        /* Căn giữa chữ trong nút */
        transition: background-color 0.3s;
        /* Hiệu ứng chuyển màu nền khi hover */
        font-size: 16px;
        /* Kích thước chữ cho nút */
    }

    .add-cart:hover {
        background-color: #e68a00;
        /* Màu nền khi hover */
    }

    .product-thumbnail img {
        width: 100%; /* Đặt chiều rộng hình ảnh là 100% của phần tử chứa */
        height: auto; /* Giữ tỷ lệ khung hình */
        max-width: 200px; /* Đặt chiều rộng tối đa cho hình ảnh */
        max-height: 200px; /* Đặt chiều cao tối đa cho hình ảnh */
        object-fit: cover; /* Cắt hình ảnh để phù hợp với kích thước */
    }
</style>
<script>
    function selectVariant(attributeId, variantId, stock) {
        // Reset tất cả các biến thể
        const variants = document.querySelectorAll(`input[name="variant_${attributeId}"]`);
        variants.forEach(variant => {
            const span = variant.parentElement;
            span.style.backgroundColor = ''; // Reset background color
        });

        // Chọn biến thể đã chọn
        const selectedVariant = document.getElementById(`variant_${variantId}`);
        selectedVariant.checked = true; // Check the selected radio button
        selectedVariant.parentElement.style.backgroundColor = 'lightgray'; // Change background color of selected span

        // Cập nhật số lượng tồn kho
        document.getElementById('stockCount').innerText = stock; // Cập nhật số lượng tồn kho
    }
</script>
