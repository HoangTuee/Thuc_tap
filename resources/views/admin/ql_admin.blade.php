@extends('admin.master')

@section('body')
    <div id="order-management" class="content-page">
        <div class="content-header">
            <h2 class="content-title">Quản lý nhân viên</h2>
            <div>
                <button class="btn btn-primary"><a href="{{ route('view_add_user') }}">Thêm mới</a></button>
                <input type="text" class="search-box" placeholder="Tìm kiếm khách hàng...">
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên đăng nhập</th>
                    <th>Mật khẩu</th>
                    <th>Quyền hạn</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id_user }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->password_plaintext }}</td>
                        <td>{{ $user->phanquyen }}</td>
                        <td>
                            <a href="{{ route('view_edit_user', $user->id_user) }}"class="btn btn-success">Sửa</a>
                            <form action="{{ route('delete_user', $user->id_user) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa user này không?')"
                                    class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
