<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website Demo</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timkiem.css') }}">
    <link rel="stylesheet" href="{{ asset('css/giohang.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
</head>

<body>
    <header id="header">
        <div id="top-nav">
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
                </style>

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
        </div>

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

    <footer>
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
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/user.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>
