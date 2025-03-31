@extends('admin.master')

@section('body')
    <div class="container mt-3">
        <a href="{{ route('qlbanner') }}" class="btn btn-primary">
            <i class="fa-solid fa-left-long"></i></a>
    </div>
    <div class="content-page">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="content-header">
                    <h2 class="content-title">Sửa Banner</h2>
                </div>
                <form action="{{ route('edit_banner', $banner) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="anh_banner">Chọn ảnh banner:</label>
                        <input type="file" name="anh_banner" class="form-control" id="anh_banner" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Cập Nhật</button>
                </form>
            </div>
        </div>
    </div>
@stop()
