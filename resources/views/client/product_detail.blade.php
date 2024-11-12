@extends('client.layouts.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('contents')
        <!-- Breadcrumb Start -->
        <div class="thumnail-desc pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="main-thumb-desc nav">
                            <li><a class="active" data-bs-toggle="tab" href="#dtail">Details</a></li>
                            <li><a data-bs-toggle="tab" href="#review">Reviews </a></li>
                        </ul>
                        <!-- Product Thumbnail Tab Content Start -->
                        <div class="tab-content thumb-content border-default">
                            <div id="dtail" class="tab-pane in active">
                                <p>Everything you need for a trip to the gym will fit inside this surprisingly spacious Products Name Here. Stock it with a water bottle, change of clothes, pair of shoes, and even a few beauty products. Fits inside a locker and zips shut for security.</p>
                                <ul class="tab-list-item">
                                    <li> Slip pocket on front.</li>
                                    <li> Contrast piping.</li>
                                    <li> Durable nylon construction.</li>
                                </ul>
                            </div>
                            <div id="review" class="tab-pane">
                                <!-- Reviews Start -->
                                <div class="review">
                                    <div class="group-title">
                                        <h2>customer review</h2>
                                    </div>
                                    <h4 class="review-mini-title">Jantrik</h4>
                                    <ul class="review-list">
                                        <!-- Single Review List Start -->
                                        <li>
                                            <span>Quality</span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <label>Jantrik</label>
                                        </li>
                                        <!-- Single Review List End -->
                                        <!-- Single Review List Start -->
                                        <li>
                                            <span>price</span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <label>Review by <a href="https://themeforest.net/user/Jantrik">Jantrik</a></label>
                                        </li>
                                        <!-- Single Review List End -->
                                        <!-- Single Review List Start -->
                                        <li>
                                            <span>value</span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <label>Posted on 7/20/18</label>
                                        </li>
                                        <!-- Single Review List End -->
                                    </ul>
                                </div>
                                <!-- Reviews End -->
                                <!-- Reviews Start -->
                                <div class="review border-default universal-padding mt-30">
                                    <h2 class="review-title mb-30">You're reviewing: <br><span>Go-Get'r Pushup Grips</span></h2>
                                    <p class="review-mini-title">your rating</p>
                                    <ul class="review-list">
                                        <!-- Single Review List Start -->
                                        <li>
                                            <span>Quality</span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </li>
                                        <!-- Single Review List End -->
                                        <!-- Single Review List Start -->
                                        <li>
                                            <span>price</span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </li>
                                        <!-- Single Review List End -->
                                        <!-- Single Review List Start -->
                                        <li>
                                            <span>value</span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </li>
                                        <!-- Single Review List End -->
                                    </ul>
                                    <!-- Reviews Field Start -->
                                    <div class="riview-field mt-40">
                                        <form autocomplete="off" action="#">
                                            <div class="form-group">
                                                <label class="req" for="sure-name">Nickname</label>
                                                <input type="text" class="form-control" id="sure-name" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label class="req" for="subject">Summary</label>
                                                <input type="text" class="form-control" id="subject" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label class="req" for="comments">Review</label>
                                                <textarea class="form-control" rows="5" id="comments" required="required"></textarea>
                                            </div>
                                            <button type="submit" class="btn-submit">Submit Review</button>
                                        </form>
                                    </div>
                                    <!-- Reviews Field Start -->
                                </div>
                                <!-- Reviews End -->
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
        <!-- Realted Product Start -->
        <div class="related-product pb-30">
            <div class="container">
                <div class="related-box">
                    <div class="group-title">
                        <h2>related product</h2>
                    </div>
                    <!-- Realted Product Activation Start -->                    
                    <div class="new-upsell-pro owl-carousel">
                        <!-- Single Product Start -->                    
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="product.html">
                                    <img class="primary-img" src="img/products/4.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                            <span class="sticker-new">-32%</span>
                        </div>
                        <!-- Single Product End -->  
                        <!-- Single Product Start -->                    
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="product.html">
                                    <img class="primary-img" src="img/products/1.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
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
                                    <img class="primary-img" src="img/products/2.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/3.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
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
                                    <img class="primary-img" src="img/products/3.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/4.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
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
                                    <img class="primary-img" src="img/products/4.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                            <span class="sticker-new">-32%</span>
                        </div>
                        <!-- Single Product End --> 
                    </div>
                    <!-- Realted Product Activation End -->
                </div>
            </div>
        </div>
        <!-- Realted Product End -->
        <!-- Upsell Product Start -->
        <div class="related-product pb-30">
            <div class="container">
                <div class="usel-product">
                    <div class="group-title">
                        <h2>upsell product</h2>
                    </div>
                    <!-- Upsell Product Activation Start -->
                    <div class="new-upsell-pro owl-carousel">
                        <!-- Single Product Start -->                    
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="product.html">
                                    <img class="primary-img" src="img/products/4.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                            <span class="sticker-new">-32%</span>
                        </div>
                        <!-- Single Product End -->  
                        <!-- Single Product Start -->                    
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="product.html">
                                    <img class="primary-img" src="img/products/1.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
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
                                    <img class="primary-img" src="img/products/2.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/3.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
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
                                    <img class="primary-img" src="img/products/3.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/4.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
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
                                    <img class="primary-img" src="img/products/4.jpg" alt="single-product">
                                    <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
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
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                        <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                            <span class="sticker-new">-32%</span>
                        </div>
                        <!-- Single Product End --> 
                    </div>
                    <!-- Upsell Product Activation End -->
                </div>
            </div>
        </div>
        <!-- Upsell Product End -->
        <!-- Brand Logo Start -->
        <div class="brand-area pb-60">
            <div class="container">
                <!-- Brand Banner Start -->
                <div class="brand-banner owl-carousel">
                    <div class="single-brand">
                        <a href="#"><img class="img" src="img/brand/1.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/2.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/3.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/4.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/5.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img class="img" src="img/brand/1.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/2.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/3.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/4.png" alt="brand-image"></a>
                    </div>
                    <div class="single-brand">
                        <a href="#"><img src="img/brand/5.png" alt="brand-image"></a>
                    </div>
                </div>
                <!-- Brand Banner End -->                
            </div>
        </div>
@endsection
