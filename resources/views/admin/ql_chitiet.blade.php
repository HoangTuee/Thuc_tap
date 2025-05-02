@extends('admin.master')

@section('body')
    <div id="product-management" class="content-page">
        <div class="content-header">
            <h2 class="content-title">Quản lý chi tiết</h2>
            <form action="{{ route('admin.timkiem_chitiet') }}" method="GET" style="display: inline;">
                <input type="text" name="keyword" class="search-box" placeholder="Tìm kiếm chi tiết sản phẩm..."
                    value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-info">Tìm</button>
            </form>
        </div>

        <table>
            @if (request('keyword'))
                <p>Kết quả tìm kiếm cho: <strong>{{ request('keyword') }}</strong></p>
            @endif

            <thead>
                <tr>
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
