@extends('admin.master')

@section('body')
<div id="order-management" class="content-page">
    <div class="content-header">
        <h2 class="content-title">Quản lý loại sản phẩm</h2>
        <div>
            <button class="btn btn-primary">Thêm mới</button>
            <input type="text" class="search-box" placeholder="Tìm kiếm khách hàng...">
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Tên loại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample data -->
            <tr>
                <td>#1001</td>
                <td>Nguyễn Văn A</td>
                <td>
                    <button class="btn btn-success">Chi tiết</button>
                    <button class="btn btn-danger">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@stop()
