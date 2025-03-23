@extends('admin.master')

@section('body')
    <div id="product-management" class="content-page">
        <div class="content-header">
            <h2 class="content-title">Quản lý chi tiết</h2>
            <div>
                <a href="{{ route('view_add_chitiet') }}" class="btn btn-primary">Thêm mới</a>
                <input type="text" class="search-box" placeholder="Tìm kiếm sản phẩm...">
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên sản phẩm</th>
                    <th>Cấu hình sản phẩm</th>
                    <th>Tình trạng</th>
                    <th>Chi tiết 1</th>
                    <th>Chi tiết 2</th>
                    <th>Chi tiết 3</th>
                    <th>Chi tiết 4</th>
                    <th style="width: 250px">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chitiets as $chitiet)
                    <tr>
                        <td>{{ $chitiet->id_chitiet }}</td>
                        <td>{{ $chitiet->tensanpham }}</td>
                        <td>{{ $chitiet->cauhinh_sanpham }}</td>
                        <td>{{ $chitiet->tinhtrang_sanpham }}</td>
                        <td>
                            <img src="{{ asset($chitiet->anhchitiet1) }}" width="70" alt="Ảnh sản phẩm">
                        </td>
                        <td>
                            <img src="{{ asset($chitiet->anhchitiet2) }}" width="70" alt="Ảnh sản phẩm">
                        </td>
                        <td>
                            <img src="{{ asset($chitiet->anhchitiet3) }}" width="70" alt="Ảnh sản phẩm">
                        </td>
                        <td>
                            <img src="{{ asset($chitiet->anhchitiet4) }}" width="70" alt="Ảnh sản phẩm">
                        </td>
                        <td>
                            <a href="{{ route('view_edit_chitiet', $chitiet->id_chitiet) }}"class="btn btn-success">Sửa</a>
                            <form action="{{ route('delete_chitiet', $chitiet->id_chitiet) }}" method="POST"
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
                    {{ $chitiets->links() }}
                </div>
            </tbody>
        </table>
    </div>
@stop
