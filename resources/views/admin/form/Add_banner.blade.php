@extends('admin.master')

@section('body')
    <div class="content-page">
        <div class="content-header">
            <h2 class="content-title">Thêm Banner</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('add_banner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tensanpham" class="form-label">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="tensanpham" required>
                    </div>
                    <div class="form-group">
                        <label for="anh_banner">Chọn ảnh banner:</label>
                        <input type="file" name="anh_banner" class="form-control" id="anh_banner" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Thêm Banner</button>
                </form>
            </div>
        </div>
    </div>
@stop()
