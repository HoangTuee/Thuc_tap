@extends('master')

@section('main')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="full">
        <div class="trai">

            <div class="banner">
                <img src="../img/Laptop-Pictures-4K-Free-Download.jpg" alt="">
            </div>

            <div class="main">
                <main>
                    <section class="news-section">
                        <div class="news-item">
                            <img src="../img/acces.jpg" alt="TOP 3 Laptop Gaming Dưới 20 Triệu">
                            <div class="news-content">
                                <h2>TOP 3 Mẫu Laptop Gaming Dưới 20 Triệu Bán Chạy Nhất Đầu Năm 2025</h2>
                                <p>
                                    Kỳ nghỉ Tết 2025 đã khép lại, giờ là lúc chúng ta trở lại với công việc và học tập.
                                    Đây cũng là thời điểm nhu cầu sở hữu một chiếc laptop mạnh mẽ để hỗ trợ công việc
                                    và học tập gia tăng đáng kể. Đặc biệt, những mẫu ...
                                </p>
                                <span class="date">14-02-2025, 2:38 pm</span>
                            </div>
                        </div>

                        <div class="news-item">
                            <img src="../img/250_3292_lenovo_thinkbook_14_g6__2024_.jpg" alt="Đón Xuân Sang - Săn Quà Vàng">
                            <div class="news-content">
                                <h2>Đón Xuân Sang - Săn Quà Vàng</h2>
                                <p>
                                    Hòa chung không khí Chào Năm Mới - Mừng Tết Ất Tỵ 2025, LaptopAZ triển khai chương trình
                                    "Đón Xuân Sang - Săn Quà Vàng" đặc biệt dành tặng cho tất cả quý khách hàng thay lời cảm ơn
                                    của LaptopAZ ...
                                </p>
                                <span class="date">04-01-2025, 4:09 pm</span>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        <div class="phai">
            <main class="news-container">
                <!-- TIN NỔI BẬT -->
                <section class="featured-news">
                    <h3 class="section-title">TIN NỔI BẬT</h3>
                    <ul class="news-list">
                        <li><span><i class="fa-solid fa-1"></i></span> <a href="#">Những Chiêu trò LỪA ĐẢO ai cũng gặp và Cách Mua Hàng Từ Xa AN TOÀN</a></li>
                        <li><span><i class="fa-solid fa-2"></i></span> <a href="#">HÁI LỘC ĐẦU XUÂN CÙNG AZ - CỨ QUAY LÀ CÓ QUÀ</a></li>
                        <li><span><i class="fa-solid fa-3"></i></span> <a href="#">Dell G15 5530 - Đối thủ cứng cựa của Legion 5 trong tầm giá 28 triệu!!!</a></li>
                        <li><span><i class="fa-solid fa-4"></i></span> <a href="#">ASUS trình làng laptop AI đầu tiên tại Việt Nam: Hiệu suất đỉnh cao với Intel Core Ultra 2025</a></li>
                    </ul>
                </section>

                <!-- TIN KHUYẾN MÃI -->
                <section class="promo-news">
                    <h3 class="section-title">TIN KHUYẾN MÃI</h3>
                    <div class="promo-large">
                        <img src="{{ asset('storsge/images/acces.jpg') }}" alt="HÁI LỘC ĐẦU XUÂN CÙNG AZ">
                        <h4>HÁI LỘC ĐẦU XUÂN CÙNG AZ - CỨ QUAY LÀ CÓ QUÀ</h4>
                    </div>

                    <div class="promo-small">
                        <div class="promo-item">
                            <img src="../img/250_3292_lenovo_thinkbook_14_g6__2024_.jpg" alt="TOP 3 Laptop Gaming Dưới 20 Triệu">
                            <h5>TOP 3 Mẫu Laptop Gaming Dưới 20 Triệu Bán Chạy Nhất Đầu Năm 2025</h5>
                        </div>
                        <div class="promo-item">
                            <img src="../img/250_3197_.jpg" alt="Đón Xuân Sang - Săn Quà Vàng">
                            <h5>Đón Xuân Sang - Săn Quà Vàng</h5>
                        </div>
                    </div>
                    <div class="promo-small">
                        <div class="promo-item">
                            <img src="../img/250_3292_lenovo_thinkbook_14_g6__2024_.jpg" alt="TOP 3 Laptop Gaming Dưới 20 Triệu">
                            <h5>TOP 3 Mẫu Laptop Gaming Dưới 20 Triệu Bán Chạy Nhất Đầu Năm 2025</h5>
                        </div>
                        <div class="promo-item">
                            <img src="../img/250_3197_.jpg" alt="Đón Xuân Sang - Săn Quà Vàng">
                            <h5>Đón Xuân Sang - Săn Quà Vàng</h5>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

</body>
</html>

@stop()
