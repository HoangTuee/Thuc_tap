@extends('master') {{-- Sử dụng layout chung của bạn --}}

@section('main')

<style>
    .order-list-card {
        transition: box-shadow .3s;
    }
    .order-list-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .status-badge {
        font-size: 0.85em;
        padding: 0.5em 0.75em;
        min-width: 90px;
        text-align: center;
    }
    .empty-orders {
        text-align: center;
        padding: 50px 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
</style>

<div class="container my-4 my-md-5">
    <h1 class="mb-4">Lịch Sử Đơn Hàng</h1>

    @forelse ($orders as $order)
        {{-- Dạng thẻ cho màn hình nhỏ (Mobile) --}}
        <div class="card order-list-card mb-3 d-md-none">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title fw-bold">Đơn hàng #{{ $order->id }}</h5>
                    @php
                        $statusInfo = match($order->status) {
                            'completed' => ['class' => 'bg-success', 'text' => 'Hoàn thành'],
                            'processing' => ['class' => 'bg-info', 'text' => 'Đang xử lý'],
                            'cancelled' => ['class' => 'bg-danger', 'text' => 'Đã hủy'],
                            default => ['class' => 'bg-warning text-dark', 'text' => 'Chờ xử lý'],
                        };
                    @endphp
                    <span class="badge status-badge {{ $statusInfo['class'] }}">{{ $statusInfo['text'] }}</span>
                </div>
                <p class="card-text text-muted mb-2">Ngày đặt: {{ $order->created_at->format('d/m/Y') }}</p>
                <p class="card-text fw-bold fs-5">{{ number_format($order->total, 0, ',', '.') }}₫</p>
                <a href="" class="btn btn-primary w-100">Xem Chi Tiết</a>
            </div>
        </div>

    @empty
        {{-- Hiển thị khi không có đơn hàng nào --}}
        <div class="empty-orders">
            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
            <h3>Bạn chưa có đơn hàng nào</h3>
            <p class="text-muted">Hãy bắt đầu mua sắm để lấp đầy giỏ hàng của bạn nhé!</p>
            <a href="{{ url('/') }}" class="btn btn-primary mt-2">
                <i class="fas fa-shopping-cart me-2"></i>Bắt đầu mua sắm
            </a>
        </div>
    @endforelse

    {{-- Bảng cho màn hình lớn (Desktop/Tablet) --}}
    @if($orders->isNotEmpty())
    <div class="card d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Mã ĐH</th>
                        <th scope="col">Ngày Đặt</th>
                        <th scope="col" class="text-end">Tổng Tiền</th>
                        <th scope="col" class="text-center">Trạng Thái</th>
                        <th scope="col" class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">#{{ $order->ma_don_hang }}</th>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end fw-bold">{{ number_format($order->tong_thanhtien, 0, ',', '.') }}₫</td>
                            <td class="text-center">
                                @php
                                    $statusInfo = match($order->status) {
                                        'completed' => ['class' => 'bg-success', 'text' => 'Hoàn thành'],
                                        'processing' => ['class' => 'bg-info', 'text' => 'Đang xử lý'],
                                        'cancelled' => ['class' => 'bg-danger', 'text' => 'Đã hủy'],
                                        default => ['class' => 'bg-warning text-dark', 'text' => 'Chờ xử lý'],
                                    };
                                @endphp
                                <span class="badge status-badge {{ $statusInfo['class'] }}">{{ $order->trangthai }}</span>
                            </td>
                            <td class="text-center">
                                <a href="" class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Phân trang --}}
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
    @endif

</div>
@endsection
