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

        <label for="giakhuyenmai">Giá khuyến mãi:</label>
        <input type="number" name="giakhuyenmai" value="{{ $sanpham->giakhuyenmai }}" required>

        <label for="thongso_sanpham">Thông số:</label>
        <input type="text" name="thongso_sanpham" value="{{ $sanpham->thongso_sanpham }}" required>

        <label for="danhmuc">Danh mục:</label>
        <select name="danhmuc" id="danhmuc" required>
            <option value="Văn Phòng - Học Tập" {{ $sanpham->danhmuc == 'Văn Phòng - Học Tập' ? 'selected' : '' }}>Văn Phòng - Học Tập</option>
            <option value="Gaming - Đồ Họa" {{ $sanpham->danhmuc == 'Gaming - Đồ Họa' ? 'selected' : '' }}>Gaming - Đồ họa</option>
            <option value="Linh Kiện - Phụ Kiện" {{ $sanpham->danhmuc == 'Linh Kiện - Phụ Kiện' ? 'selected' : '' }}>Linh Kiện - Phụ Kiện</option>
        </select>

        <label for="hangsanpham">Hãng sản phẩm:</label>
        <input type="text" name="hangsanpham" value="{{ $sanpham->hangsanpham }}" required>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>

@stop()
