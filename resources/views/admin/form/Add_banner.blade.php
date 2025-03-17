@extends('admin.master')

@section('body')
    <div class="content-page">
        <div class="content-header">
            <h2 class="content-title">Thêm Banner</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
