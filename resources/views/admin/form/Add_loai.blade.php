@extends('admin.master')
@section('body')

<div class="container mt-4">
    <h1>Thêm Loại Sản Phẩm</h1>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form thêm loại sản phẩm -->
    <form action="{{ route('loai-sanpham.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="tenloai">Tên Loại Sản Phẩm</label>
            <input type="text" name="tenloai" class="form-control" id="tenloai" placeholder="Nhập tên loại sản phẩm" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>

@stop()
