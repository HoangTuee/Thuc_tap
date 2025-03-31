@extends('admin.master')
@section('body')
<div class="container mt-3">
    <a href="{{ route('sanpham') }}" class="btn btn-primary">
        <i class="fa-solid fa-left-long"></i></a>
</div>
<div class="container mt-4">
    <h2 class="mb-4">Sửa sản phẩm</h2>

    <form action="{{ route('edit_sanpham', $sanpham->id_sanpham) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tensanpham" class="form-label">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="tensanpham" value="{{ $sanpham->tensanpham }}" required>
        </div>

        <div class="mb-3">
            <label for="giasanpham" class="form-label">Giá sản phẩm:</label>
            <input type="number" class="form-control" name="giasanpham" value="{{ $sanpham->giasanpham }}" required>
        </div>

        <div class="mb-3">
            <label for="anhsanpham" class="form-label">Ảnh sản phẩm:</label>
            <input type="file" class="form-control" name="anhsanpham">
        </div>

        <div class="mb-3">
            <label for="giakhuyenmai" class="form-label">Giá khuyến mãi:</label>
            <input type="number" class="form-control" name="giakhuyenmai" value="{{ $sanpham->giakhuyenmai }}">
        </div>

        <div class="mb-3">
            <label for="thongso_sanpham" class="form-label">Thông số:</label>
            <input type="text" class="form-control" name="thongso_sanpham" value="{{ $sanpham->thongso_sanpham }}">
        </div>

        <div class="mb-3">
            <label for="danhmuc" class="form-label">Danh mục:</label>
            <select class="form-select" name="danhmuc" id="danhmuc" required>
                <option value="Văn Phòng - Học Tập" {{ $sanpham->danhmuc == 'Văn Phòng - Học Tập' ? 'selected' : '' }}>Văn Phòng - Học Tập</option>
                <option value="Gaming - Đồ Họa" {{ $sanpham->danhmuc == 'Gaming - Đồ Họa' ? 'selected' : '' }}>Gaming - Đồ họa</option>
                <option value="Linh Kiện - Phụ Kiện" {{ $sanpham->danhmuc == 'Linh Kiện - Phụ Kiện' ? 'selected' : '' }}>Linh Kiện - Phụ Kiện</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="hangsanpham" class="form-label">Hãng sản phẩm:</label>
            <input type="text" class="form-control" name="hangsanpham" value="{{ $sanpham->hangsanpham }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>

@stop()
