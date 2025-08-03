@extends('admin.master')

@section('body')
    <div class="container mt-3">
        <a href="{{ route('qlbanner') }}" class="btn btn-primary">
            <i class="fa-solid fa-left-long"></i> Quay lại
        </a>
    </div>
    <div class="content-page">
        <div class="card">
            <div class="card-body">
                <div class="content-header">
                    <h2 class="content-title">Thêm Banner</h2>
                </div>

                {{-- Sửa lại route() cho đúng với route xử lý lưu banner của bạn --}}
                <form action="{{ route('add_banner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tensanpham" class="form-label">Tên sản phẩm:</label>
                        {{-- SỬA LỖI Ở ĐÂY: Thêm thuộc tính list="product-list" --}}
                        <input type="text" class="form-control" id="tensanpham" name="tensanpham" list="product-list" placeholder="Nhập hoặc chọn tên sản phẩm..." required>

                        {{-- Thêm thẻ <datalist> để chứa các gợi ý --}}
                        <datalist id="product-list">
                            @if(isset($allProducts))
                                @foreach($allProducts as $product)
                                    <option value="{{ $product->tensanpham }}">
                                @endforeach
                            @endif
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="anh_banner" class="form-label">Chọn ảnh banner:</label>
                        <input type="file" name="anh_banner" class="form-control" id="anh_banner" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Thêm Banner</button>
                </form>
            </div>
        </div>
    </div>
@stop

