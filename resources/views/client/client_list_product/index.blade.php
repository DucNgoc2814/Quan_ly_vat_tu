@extends('client.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection
@section('content')
    <div class="breadcrumb-area ptb-60 ptb-sm-30">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="shop.html">Shop</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-shop-page pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <div class="sidebar white-bg">
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>Danh mục</h2>
                            </div>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('listProductWCategory', $category->sku) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>Giá</h2>
                            </div>
                            <form action="#" id="price-filter-form">
                                <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                </div>
                                <input id="amount" class="amount" readonly type="text" placeholder="Price range">
                            </form>
                        </div>


                        <div class="single-sidebar">
                            <div class="group-title">
                                <h2>Nhà sản xuất</h2>
                            </div>
                            <ul class="manufactures-list">
                                @foreach ($brands as $brand)
                                    <li><a href="#">{{ $brand->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 order-lg-2">
                    <div class="grid-list-top border-default universal-padding fix mb-30">
                        <div class="grid-list-view f-left">
                            <ul class="list-inline nav">
                                <li><a data-bs-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                <li><a class="active" data-bs-toggle="tab" href="#list-view"><i
                                            class="fa fa-list-ul"></i></a></li>
                                <li><span class="grid-item-list"> Items 1-12 of 13</span></li>
                            </ul>
                        </div>
                        <div class="main-toolbar-sorter f-right">
                            <div class="toolbar-sorter">
                                <label>Price</label>
                                <span>
                                    <a href="#" id="sortOrder" data-order="desc"><i class="fa fa-arrow-down"></i></a>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="main-categorie">
                        <div class="tab-content fix">
                            <div id="grid-view" class="tab-pane active">
                                <div class="row" id="product-list">
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="single-product">
                                                <div class="pro-img">
                                                    <a href="product.html">
                                                        <img class="primary-img"
                                                            src="{{ asset('/themes/client/jantrik/img/products/1.jpg') }}"
                                                            alt="single-product">
                                                        <img class="secondary-img"
                                                            src="{{ asset('/themes/client/jantrik/img/products/2.jpg') }}"
                                                            alt="single-product">
                                                    </a>
                                                </div>
                                                <div class="pro-content">
                                                    <div class="product-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <h4><a href="product.html">{{ $product->name }}</a></h4>
                                                    <p><span class="price">{{ $product->price }}</span><del
                                                            class="prev-price">$32.00</del></p>
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
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="list-view" class="tab-pane">
                                @foreach ($products as $product)
                                    <div class="single-product">
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
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h4><a href="product.html">{{ $product->name }}</a></h4>
                                            <p><span class="price">{{ $product->price }}</span><del
                                                    class="prev-price">$32.00</del></p>
                                            <p>{{ $product->description }}</p>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pagination-box fix">
                        <ul class="blog-pagination">
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                        <div class="toolbar-sorter-footer">
                            <label>show</label>
                            <select class="sorter" name="sorter">
                                <option value="Position" selected="selected">12</option>
                                <option value="Product Name">15</option>
                                <option value="Price">30</option>
                            </select>
                            <span>per page</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sorting logic
            $('#sortOrder').click(function(e) {
                e.preventDefault();
                let order = $(this).data('order');
                $(this).data('order', order === 'asc' ? 'desc' : 'asc');
                $(this).find('i').toggleClass('fa-arrow-up fa-arrow-down');

                let products = $('#product-list .col-lg-4');
                products.sort(function(a, b) {
                    let priceA = parseFloat($(a).find('.price').text().replace('$', ''));
                    let priceB = parseFloat($(b).find('.price').text().replace('$', ''));
                    return order === 'asc' ? priceA - priceB : priceB - priceA;
                });
                $('#product-list').html(products); // Append sorted products
            });

            // Price range slider setup
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000000,
                step: 10,
                values: [100, 1000000],
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                },
                change: filterProducts // Apply filter when slider value changes
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

            // Initial display of products without hiding any
            $(".col-lg-4").show();

            // Product filtering function based on price range
            function filterProducts() {
                let [minPrice, maxPrice] = $("#slider-range").slider("values");

                $("#product-list .col-lg-4").each(function() {
                    let productPrice = parseFloat($(this).find(".price").text().replace('$', ''));
                    // Toggle the entire col-lg-4 container based on price
                    $(this).toggle(productPrice >= minPrice && productPrice <= maxPrice);
                });
            }
        });
    </script>
@endsection
