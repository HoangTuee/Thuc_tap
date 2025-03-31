@extends('admin.master')
@section('body')
    <div class="container mt-3">
        <a href="{{ route('qlchitiet') }}" class="btn btn-primary">
            <i class="fa-solid fa-left-long"></i></a>
    </div>
    <div class="container mt-4">
        <h2 class="mb-4">Sửa chi tiết sản phẩm</h2>

        <form action="{{ route('edit_chitiet', $chitiet->id_chitiet) }}" method="POST" enctype="multipart/form-data"
            class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <label class="form-label">Tên sản phẩm:</label>
                <select name="tensanpham" class="form-select" required>
                    <option value="{{ $chitiet->tensanpham }}" selected>
                        {{ $chitiet->tensanpham }}
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Cấu hình:</label>
                <input type="text" name="cauhinh_sanpham" value="{{ $chitiet->cauhinh_sanpham }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Tình trạng:</label>
                <select name="tinhtrang_sanpham" class="form-select">
                    <option value="Liên hệ" {{ $chitiet->tinhtrang_sanpham == 'Liên hệ' ? 'selected' : '' }}>Liên hệ
                    </option>
                    <option value="Còn hàng" {{ $chitiet->tinhtrang_sanpham == 'Còn hàng' ? 'selected' : '' }}>Còn hàng
                    </option>
                </select>
            </div>

            @for ($i = 1; $i <= 4; $i++)
                <div class="col-md-6">
                    <label class="form-label">Ảnh chi tiết {{ $i }}:</label>
                    <input type="file" name="anhchitiet{{ $i }}" value="{{ $chitiet->{'anhchitiet' . $i} }}"
                        class="form-control">
                </div>
            @endfor

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
@stop()
