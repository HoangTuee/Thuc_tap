@extends('admin.master')

@section('body')
    <div id="product-management" class="content-page">
        <div class="content-header">
            <h2 class="content-title">Quản lý sản phẩm</h2>
            <div>
                <a href="{{ route('view_add_sanpham') }}" class="btn btn-primary">Thêm mới</a>
                <input type="text" class="search-box" placeholder="Tìm kiếm sản phẩm...">
            </div>
        </div>

        <table>
            <thead>
                <tr class="tr">
                    <th>Tên sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Loại</th>
                    <th>Giá sản phẩm</th>
                    <th>Khuyến mại</th>
                    <th>Thông số</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sanphams as $sanpham)
                    <tr class="tr">
                        <td>{{ $sanpham->tensanpham }}</td>
                        <td>
                            <img src="{{ asset($sanpham->anhsanpham) }}" width="100" alt="Ảnh sản phẩm">
                        </td>
                        <td>{{ $sanpham->hangsanpham }}</td>
                        <td>{{ number_format($sanpham->giasanpham) }}đ</td>
                        <td>{{ number_format($sanpham->giakhuyenmai) }}%</td>
                        <td>{{ $sanpham->thongso_sanpham }}</td>
                        <td>{{ $sanpham->danhmuc }}</td>
                        <td style="width: 300px">
                            <a href="{{ route('qlchitietsanpham', $sanpham->tensanpham) }}"class="btn btn-success">Chi tiết</a>
                            <a href="{{ route('view_edit_sanpham', $sanpham->id_sanpham) }}"class="btn btn-success">Sửa</a>
                            <form action="{{ route('delete_sanpham', $sanpham->id_sanpham) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <div class="pagination">
                    {{ $sanphams->links() }}
                </div>
            </tbody>
        </table>
    </div>
@stop
