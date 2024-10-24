<div class="header-bottom header-sticky">
    <div class="container">
        <div class="row justify-content-between">
            <!--  logo Start-->
            <div class="col-auto">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('themes/client/jantrik/img/logo/logo.png') }}"
                            alt="logo-image"></a>
                </div>
            </div>
            <!--  logo End -->

            <!--  Desktop Memu Start -->
            <div class="col-auto d-none d-lg-block">
                <div class="middle-menu pull-right">
                    <nav>
                        <ul class="middle-menu-list">
                            <li><a href="index.html">home<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown home-dropdown">
                                    <li><a href="index.html">Home Version One</a></li>
                                    <li><a href="index-2.html">Home Version Two</a></li>
                                    <li><a href="index-3.html">Home Box Layout</a></li>
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="about.html">about us</a></li>
                            <li><a href="shop.html">shop<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    <li><a href="shop.html">Shop</a>
                                        <!-- Start Two Step -->
                                        <ul class="ht-dropdown dropdown-style-two sub-menu">
                                            <li><a href="shop.html">Product Category Name</a>
                                                <!-- Start Three Step -->
                                                <ul class="ht-dropdown dropdown-style-two sub-menu">
                                                    <li><a href="shop.html">Product Category Name</a></li>
                                                    <li><a href="shop.html">Product Category Name</a></li>
                                                    <li><a href="shop.html">Product Category Name</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">Product Category Name</a></li>
                                            <li><a href="shop.html">Product Category Name</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product.html">product details Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="blog.html">Blog<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    <li><a href="blog.html">Blog Page</a></li>
                                    <li><a href="blog-details.html">Blog Details Page</a></li>
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="#">pages<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    <li><a href="login.html">Login Page</a></li>
                                    <li><a href="register.html">Register Page</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                    <li><a href="forgot-password.html">Forgot Password Page</a></li>
                                    <li><a href="account.html">Account Page</a></li>
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="contact.html">contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--  Desktop Memu End -->

            <!--  Cartt Box  Start -->
            <div class="col-auto">
                <div class="cart-box text-end">
                    <ul>
                        <li><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-basket"></i><span
                                    class="cart-counter">2</span></a>
                            <ul class="ht-dropdown main-cart-box">
                                <li>
                                    <!-- Cart Box Start -->
                                    <div class="single-cart-box">
                                        <div class="cart-img">
                                            <a href="#"><img
                                                    src="{{ asset('themes/client/jantrik/img/menu/1.jpg') }}"
                                                    alt="cart-image"></a>
                                        </div>
                                        <div class="cart-content">
                                            <h6><a href="product.html">Products Name</a></h6>
                                            <span>1 × $399.00</span>
                                        </div>
                                        <a class="del-icone" href="#"><i class="fa fa-window-close-o"></i></a>
                                    </div>
                                    <!-- Cart Box End -->
                                    <!-- Cart Box Start -->
                                    <div class="single-cart-box">
                                        <div class="cart-img">
                                            <a href="#"><img
                                                    src="{{ asset('themes/client/jantrik/img/menu/2.jpg') }}"
                                                    alt="cart-image"></a>
                                        </div>
                                        <div class="cart-content">
                                            <h6><a href="product.html">Products Name</a></h6>
                                            <span>2 × $299.00</span>
                                        </div>
                                        <a class="del-icone" href="#"><i class="fa fa-window-close-o"></i></a>
                                    </div>
                                    <!-- Cart Box End -->
                                    <!-- Cart Footer Inner Start -->
                                    <div class="cart-footer fix">
                                        <h5>Total:<span class="f-right">$698.00</span></h5>
                                        <div class="cart-actions">
                                            <a class="checkout" href="checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                    <!-- Cart Footer Inner End -->
                                </li>
                            </ul>
                        </li>
                        <li><a href="compare.html"><i class="fa fa-user"></i></a>
                            {{-- <i class="fa fa-cog"> --}}
                            <ul class="ht-dropdown">
                                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                <li><a href="account.html">Tài khoản</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!--  Cartt Box  End-->
            <!-- Mobile Menu Start -->
            <div class="col-sm-12 d-lg-none">
                <div class="mobile-menu">
                    <nav>
                        <ul>
                            <li><a href="index.html">home</a>
                                <!-- Home Version Dropdown Start -->
                                <ul>
                                    <li><a href="index.html">Home Version One</a></li>
                                    <li><a href="index-2.html">Home Version Two</a></li>
                                    <li><a href="index-3.html">Home Box Layout</a></li>
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="shop.html">shop</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    <li><a href="product.html">Shop</a>
                                        <ul>
                                            <li><a href="shop.html">Product Category Name</a>
                                                <!-- Start Three Step -->
                                                <ul>
                                                    <li><a href="shop.html">Product Category Name</a></li>
                                                    <li><a href="shop.html">Product Category Name</a></li>
                                                    <li><a href="shop.html">Product Category Name</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">Product Category Name</a></li>
                                            <li><a href="shop.html">Product Category Name</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="product.html">product details Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="blog.html">Blog</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    <li><a href="blog-details.html">Blog Details Page</a></li>
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="#">pages</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    <li><a href="login.html">login Page</a></li>
                                    <li><a href="register.html">Register Page</a></li>
                                    <li><a href="404.html">404 Page</a></li>
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="about.html">about us</a></li>
                            <li><a href="contact.html">contact us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Mobile Menu  End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
