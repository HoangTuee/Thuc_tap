@extends('master')
@section('main')

    <style>
        .giohang {
            text-decoration: none;
            color: rgb(0, 0, 0);
            border: 1px solid black;
            background-color: rgb(241, 233, 233);
            padding: 2px 5px;
        }
    </style>
    @if ($sanpham->danhmuc === 'Gaming - Đồ Họa' || $sanpham->danhmuc === 'Văn Phòng - Học Tập')
        <form action="{{ route('addgiohang') }}" method="POST" enctype="multipart/form-data">
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
                    <h1 class="product-title">
                        <h1 class="product-title">{!! nl2br(e(wordwrap($sanpham->tensanpham, 30, "\n", true))) !!}</h1>
                    </h1>
                    @if ($sanpham->giakhuyenmai)
                        <p class="product-price" style="color: red; font-size:150%; font-weight: bold;">
                            {{ number_format($sanpham->giasanpham - ($sanpham->giasanpham * $sanpham->giakhuyenmai) / 100, 0, ',', '.') }}₫
                            <span class="old-price">{{ number_format($sanpham->giasanpham, 0, ',', '.') }}₫</span>
                        </p>
                    @else
                        <p class="product-price" style="color: red; font-size:150%; font-weight: bold;">
                            {{ number_format($sanpham->giasanpham, 0, ',', '.') }}₫
                        </p>
                    @endif
                    <p class="product-status">Tình trạng: <span class="status">{{ $chitiet->tinhtrang_sanpham }}</span></p>

                    <h3>Cấu hình:</h3>
                    <p>{!! nl2br(e(wordwrap($chitiet->cauhinh_sanpham, 80, "\n", true))) !!}</p>

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

                    <input type="hidden" name="tensanpham" value="{{ $sanpham->tensanpham }}">
                    <input type="hidden" name="giasanpham" value="{{ $sanpham->giasanpham }}">
                    <input type="hidden" name="anhsanpham" value="{{ $sanpham->anhsanpham }}">

                    @if (auth()->check())
                        @if ($chitiet->tinhtrang_sanpham == 'Còn hàng')
                            <button class="buy-now"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
                        @else
                            <a href="{{ route('giohang') }}" onclick="alert('Sản phẩm đã hết hàng')" class="giohang">
                                <i class="fa-solid fa-cart-shopping"></i> Hết hàng
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" onclick="alert('Đăng nhập để thêm vào giỏ hàng')" class="giohang">
                            <i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng
                        </a>
                    @endif
                </div>
            </div>
        </form>
    @else
        <form action="{{ route('addgiohang') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="product-container" style="margin-top: 3%">
                <div class="image-gallery">
                    <img src="{{ asset($sanpham->anhsanpham) }}" alt="Ảnh chính" class="main-image" style="width: 350px"
                        height="320px">
                </div>

                <div class="product-details">
                    <h1 class="product-title">{!! nl2br(e(wordwrap($sanpham->tensanpham, 30, "\n", true))) !!}</h1>
                    @if ($sanpham->giakhuyenmai)
                        <p class="product-price" style="color: red; font-size:150%; font-weight: bold;">
                            {{ number_format($sanpham->giasanpham - ($sanpham->giasanpham * $sanpham->giakhuyenmai) / 100, 0, ',', '.') }}₫
                            <span class="old-price">{{ number_format($sanpham->giasanpham, 0, ',', '.') }}₫</span>
                        </p>
                    @else
                        <p class="product-price" style="color: red; font-size:150%; font-weight: bold;">
                            {{ number_format($sanpham->giasanpham, 0, ',', '.') }}₫
                        </p>
                    @endif
                    <p class="product-status">Tình trạng: <span class="status">{{ $chitiet->tinhtrang_sanpham }}</span>
                    </p>
                    @if ($chitiet->cauhinh_sanpham)
                        <h3>Model:</h3>
                        <p>{{ $chitiet->cauhinh_sanpham }}</p>
                    @endif

                    <div class="promotion">
                        <h3>Quà tặng/Khuyến mãi</h3>
                        <ul style="list-style: none">
                            <li>✅ Cài windows, phần mềm miễn phí theo yêu cầu. </li>
                            <li>✅ Hỗ trợ lắp đặt miễn phí.</li>
                        </ul>
                    </div>

                    <input type="hidden" name="tensanpham" value="{{ $sanpham->tensanpham }}">
                    <input type="hidden" name="giasanpham" value="{{ $sanpham->giasanpham }}">
                    <input type="hidden" name="anhsanpham" value="{{ $sanpham->anhsanpham }}">

                    @if (auth()->check())
                        <button class="buy-now"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button>
                    @else
                        <a href="{{ route('login') }}" onclick="alert('Đăng nhập để thêm vào giỏ hàng')"
                            class="giohang">
                            <i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng
                        </a>
                    @endif
                </div>
            </div>
        </form>
    @endif

@stop()
