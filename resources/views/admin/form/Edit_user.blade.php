@extends('admin.master')
@section('body')
<div class="container mt-4">
    <h1>Sửa User</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('edit_user', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu mới" required>
        </div>
        <div class="form-group">
            <label for="phanquyen">Phân quyền</label>
            <input type="text" name="phanquyen" class="form-control" id="phanquyen" value="{{ $user->phanquyen }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@stop()
