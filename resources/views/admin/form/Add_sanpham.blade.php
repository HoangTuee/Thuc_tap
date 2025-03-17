@extends('admin.master')
@section('body')

<div class="content-page">
    <h2 class="content-title">Thêm sản phẩm</h2>

    <form action="{{ route('add_sanpham') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="tensanpham">Tên sản phẩm:</label>
        <input type="text" name="tensanpham" required>

        <label for="giasanpham">Giá sản phẩm:</label>
        <input type="number" name="giasanpham" required>

        <label for="anhsanpham">Ảnh sản phẩm:</label>
        <input type="file" name="anhsanpham" required>

        <label for="giabandau">Giá ban đầu:</label>
        <input type="number" name="giabandau" required>

        <label for="giakhuyenmai">Giá khuyến mãi:</label>
        <input type="number" name="giakhuyenmai" required>

        <label for="thongso_sanpham">Thông số:</label>
        <input type="text" name="thongso_sanpham" required>

        <label for="danhmuc">Danh mục:</label>
        <select name="danhmuc" id="danhmuc" required>
            <option value="">Chọn danh mục</option>
            <option value="HỌC TẬP - VĂN PHÒNG">Học tập - Văn phòng</option>
            <option value="GAMING - ĐỒ HỌA">Gaming - Đồ họa</option>
            <option value="LAPTOP MACBOOK">Laptop MacBook</option>
        </select>

        <label for="hangsanpham">Hãng sản phẩm:</label>
        <input type="text" name="hangsanpham" required>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>

@stop()
