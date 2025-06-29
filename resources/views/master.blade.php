<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laptop shop</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timkiem.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/68384d0488673062ad41a9ad/1isdupmo5';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->

<body>
    <style>
        body {
            padding: 0px;
        }
    </style>
    <header id="header">
        {{-- <div id="top-nav">
            <div class="logo">
                <a href="{{ route('index') }}"><img src="{{ asset('storage/defauls/logo.png') }}"
                        alt=""id="logo-header" /></a>
                <div class="search">
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" placeholder="Bạn muốn tìm sản phẩm gì ?"
                            name="search-header"id="search-header" />
                        <button type="submit" id="search-buttom">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <div class="hotline">
                    <p class="text-header"><i class="fa-solid fa-phone"></i> Hotline</p>
                    <p class="text-header2">0359 640 373</p>
                </div>
                <style>
                    .shop-container {
                        position: relative;
                        display: inline-block;
                    }

                    .cart-count {
                        position: absolute;
                        top: -8px;
                        right: -10px;
                        background: red;
                        color: white;
                        border-radius: 50%;
                        padding: 2px 6px;
                        font-size: 12px;
                        font-weight: bold;
                    }
                </styl>

                @php
                    use App\Models\giohang;
                    $od = 0;
                    if (auth()->check()) {
                        $od = giohang::where('id_user', 'LIKE', auth()->user()->id_user)->count();
                    }
                @endphp

                <div class="shop-container">
                    <a href="{{ route('giohang') }}" class="shop">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    @if ($od > 0)
                        <span class="cart-count">{{ $od }}</span>
                    @endif
                </div>

            </div>
        </div> --}}
        <div id="top-nav" class="bg-white shadow-sm border-bottom">
            <div class="container-fluid px-3 px-lg-4">
                <div class="row align-items-center py-2 py-lg-3">
                    <!-- Logo -->
                    <div class="col-6 col-md-3 col-lg-2">
                        <a href="{{ route('index') }}" class="d-block">
                            <img src="{{ asset('storage/defauls/Laptopshop_logo.png') }}" alt="Logo"
                                id="logo-header" class="img-fluid" style="max-height: 50px;" />
                        </a>
                    </div>

                    <!-- Search Bar -->
                    <div class="col-12 col-md-6 col-lg-6 order-3 order-md-2 mt-2 mt-md-0">
                        <form action="{{ route('search') }}" method="get" class="position-relative">
                            <div class="input-group">
                                <input type="text" class="form-control border-end-0"
                                    placeholder="Bạn muốn tìm sản phẩm gì?" name="search-header" id="search-header"
                                    style="border-right: none;">
                                <button class="btn btn-outline-secondary border-start-0" type="submit"
                                    id="search-button" style="border-left: none;">
                                    <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Hotline & Cart -->
                    <div
                        class="col-6 col-md-3 col-lg-4 order-2 order-md-3 d-flex justify-content-end align-items-center">
                        <!-- Hotline -->
                        <div class="hotline text-end me-3 d-none d-lg-block">
                            <p class="mb-0 text-muted small">
                                <i class="fa-solid fa-phone text-primary me-1"></i>
                                Hotline
                            </p>
                            <p class="mb-0 fw-bold text-dark">0359 640 373</p>
                        </div>

                        <!-- Cart -->
                        @php
                            use App\Models\giohang;
                            $od = 0;
                            if (auth()->check()) {
                                $od = giohang::where('id_user', 'LIKE', auth()->user()->id_user)->count();
                            }
                        @endphp

                        <div class="shop-container position-relative">
                            <a href="{{ route('giohang') }}"
                                class="btn btn-outline-primary rounded-circle p-2 position-relative"
                                style="width: 45px; height: 45px;">
                                <i class="fa-solid fa-cart-shopping"></i>
                                @if ($od > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $od > 99 ? '99+' : $od }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Custom styles để tăng cường Bootstrap */
            #main-nav {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            #top-nav {
                min-height: 70px;
            }

            #search-header {
                border-radius: 25px 0 0 25px !important;
            }

            #search-button {
                border-radius: 0 25px 25px 0 !important;
                background-color: #f8f9fa;
            }

            #search-button:hover {
                background-color: #e9ecef;
            }

            .shop-container .btn:hover {
                transform: scale(1.05);
                transition: transform 0.2s ease;
            }

            .hotline p {
                line-height: 1.2;
            }

            .logout-btn {
                background: none;
                border: none;
                padding: 0;
                font: inherit;
                color: #ffffff;
                /* hoặc màu bạn dùng cho thẻ <a> */
                cursor: pointer;
                text-decoration: none;
            }

            .logout-btn:hover {
                text-decoration: underline;
            }

            /* Mobile responsive */
            @media (max-width: 767.98px) {
                #top-nav {
                    min-height: auto;
                }

                .hotline {
                    display: none !important;
                }

                #logo-header {
                    max-height: 40px !important;
                }

                .shop-container .btn {
                    width: 40px !important;
                    height: 40px !important;
                    padding: 8px !important;
                }
            }

            @media (max-width: 575.98px) {
                .container-fluid {
                    padding-left: 15px !important;
                    padding-right: 15px !important;
                }
            }
        </style>

        <div id="main-nav" class="menu-header">

            <div class="nav_menu">
                <ul class="nav_list">
                    <li class="nav_link">
                        <a href="{{ route('index') }}" class="nav-link"><i class="fa-solid fa-laptop"></i>Home</a>
                    </li>
                    <li class="nav_link">
                        <a href="{{ route('sanphams') }}" class="nav-link"><i class="fa-solid fa-laptop"></i>Options</a>
                    </li>
                    <li class="nav_link">
                        <a href="{{ route('khuyenmai') }}" class="nav-link"><i class="fa-solid fa-gift"></i>Sale</a>
                    </li>
                    <li class="nav_link">
                        <a href="{{ route('tintuc') }}" class="nav-link"><i
                                class="fa-solid fa-file-invoice-dollar"></i>News</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav_link">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link logout-btn">
                                    <i class="fa-solid fa-right-to-bracket"></i>Xin chào
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav_link">
                            <a href="{{ route('login') }}" class="nav-link"><i
                                    class="fa-solid fa-right-to-bracket"></i>Login</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="menu_mobile">
                <div class="menu_mobile1">
                    <label for="nav-id-input" class="nav_bars">
                        <i class="fa-solid fa-bars"></i>
                    </label>
                </div>
                <div class="menu_mobile1">
                    <ul class="ul_mobile">
                        <li class="li_mobile"><a href="{{ route('giohang') }}"><i
                                    class="fa-solid fa-basket-shopping"></i>Giỏ hàng</a>
                        </li>
                        <li class="li_mobile"><a href=""><i class="fa-solid fa-phone"></i>Liên hệ</a></li>
                    </ul>
                </div>
            </div>

            <input type="checkbox" name="" hidden class="nav_input" id="nav-id-input">
            <label for="nav-id-input" class="nav_overlay"></label>

            <div class="nav_mobile">

                <label for="nav-id-input" class="nav_close">
                    <i class="fa-solid fa-xmark"></i>
                </label>

                <ul class="nav_mobile_list">
                    <li>
                        <a href="#home" class="nav-mobile_link"><i class="fa-solid fa-laptop"></i>Laptop mới</a>
                    </li>
                    <li>
                        <a href="#about" class="nav-mobile_link"><i class="fa-solid fa-laptop"></i>Laptop cũ</a>
                    </li>
                    <li>
                        <a href="#services" class="nav-mobile_link"><i class="fa-solid fa-gift"></i>Khuyến mãi</a>
                    </li>
                    <li>
                        <a href="#contact" class="nav-mobile_link"><i class="fa-solid fa-file-invoice-dollar"></i>Tin
                            tức</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    @yield('main')

    {{-- <footer>
        <div class="footer-container">
            <div class="footer-left">
                <h3>Laptopshop.com</h3>
                <p>📍 An Ninh, Tân Hòa, Quốc Oai, Hà Nội</p>
                <p>📞 Hotline: 0359640373</p>
                <p>
                    📧 Email:
                    <a href="mailto:htue1502@gmail.comcom">htue1502@gmail.com</a>
                </p>
                <p>🌍 Website: <a href="#" target="_blank">thuctapdemo.comcom</a></p>
                <div class="footer-map">
                    <h3>Địa chỉ cửa hàng</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d490.84340709302836!2d105.68628508207483!3d20.97414066657416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1svi!2s!4v1739354030370!5m2!1svi!2s"
                        width="100%" height="250" style="border: 0" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
            <div class="footer-center">
                <h3>Mạng xã hội</h3>
                <a href="#" class="social-btn facebook"><i class="fa-brands fa-facebook"></i>
                    <p>Facebook</p>
                </a>
                <a href="#" class="social-btn youtube"><i class="fa-brands fa-youtube"></i>
                    <p>Youtube</p>
                </a>
                <a href="#" class="social-btn instagram"><i class="fa-brands fa-instagram"></i>
                    <p>Instagram</p>
                </a>
            </div>
            <div class="footer-right">
                <h3>Tư vấn ngay tại đây</h3>
                <form action="order.php" method="post">
                    <input type="text" name="name" placeholder="Họ tên" required />
                    <input type="text" name="address" placeholder="Địa chỉ" required />
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="tel" name="phone" placeholder="Điện thoại" required />
                    <textarea name="message" placeholder="Nội dung" required></textarea>
                    <button type="submit">Tư Vấn</button>
                </form>
            </div>
        </div>
    </footer> --}}
    <footer class="laptop-footer">
        <div class="container-fluid px-0">
            <div class="laptop-footer-main">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="laptop-footer-section brand-section text-center">
                                <h2 class="laptop-brand-logo">
                                    <i class="fas fa-laptop"></i> LaptopPro
                                </h2>
                                <p class="laptop-brand-description">
                                    Chuyên cung cấp laptop chính hãng, giá tốt nhất thị trường.
                                    Cam kết chất lượng, bảo hành uy tín và dịch vụ khách hàng tận tâm.
                                </p>
                                <div class="laptop-social-links">
                                    <a href="#" class="laptop-social-link">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="laptop-social-link">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="laptop-social-link">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="#" class="laptop-social-link">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="laptop-footer-section">
                                <h3 class="laptop-footer-title">
                                    <i class="fas fa-laptop-code me-2"></i>Sản Phẩm
                                </h3>
                                <ul class="laptop-footer-list">
                                    <li><a href="#"><i class="fas fa-gamepad me-2"></i>Laptop Gaming</a></li>
                                    <li><a href="#"><i class="fas fa-briefcase me-2"></i>Laptop Văn Phòng</a>
                                    </li>
                                    <li><a href="#"><i class="fas fa-palette me-2"></i>Laptop Đồ Họa</a></li>
                                    <li><a href="#"><i class="fas fa-graduation-cap me-2"></i>Laptop Sinh
                                            Viên</a></li>
                                    <li><a href="#"><i class="fab fa-apple me-2"></i>MacBook</a></li>
                                    <li><a href="#"><i class="fas fa-mouse me-2"></i>Phụ Kiện Laptop</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="laptop-footer-section">
                                <h3 class="laptop-footer-title">
                                    <i class="fas fa-headset me-2"></i>Hỗ Trợ Khách Hàng
                                </h3>
                                <ul class="laptop-footer-list">
                                    <li><a href="#"><i class="fas fa-shield-alt me-2"></i>Chính Sách Bảo
                                            Hành</a></li>
                                    <li><a href="#"><i class="fas fa-shopping-cart me-2"></i>Hướng Dẫn Mua
                                            Hàng</a></li>
                                    <li><a href="#"><i class="fas fa-exchange-alt me-2"></i>Chính Sách Đổi
                                            Trả</a></li>
                                    <li><a href="#"><i class="fas fa-credit-card me-2"></i>Thanh Toán & Vận
                                            Chuyển</a></li>
                                    <li><a href="#"><i class="fas fa-question-circle me-2"></i>Câu Hỏi Thường
                                            Gặp</a></li>
                                    <li><a href="#"><i class="fas fa-lock me-2"></i>Bảo Mật Thông Tin</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="laptop-footer-section">
                                <h3 class="laptop-footer-title">
                                    <i class="fas fa-phone me-2"></i>Liên Hệ
                                </h3>
                                <div class="laptop-contact-info">
                                    <div class="laptop-contact-item">
                                        <i class="fas fa-map-marker-alt laptop-contact-icon"></i>
                                        <span>Tân Hòa, Quốc Oai, Hà Nội</span>
                                    </div>
                                    <div class="laptop-contact-item">
                                        <i class="fas fa-phone laptop-contact-icon"></i>
                                        <span>0359 640 373</span>
                                    </div>
                                    <div class="laptop-contact-item">
                                        <i class="fas fa-envelope laptop-contact-icon"></i>
                                        <span>htue1502@gmail.com</span>
                                    </div>
                                    <div class="laptop-contact-item">
                                        <i class="fas fa-clock laptop-contact-icon"></i>
                                        <span>8:00 - 22:00 (Hàng ngày)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="laptop-footer-bottom">
                <div class="container">
                    <div class="text-center">
                        <p class="mb-2">&copy; 2025 LaptopPro. Tất cả quyền được bảo lưu.</p>
                        <p class="mb-3">Giấy phép kinh doanh số: 0123456789 - Đăng ký lần đầu: 01/01/2020</p>

                        <div class="laptop-payment-methods">
                            <span class="laptop-payment-method">
                                <i class="fab fa-cc-visa"></i> VISA
                            </span>
                            <span class="laptop-payment-method">
                                <i class="fab fa-cc-mastercard"></i> MasterCard
                            </span>
                            <span class="laptop-payment-method">
                                <i class="fas fa-mobile-alt"></i> VNPay
                            </span>
                            <span class="laptop-payment-method">
                                <i class="fas fa-wallet"></i> MoMo
                            </span>
                            <span class="laptop-payment-method">
                                <i class="fas fa-credit-card"></i> ZaloPay
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .laptop-footer {
            margin-top: 50px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #ffffff;
            padding: 60px 0 0;
            position: relative;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .laptop-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #00d4ff, transparent);
            animation: laptop-shimmer 3s infinite;
        }

        @keyframes laptop-shimmer {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 1;
            }
        }

        .laptop-footer-main {
            padding-bottom: 40px;
        }

        .laptop-footer-section h3.laptop-footer-title {
            color: #00d4ff !important;
            margin-bottom: 20px !important;
            font-size: 1.3em !important;
            font-weight: 600 !important;
            position: relative;
            padding-bottom: 10px;
        }

        .laptop-footer-section h3.laptop-footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, #00d4ff, #ff6b6b);
            border-radius: 2px;
        }

        .laptop-footer-list {
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .laptop-footer-list li {
            margin-bottom: 12px !important;
            transition: all 0.3s ease;
        }

        .laptop-footer-list li a {
            color: #b8c6db !important;
            text-decoration: none !important;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            padding: 5px 0;
        }

        .laptop-footer-list li a:hover {
            color: #00d4ff !important;
            transform: translateX(5px);
        }

        .laptop-footer-list li a i {
            font-size: 0.9em;
            width: 20px;
        }

        .brand-section {
            text-align: center;
        }

        .laptop-brand-logo {
            font-size: 2.5em !important;
            font-weight: bold !important;
            background: linear-gradient(45deg, #00d4ff, #ff6b6b, #4ecdc4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 15px 0 !important;
            animation: laptop-logoGlow 2s ease-in-out infinite alternate;
        }

        @keyframes laptop-logoGlow {
            from {
                filter: brightness(1);
            }

            to {
                filter: brightness(1.2);
            }
        }

        .laptop-brand-description {
            color: #b8c6db !important;
            line-height: 1.6;
            margin-bottom: 25px !important;
        }

        .laptop-social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .laptop-social-link {
            width: 45px;
            height: 45px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none !important;
            color: white !important;
            font-weight: bold;
        }

        .laptop-social-link:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 212, 255, 0.3);
            color: white !important;
        }

        .laptop-contact-info {
            background: rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .laptop-contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px !important;
            color: #b8c6db !important;
        }

        .laptop-contact-item:last-child {
            margin-bottom: 0 !important;
        }

        .laptop-contact-icon {
            width: 20px;
            margin-right: 12px !important;
            color: #00d4ff !important;
            font-weight: bold;
        }

        .laptop-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 0;
            text-align: center;
            background: rgba(0, 0, 0, 0.3);
        }

        .laptop-footer-bottom p {
            color: #b8c6db !important;
            margin: 0 0 10px 0 !important;
        }

        .laptop-payment-methods {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .laptop-payment-method {
            background: white !important;
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: bold;
            color: #333 !important;
            font-size: 0.9em;
            transition: transform 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .laptop-payment-method:hover {
            transform: scale(1.05);
        }

        .laptop-payment-method i {
            font-size: 1.1em;
        }

        /* Override Bootstrap khi cần thiết */
        .laptop-footer .container-fluid {
            padding: 0 !important;
        }

        .laptop-footer .row {
            margin: 0 !important;
        }

        .laptop-footer [class*="col-"] {
            padding: 15px;
        }

        /* TABLET & DESKTOP NHỎ (768px - 1024px) */
        @media (min-width: 768px) and (max-width: 1024px) {
            .laptop-footer {
                padding: 50px 0 0;
            }

            .laptop-footer [class*="col-"] {
                padding: 15px 12px;
            }

            .laptop-brand-logo {
                font-size: 2.2em !important;
            }

            .laptop-brand-description {
                font-size: 0.95em;
                margin-bottom: 22px !important;
            }

            .laptop-social-links {
                gap: 12px;
            }

            .laptop-social-link {
                width: 42px;
                height: 42px;
            }

            .laptop-footer-section h3.laptop-footer-title {
                font-size: 1.25em !important;
                margin-bottom: 18px !important;
            }

            .laptop-footer-list li a {
                font-size: 0.95em;
                padding: 6px 0;
            }

            .laptop-contact-info {
                padding: 22px;
            }

            .laptop-contact-item {
                margin-bottom: 14px !important;
                font-size: 0.95em;
            }

            .laptop-footer-bottom {
                padding: 22px 0;
            }

            .laptop-payment-methods {
                gap: 12px;
                margin-top: 15px;
            }

            .laptop-payment-method {
                padding: 7px 13px;
                font-size: 0.9em;
            }
        }

        /* MOBILE (≤767px) */
        @media (max-width: 767px) {
            .laptop-footer {
                padding: 40px 0 0;
            }

            .laptop-footer [class*="col-"] {
                padding: 12px 15px;
                margin-bottom: 25px;
            }

            .laptop-brand-logo {
                font-size: 2em !important;
                margin-bottom: 15px !important;
            }

            .laptop-brand-description {
                font-size: 0.9em;
                margin-bottom: 20px !important;
                padding: 0 10px;
            }

            .laptop-social-links {
                justify-content: center;
                gap: 12px;
                margin-top: 18px;
            }

            .laptop-social-link {
                width: 40px;
                height: 40px;
                font-size: 0.9em;
            }

            .laptop-footer-section h3.laptop-footer-title {
                font-size: 1.2em !important;
                margin-bottom: 16px !important;
                text-align: center;
            }

            .laptop-footer-list {
                text-align: center;
            }

            .laptop-footer-list li {
                margin-bottom: 10px !important;
            }

            .laptop-footer-list li a {
                justify-content: center;
                font-size: 0.9em;
                padding: 8px 0;
            }

            .laptop-contact-info {
                padding: 20px;
                margin: 0 10px;
            }

            .laptop-contact-item {
                margin-bottom: 15px !important;
                font-size: 0.9em;
                justify-content: center;
                text-align: center;
            }

            .laptop-contact-icon {
                margin-right: 10px !important;
            }

            .laptop-footer-bottom {
                padding: 20px 0;
            }

            .laptop-footer-bottom p {
                font-size: 0.85em;
                margin-bottom: 10px !important;
            }

            .laptop-payment-methods {
                justify-content: center;
                gap: 10px;
                margin-top: 15px;
                flex-wrap: wrap;
            }

            .laptop-payment-method {
                padding: 6px 12px;
                font-size: 0.85em;
            }

            /* Mobile portrait nhỏ (≤480px) */
            @media (max-width: 480px) {
                .laptop-footer {
                    padding: 35px 0 0;
                }

                .laptop-footer [class*="col-"] {
                    padding: 10px 12px;
                    margin-bottom: 20px;
                }

                .laptop-brand-logo {
                    font-size: 1.8em !important;
                    margin-bottom: 12px !important;
                }

                .laptop-brand-description {
                    font-size: 0.85em;
                    padding: 0 5px;
                }

                .laptop-social-link {
                    width: 36px;
                    height: 36px;
                    font-size: 0.85em;
                }

                .laptop-footer-section h3.laptop-footer-title {
                    font-size: 1.1em !important;
                    margin-bottom: 14px !important;
                }

                .laptop-footer-list li a {
                    font-size: 0.85em;
                    padding: 6px 0;
                }

                .laptop-contact-info {
                    padding: 18px;
                    margin: 0 8px;
                }

                .laptop-contact-item {
                    margin-bottom: 12px !important;
                    font-size: 0.85em;
                }

                .laptop-footer-bottom p {
                    font-size: 0.8em;
                }

                .laptop-payment-method {
                    padding: 5px 10px;
                    font-size: 0.8em;
                }
            }

            /* Mobile cực nhỏ (≤360px) */
            @media (max-width: 360px) {
                .laptop-footer {
                    padding: 30px 0 0;
                }

                .laptop-brand-logo {
                    font-size: 1.6em !important;
                }

                .laptop-brand-description {
                    font-size: 0.8em;
                }

                .laptop-social-link {
                    width: 34px;
                    height: 34px;
                    font-size: 0.8em;
                }

                .laptop-contact-info {
                    padding: 15px;
                    margin: 0 5px;
                }

                .laptop-payment-method {
                    padding: 4px 8px;
                    font-size: 0.75em;
                }
            }
        }
    </style>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="{{ asset('js/giohang.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
