<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashi | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    @yield('css')
    <style>
        .img-popup-cart {
            width: 75px;
            height: 75px;
        }

        .nav-custom {
            float: right;
            margin-top: 16px;
            margin-bottom: 13px;
            background: none;
        }

        .depart-btn-custom {
            background: none !important;
            color: black !important;
            padding: 0px 100px 0px 0px !important;
        }

        .nav-item .nav-depart .depart-btn .span-custom {
            margin-left: 0px;
        }

        .avatar {
            width: 20px;
            margin-right: 10px;
        }
        .login-panel-custom{
            padding-right: 20px;
            min-width: 120px;
        }

    </style>
</head>

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        hello.colorlib@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +65 11.188.888
                    </div>
                </div>
                <div class="ht-right">
                    @guest
                        <a href="{{ route('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    @else
                        {{-- <div class="nav-item nav-custom">
                            <div class="container">
                                <div class="nav-depart">
                                    <div class="depart-btn depart-btn-custom">
                                        <i class="ti-menu"></i>
                                        <span class="span-custom">{{ Auth::user()->name }}</span>
                                        <ul class="depart-hover">
                                            <li class="active"><a href="#"
                                                    onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">Logout</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @if (Auth::user()->role_id == 1)
                            <a href="/admin" class="login-panel login-panel-custom"><i class="fa fa-user"></i>Admin Panel</a>
                        @endif
                        <a href="{{ route('logout') }}" class="login-panel login-panel-custom" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="" class="avatar">
                            {{ Auth::user()->name }}
                        </a>
                    @endguest
                    <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                            <option value='yt' data-image="img/flag-1.jpg" data-imagecss="flag yt" data-title="English">
                                English</option>
                            <option value='yu' data-image="img/flag-2.jpg" data-imagecss="flag yu"
                                data-title="Bangladesh">German </option>
                        </select>
                    </div>
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="{{ route('landing-page') }}">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    @if ($cart_count > 0)
                                        <span>{{ $cart_count }}</span>
                                    @endif
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                @foreach ($cart_content as $item)
                                                    <tr>
                                                        <td class="si-pic">
                                                            <a href="{{ route('shop.show', $item->model->slug) }}">
                                                                <img src="{{ asset('storage/' . $item->model->image) }}"
                                                                    class="img-popup-cart" alt="null">
                                                            </a>
                                                        </td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p>
                                                                    {{ $item->vnd_price }} x
                                                                    {{ $item->qty }}
                                                                </p>
                                                                <h6>
                                                                    <a
                                                                        href="{{ route('shop.show', $item->model->slug) }}">
                                                                        {{ $item->model->name }}
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <form action="{{ route('cart.destroy', $item->rowId) }}"
                                                            method="POST">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <td class="si-close">
                                                                <button type="submit">
                                                                    <i class="ti-close"></i>
                                                                </button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>subtotal:</span>
                                        <h5>{{ $cart_subtotal }}</h5>
                                    </div>
                                    <div class="select-total">
                                        <span>discount ({{ $coupon_name }}):</span>
                                        <h5>{{ $coupon_discount }}</h5>
                                    </div>
                                    <div class="select-total">
                                        <span>new subtotal:</span>
                                        <h5>{{ $cart_newSubtotal }}</h5>
                                    </div>
                                    <div class="select-total">
                                        <span>tax ({{ $cart_taxPercent }}):</span>
                                        <h5>{{ $cart_newTax }}</h5>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>{{ $cart_newTotal }}</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="{{ route('cart.index') }}" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="{{ route('checkout.index') }}" class="primary-btn checkout-btn">CHECK
                                            OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">{{ $cart_newTotal }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                            <li><a href="#">Underwear</a></li>
                            <li><a href="#">Kid's Clothing</a></li>
                            <li><a href="#">Brand Fashion</a></li>
                            <li><a href="#">Accessories/Shoes</a></li>
                            <li><a href="#">Luxury Brands</a></li>
                            <li><a href="#">Brand Outdoor Apparel</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{ route('landing-page') }}">Home</a></li>
                        <li><a href="{{ route('shop.index') }}">Shop</a></li>
                        <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                @foreach ($classifies as $classify)
                                    <li><a
                                            href="{{ route('shop.index', ['classify' => $classify->slug]) }}">{{ $classify->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contact</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./blog-details.html">Blog Details</a></li>
                                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a href="{{ route('checkout.index') }}">Checkout</a></li>
                                <li><a href="./faq.html">Faq</a></li>
                                @guest
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @else
                                    <li><a href="#"
                                            onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">Logout</a>
                                    </li>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    @yield('content')

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello.colorlib@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());

                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>

</html>
