@extends('master')

@section('main')
    <main id="content">
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

        <section class="adress">
            <div id="dia-chi">
                <div class="diachi">
                    <p class="text-diachi">Cơ sở 1</p>
                    <p class="text-">Tân hòa - Quốc Oai - Hà Nội</p>
                </div>
                <div class="diachi">
                    <p class="text-diachi">Cơ sở 1</p>
                    <p class="text-">Tân hòa - Quốc Oai - Hà Nội</p>
                </div>
            </div>
        </section>

        <section class="sanpham-phanloai">
            <div class="category-bar">
                <div class="category-title">
                    <span>HỌC TẬP - VĂN PHÒNG</span>
                </div>
                <div class="price-range">
                    <span class="label">Mức giá:</span>
                    <a href="#">5 TRIỆU - 10 TRIỆU</a>
                    <a href="#">10 TRIỆU - 20 TRIỆU</a>
                    <a href="#">20 TRIỆU - 30 TRIỆU</a>
                    <a href="#">30 TRIỆU - 40 TRIỆU</a>
                    <a href="#">TRÊN 40 TRIỆU</a>
                </div>
            </div>
            <div class="product-container">
                @foreach ($hocTapVanPhong as $sanpham)
                    <div class="product">
                        @if ($sanpham->giakhuyenmai)
                            <div class="discount">-{{ $sanpham->giakhuyenmai }}%</div>
                        @endif
                        <a href="{{ route('chitiet', ['tensanpham' => $sanpham->tensanpham]) }}"><img
                                src="{{ asset($sanpham->anhsanpham) }}" alt="{{ asset($sanpham->tensanpham) }}" /></a>
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
                <div class="pagination">
                    {{ $hocTapVanPhong->links() }}
                </div>
            </div>
        </section>

        <section class="sanpham-phanloai">
            <div class="category-bar">
                <div class="category-title">
                    <span>GAMING - ĐỒ HỌA</span>
                </div>
                <div class="price-range">
                    <span class="label">Mức giá:</span>
                    <a href="#">5 TRIỆU - 10 TRIỆU</a>
                    <a href="#">10 TRIỆU - 20 TRIỆU</a>
                    <a href="#">20 TRIỆU - 30 TRIỆU</a>
                    <a href="#">30 TRIỆU - 40 TRIỆU</a>
                    <a href="#">TRÊN 40 TRIỆU</a>
                </div>
            </div>

            <div class="product-container">
                @foreach ($gamingDoHoa as $sanpham)
                    <div class="product">
                        @if ($sanpham->giakhuyenmai)
                            <div class="discount">-{{ $sanpham->giakhuyenmai }}%</div>
                        @endif
                        <a href="{{ route('chitiet', ['tensanpham' => $sanpham->tensanpham]) }}"><img
                                src="{{ asset($sanpham->anhsanpham) }}" alt="{{ asset($sanpham->tensanpham) }}" /></a>
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
                <div class="pagination">
                    {{ $gamingDoHoa->links() }}
                </div>
            </div>
        </section>

        <section class="sanpham-phanloai">
            <div class="category-bar">
                <div class="category-title">
                    <span>Linh Kiện - Phụ Kiện</span>
                </div>
                <div class="price-range">
                    <span class="label">Mức giá:</span>
                    <a href="#">5 TRIỆU - 10 TRIỆU</a>
                    <a href="#">10 TRIỆU - 20 TRIỆU</a>
                    <a href="#">20 TRIỆU - 30 TRIỆU</a>
                    <a href="#">30 TRIỆU - 40 TRIỆU</a>
                    <a href="#">TRÊN 40 TRIỆU</a>
                </div>
            </div>

            <div class="product-container">
                @foreach ($linhKien as $sanpham)
                    <div class="product">
                        @if ($sanpham->giakhuyenmai)
                            <div class="discount">-{{ $sanpham->giakhuyenmai }}%</div>
                        @endif
                        <a href="{{ route('chitiet', ['tensanpham' => $sanpham->tensanpham]) }}"><img
                                src="{{ asset($sanpham->anhsanpham) }}" alt="{{ asset($sanpham->tensanpham) }}" /></a>
                        <p class="title">
                            {{ $sanpham->tensanpham }}
                            @if ($sanpham->thongso_sanpham)
                                ({{ $sanpham->thongso_sanpham }})
                            @endif
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
                <div class="pagination">
                    {{ $linhKien->links() }}
                </div>
            </div>
        </section>
    </main>

@stop()
