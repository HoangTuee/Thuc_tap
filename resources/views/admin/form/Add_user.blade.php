@extends('admin.master')
@section('body')
    <div class="container mt-3">
        <a href="{{ route('qladmin') }}" class="btn btn-primary">
            <i class="fa-solid fa-left-long"></i></a>
    </div>
    <div class="container mt-4">
        <h1>Thêm User</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Nhập tên đăng nhập"
                    required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu"
                    required>
            </div>
            <div class="form-group">
                <label for="phanquyen">Phân quyền</label>
                <input type="text" name="phanquyen" class="form-control" id="phanquyen" placeholder="Nhập phân quyền">
            </div>
            <button type="submit" class="btn btn-primary">Thêm User</button>
        </form>
    </div>
@stop()
