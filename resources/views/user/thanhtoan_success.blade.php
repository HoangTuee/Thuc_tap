{{-- Kế thừa từ layout chính của bạn, ví dụ 'master.blade.php' --}}
@extends('master')

@section('main')
<style>
    body {
        background-color: #f8f9fa;
    }
    .success-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
        text-align: center;
    }
    .success-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        padding: 4rem 3rem;
        max-width: 600px;
        width: 100%;
        border: 1px solid #e9ecef;
    }
    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin-bottom: 2rem;
        animation: pop-in 0.5s ease-out;
    }
    @keyframes pop-in {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .success-card h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    .success-card p {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
    }
    .btn-success-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    .btn-success-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        color: white;
    }
    .btn-outline-secondary-custom {
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
</style>

<div class="container success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h2>Đặt Hàng Thành Công!</h2>
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @else
            <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi. Đơn hàng của bạn đang được xử lý.</p>
        @endif

        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="{{ route('index') }}" class="btn btn-success-custom btn-lg">
                <i class="fas fa-home me-2"></i>Tiếp tục mua sắm
            </a>
            {{-- Nếu bạn có trang lịch sử đơn hàng, hãy dùng route này --}}
            {{-- <a href="{{ route('order.history') }}" class="btn btn-outline-secondary-custom btn-lg">Xem lịch sử đơn hàng</a> --}}
        </div>
    </div>
</div>
@endsection
