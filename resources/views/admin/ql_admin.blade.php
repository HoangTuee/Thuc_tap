@extends('admin.master')

@section('body')
    <div id="order-management" class="content-page">
        <div class="content-header">
            <h2 class="content-title">Quản lý tài khoản</h2>
            <div>
                <button class="btn btn-primary"><a href="{{ route('view_add_user') }}">Thêm mới</a></button>
                <form action="{{ route('timkiem_user') }}" method="GET" style="display: inline;">
                    <input type="text" name="keyword" class="search-box" placeholder="Tìm kiếm tài khoản..." value="{{ request('keyword') }}">
                    <button type="submit" class="btn btn-info">Tìm</button>
                </form>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            @if (request('keyword'))
                <p>Kết quả tìm kiếm cho: <strong>{{ request('keyword') }}</strong></p>
            @endif
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
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này không?')"
                                    class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
