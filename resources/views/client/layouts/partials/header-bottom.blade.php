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
                            <li><a href="{{ route('listHome') }}">Trang chủ</a>
                            </li>
                            <li><a href="{{ route('listProduct') }}">Danh mục<i class="fa fa-angle-down"></i></a>
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
                        <li>
                            <a href="compare.html">
                                @if (Auth::check())
                                    {{-- @if (Auth::user()->image)
                                        <img src="{{ Storage::url($user->image) }}" alt="User image"
                                            class="img-circle" style="width: 30px; height: 30px; border-radius: 50%;">
                                    @else --}}
                                    <i class="fa fa-user"></i>
                                    {{-- @endif --}}
                                @else
                                    <i class="fa fa-user"></i>
                                @endif
                            </a>
                            <ul class="ht-dropdown">
                                @if (Auth::check())
                                    @if (Auth::user()->is_active == '4')
                                        <li>
                                            <a href="">Trang Admin</a>
                                        </li>
                                    @endif
                                    <li><a href="{{ route('profile') }}">Tài khoản</a></li>
                                    <li><a href="{{ route('password') }}">Đổi mật khẩu</a></li>
                                    <li><a href="{{ route('profileUser') }}">Cập nhật</a></li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <li>
                                            <a href="">
                                                <button type="submit" class="dropdown-item">Đăng xuất</button>
                                            </a>
                                        </li>
                                    </form>
                                @else
                                    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                    <li><a href="{{ route('register') }}">Đăng ký</a></li>
                                    <li><a href="account.html">Tài khoản</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 d-lg-none">
                <div class="mobile-menu">
                    <nav>
                        <ul>
                            <li><a href="index.html">Trang chủ</a>
                            </li>
                            <li><a href="shop.html">Danh mục</a>
                                <ul>
                                    @foreach ($category as $categorie)
                                    <li><a
                                            href="{{ route('listProductWCategory', $categorie->sku) }}">{{ $categorie->name }}</a>
                                    </li>
                                @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
