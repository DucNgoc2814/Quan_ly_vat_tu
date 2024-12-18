<div class="header-bottom header-sticky">
    <div class="container">
        <div class="row justify-content-between">
            <!--  logo Start-->
            <div class="col-auto">
                <div class="logo">
                    <a href="http://quan_ly_vat_tu.test"><img src="{{ asset('themes/admin/assets/images/gemo1.png') }}"
                            alt="logo-image" height="100"></a>
                </div>
            </div>
            <!--  logo End -->

            <!--  Desktop Memu Start -->
            <div class="col-auto d-none d-lg-block">
                <div class="middle-menu pull-right">
                    <nav>
                        <ul class="middle-menu-list">
                            <li><a href="{{ route('home') }}">Trang chủ</a>
                            </li>
                            <li><a href="{{ route('listProduct') }}">Cửa Hàng<i class="fa fa-angle-down"></i></a>
                                <!-- Home Version Dropdown Start -->
                                <ul class="ht-dropdown dropdown-style-two">
                                    @foreach ($category as $categorie)
                                        <li><a
                                                href="{{ route('listProductWCategory', $categorie->sku) }}">{{ $categorie->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- Home Version Dropdown End -->
                            </li>
                            <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ với chúng tôi</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--  Desktop Memu End -->

            <!--  Cartt Box  Start -->
            <div class="col-auto">
                <div class="cart-box text-end">
                    <ul>
                        <li>
                            <div class="user-icon-toggle">
                                @if (Session::has('token'))
                                    @if (Session::get('customer_image'))
                                        <img src="{{ asset('storage/' . (Session::get('customer_image'))) }}" alt="User image"
                                            class="img-circle" style="width: 30px; height: 30px; border-radius: 50%;">
                                    @else
                                        <i class="fa fa-user" style="font-size: 30px;"></i>
                                    @endif
                                @else
                                    <i class="fa fa-user" style="font-size: 30px;"></i>
                                @endif
                            </div>
                            <ul class="ht-dropdown">
                                @if (Session::has('token'))
                                    <li><a href="{{ route('profile') }}">Tài khoản</a></li>
                                    <li><a href="{{ route('password') }}">Đổi mật khẩu</a></li>
                                    <li><a href="{{ route('profileUser') }}">Cập nhật</a></li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <li>
                                            <button type="submit" class="dropdown-item">Đăng xuất</button>
                                        </li>
                                    </form>
                                @else
                                    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                    <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                    {{-- <li><a href="account.html">Tài khoản</a></li> --}}
                                @endif
                            </ul>
                        </li>
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
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 d-lg-none">
                <div class="mobile-menu">
                    <nav>
                        <ul>
                            <li><a href="{{ route('home') }}">Trang chủ</a>
                            </li>
                            <li><a href="{{ route('listProduct') }}">Cửa Hàng</a>
                                <!-- Mobile Menu Dropdown Start -->
                                <ul>
                                    {{-- <li><a href="{{ route('listProduct') }}">Cửa Hàng</a>
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
                                    </li> --}}
                                    {{-- <li><a href="product.html">product details Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li> --}}
                                    @foreach ($category as $categorie)
                                        <li><a
                                                href="{{ route('listProductWCategory', $categorie->sku) }}">{{ $categorie->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- Mobile Menu Dropdown End -->
                            </li>
                            <li><a href="{{ route('about') }}">Giới thiệu</a>
                            <li><a href="{{ route('contact') }}">Liên hệ với chúng tôi</a>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
