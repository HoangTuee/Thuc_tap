@extends('admin.master')
@section('body')
<style>
    .welcome-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
</style>
<div class="container welcome-container">
    <div class="card">
        <h1 class="text-primary">Chào mừng {{ Auth::user()->username }} đến với Trang Quản Trị</h1>
        <p>Quản lý nội dung, người dùng và quản lý trang web dễ dàng.</p>
    </div>
</div>

@stop()
