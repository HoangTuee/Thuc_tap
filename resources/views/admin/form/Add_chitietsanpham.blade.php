@extends('admin.master')

@section('body')
<div class="container mt-4">
    <h2 class="mb-3">Thêm Chi Tiết Sản Phẩm</h2>
    <form action="{{ route('add_chitiet') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="tensanpham" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="tensanpham" value="{{ $tensanpham }}" name="tensanpham" required>
        </div>
        <div class="mb-3">
            <label for="cauhinh_sanpham" class="form-label">Cấu Hình</label>
            <input type="text" class="form-control" id="cauhinh_sanpham" name="cauhinh_sanpham">
        </div>
        <div class="mb-3">
            <label for="tinhtrang_sanpham" class="form-label">Tình Trạng</label>
            <select name="tinhtrang_sanpham" class="form-select">
                <option value="Liên hệ">Liên hệ</option>
                <option value="Còn hàng">Còn hàng</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh Chi Tiết</label>
            <input type="file" class="form-control mb-2" name="anhchitiet1">
            <input type="file" class="form-control mb-2" name="anhchitiet2">
            <input type="file" class="form-control mb-2" name="anhchitiet3">
            <input type="file" class="form-control mb-2" name="anhchitiet4">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@stop
