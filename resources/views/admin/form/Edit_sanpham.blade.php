@extends('admin.master')
@section('body')

<div class="content-page">
    <h2 class="content-title">Sửa sản phẩm</h2>

    <form action="{{ route('edit_sanpham', $sanpham->id_sanpham) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="tensanpham">Tên sản phẩm:</label>
        <input type="text" name="tensanpham" value="{{ $sanpham->tensanpham }}" required>

        <label for="giasanpham">Giá sản phẩm:</label>
        <input type="number" name="giasanpham" value="{{ $sanpham->giasanpham }}" required>

        <label for="anhsanpham">Ảnh sản phẩm:</label>
        <input type="file" name="anhsanpham">

        <label for="giabandau">Giá ban đầu:</label>
        <input type="number" name="giabandau" value="{{ $sanpham->giabandau }}" required>

        <label for="giakhuyenmai">Giá khuyến mãi:</label>
        <input type="number" name="giakhuyenmai" value="{{ $sanpham->giakhuyenmai }}" required>

        <label for="thongso_sanpham">Thông số:</label>
        <input type="text" name="thongso_sanpham" value="{{ $sanpham->thongso_sanpham }}" required>

        <label for="danhmuc">Danh mục:</label>
        <select name="danhmuc" id="danhmuc" required>
            <option value="HỌC TẬP - VĂN PHÒNG" {{ $sanpham->danhmuc == 'HỌC TẬP - VĂN PHÒNG' ? 'selected' : '' }}>Học tập - Văn phòng</option>
            <option value="GAMING - ĐỒ HỌA" {{ $sanpham->danhmuc == 'GAMING - ĐỒ HỌA' ? 'selected' : '' }}>Gaming - Đồ họa</option>
            <option value="LAPTOP MACBOOK" {{ $sanpham->danhmuc == 'LAPTOP MACBOOK' ? 'selected' : '' }}>Laptop MacBook</option>
        </select>

        <label for="hangsanpham">Hãng sản phẩm:</label>
        <input type="text" name="hangsanpham" value="{{ $sanpham->hangsanpham }}" required>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>

@stop()
