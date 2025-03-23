@extends('admin.master')

@section('body')
    <div id="order-management" class="content-page">
        <div class="content-header">
            <h2 class="content-title">Quản lý banner</h2>
            <div>
                <button class="btn btn-primary"><a href="{{ route('view_add_banner') }}">Thêm mới</a></button>
                <input type="text" class="search-box" placeholder="Tìm kiếm khách hàng...">
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Banner</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <td>{{ $banner->id_banner }}</td>
                        <td>
                            <img src="{{ asset($banner->anh_banner) }}" width="150" alt="Banner">
                        </td>
                        <td>
                            <a href="{{ route('view_edit_banner', $banner->id_banner) }}"class="btn btn-success">Sửa</a>
                            <form action="{{ route('delete_banner', $banner->id_banner) }}" method="POST" style="display:inline-block;" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa banner này không?')"
                                    class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
