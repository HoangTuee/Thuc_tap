@extends('master')
@section('main')

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="product-container" style="margin-top: 3%">
            <div class="image-gallery">
                <img src="{{ asset($sanpham->anhsanpham) }}" alt="Ảnh chính" class="main-image" style="width: 350px"
                    height="320px">
                <div class="thumbnail-gallery">
                    <img src="{{ asset($chitiet->anhchitiet1) }}" alt="Ảnh nhỏ 1" onclick="changeMainImage(this)"
                        style="box-shadow: 3px 2px 5px 2px rgb(97, 85, 85);" width="100px" height="100px">
                    <img src="{{ asset($chitiet->anhchitiet2) }}" alt="Ảnh nhỏ 2" onclick="changeMainImage(this)"
                        style="box-shadow: 3px 2px 5px 2px rgb(97, 85, 85);" width="100px" height="100px">
                    <img src="{{ asset($chitiet->anhchitiet3) }}" alt="Ảnh nhỏ 3" onclick="changeMainImage(this)"
                        style="box-shadow: 3px 2px 5px 2px rgb(97, 85, 85);" width="100px" height="100px">
                    <img src="{{ asset($chitiet->anhchitiet4) }}" alt="Ảnh nhỏ 4" onclick="changeMainImage(this)"
                        style="box-shadow: 3px 2px 5px 2px rgb(97, 85, 85);" width="100px" height="100px">
                </div>
            </div>

            <div class="product-details">
                <h1 class="product-title">{{ $sanpham->tensanpham }}</h1>
                <p class="product-price">
                    {{ number_format($sanpham->giasanpham - ($sanpham->giasanpham * $sanpham->giakhuyenmai) / 100, 0, ',', '.') }}₫
                    <span class="old-price">{{ number_format($sanpham->giasanpham, 0, ',', '.') }}₫</span></p>
                <p class="product-status">Tình trạng: <span class="status">{{ $chitiet->tinhtrang_sanpham }}</span></p>

                <h3>Cấu hình:</h3>
                <p>{{ $chitiet->cauhinh_sanpham }}</p>

                <div class="promotion">
                    <h3>Quà tặng/Khuyến mãi</h3>
                    <ul style="list-style: none">
                        <li>✅ Windows bản quyền theo máy</li>
                        <li>✅ Miễn phí cấn màu màn hình công nghệ cao</li>
                        <li>✅ Balo thời trang</li>
                        <li>✅ Chuột không dây + Bàn di cao cấp</li>
                        <li>✅ Gói cài đặt, bảo dưỡng trọn đời</li>
                    </ul>
                </div>

                <button class="buy-now"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
            </div>
        </div>
    </form>

@stop()
