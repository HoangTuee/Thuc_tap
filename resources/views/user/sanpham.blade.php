@extends('master')
@section('main')
    <section class="img-main">
        <div id="img-main" class="">
            <div class="img-1">
                <div class="banner-slider">
                    <div class="slides">
                        @foreach ($banners as $key => $banner)
                            <a href="{{ route('chitiet', ['tensanpham' => $banner->tensanpham]) }}">
                                <div class="slide {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($banner->anh_banner) }}" alt="Slide {{ $key + 1 }}" />
                                    <div class="content"></div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Chấm tròn điều hướng -->
                    <div class="dots">
                        @foreach ($banners as $key => $banner)
                            <span class="dot {{ $key == 0 ? 'active' : '' }}"
                                onclick="goToSlide({{ $key }})"></span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="img-2">
                <div class="img-right">
                    <a href=""><img src="{{ asset('storage/defauls/hướng dẫn mua hàng.jpg') }}"
                            alt=""id="img-right" /></a>
                </div>
                <div class="img-right">
                    <a href=""><img src="{{ asset('storage/defauls/feedback.jpg') }}" alt=""
                            id="img-right" /></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bộ lọc với Dropdown -->
    <div class="filter-container">
        <div class="dropdown">
            <button class="dropbtn">Thương hiệu <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">Dell</a>
                <a href="#">Asus</a>
                <a href="#">HP</a>
                <a href="#">Lenovo</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Giá <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">Dưới 10 triệu</a>
                <a href="#">10 - 20 triệu</a>
                <a href="#">20 - 30 triệu</a>
                <a href="#">Trên 30 triệu</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">CPU <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">Intel i3</a>
                <a href="#">Intel i5</a>
                <a href="#">Intel i7</a>
                <a href="#">AMD Ryzen 5</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Card VGA <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">GTX 1650</a>
                <a href="#">RTX 3050</a>
                <a href="#">RTX 3060</a>
                <a href="#">RTX 4070</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">RAM <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">8GB</a>
                <a href="#">16GB</a>
                <a href="#">32GB</a>
                <a href="#">64GB</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Ổ cứng <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">SSD 256GB</a>
                <a href="#">SSD 512GB</a>
                <a href="#">SSD 1TB</a>
                <a href="#">HDD 1TB</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="dropbtn">Màn hình <i class="fa-solid fa-caret-down"></i></button>
            <div class="dropdown-content">
                <a href="#">13 inch</a>
                <a href="#">15 inch</a>
                <a href="#">17 inch</a>
                <a href="#">OLED</a>
            </div>
        </div>
    </div>

    <!-- Bộ lọc sắp xếp & chế độ hiển thị -->
    <div class="sort-view-container">
        <div class="sort-container">
            <label for="sort">Sắp xếp theo</label>
            <select id="sort">
                <option value="newest">Mới nhất</option>
                <option value="price_asc">Giá thấp đến cao</option>
                <option value="price_desc">Giá cao đến thấp</option>
            </select>
        </div>

        <div class="view-mode">
            <span>Xem</span>
            <button><i class="fa-solid fa-th"></i></button>
            <button><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
    @if ($sanphams->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            <h1 class="display-6">Không tồn tại</h1>
            <p class="lead">Không tìm thấy sản phẩm bạn đang tìm kiếm. Vui lòng thử lại!</p>
        </div>
    @else
        <div class="product-container" style="margin-top: 3%">
            @foreach ($sanphams as $sanpham)
                <div class="product" style="margin: 2%">
                    @if ($sanpham->giakhuyenmai)
                        <div class="discount">-{{ $sanpham->giakhuyenmai }}%</div>
                    @endif
                    <a href="{{ route('chitiet', ['tensanpham' => $sanpham->tensanpham]) }}">
                        <img src="{{ asset($sanpham->anhsanpham) }}" alt="{{ asset($sanpham->tensanpham) }}" />
                    </a>
                    <p class="title">
                        {{ $sanpham->tensanpham }} ({{ $sanpham->thongso_sanpham }})
                    </p>
                    <p class="title1">
                        {{ $sanpham->tensanpham }}
                    </p>
                    @if ($sanpham->giakhuyenmai)
                        <p class="price">
                            {{ number_format($sanpham->giasanpham - ($sanpham->giasanpham * $sanpham->giakhuyenmai) / 100, 0, ',', '.') }}
                            <span class="old-price">{{ number_format($sanpham->giasanpham, 0, ',', '.') }}</span>
                        </p>
                    @else
                        <p class="price">
                            {{ number_format($sanpham->giasanpham, 0, ',', '.') }}
                        </p>
                    @endif
                </div>
            @endforeach
            <div class="pagination" style="margin-left: 2%">
                {{ $sanphams->appends(['search-header' => request('search-header')])->links() }}
            </div>
        </div>
    @endif
@stop()
