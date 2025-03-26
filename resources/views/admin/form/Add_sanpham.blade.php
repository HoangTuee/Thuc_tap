@extends('admin.master')
@section('body')

<div class="content-page container mt-4">
    <h2 class="content-title text-center mb-4">Thêm sản phẩm</h2>

    <div class="card shadow p-4">
        <form action="{{ route('add_sanpham') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="tensanpham" class="form-label">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="tensanpham" required>
            </div>

            <div class="mb-3">
                <label for="giasanpham" class="form-label">Giá sản phẩm:</label>
                <input type="number" class="form-control" name="giasanpham" required>
            </div>

            <div class="mb-3">
                <label for="anhsanpham" class="form-label">Ảnh sản phẩm:</label>
                <input type="file" class="form-control" name="anhsanpham" required>
            </div>

            <div class="mb-3">
                <label for="giakhuyenmai" class="form-label">Giá khuyến mãi:</label>
                <input type="number" class="form-control" name="giakhuyenmai">
            </div>

            <div class="mb-3">
                <label for="thongso_sanpham" class="form-label">Thông số:</label>
                <input type="text" class="form-control" name="thongso_sanpham">
            </div>

            <div class="mb-3">
                <label for="danhmuc" class="form-label">Danh mục:</label>
                <select class="form-select" name="danhmuc" id="danhmuc" required>
                    <option value="">Chọn danh mục</option>
                    <option value="Văn Phòng - Học Tập">Văn Phòng - Học Tập</option>
                    <option value="Gaming - Đồ Họa">Gaming - Đồ Họa</option>
                    <option value="Linh Kiện - Phụ Kiện">Linh Kiện - Phụ Kiện</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="hangsanpham" class="form-label">Hãng sản phẩm:</label>
                <input type="text" class="form-control" name="hangsanpham" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>
</div>

@stop()
