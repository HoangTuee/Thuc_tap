@extends('admin.master')

@section('body')
<div class="content-page">
    <div class="content-header">
        <h2 class="content-title">Chi tiết đơn hàng #{{ $order_info->ma_don_hang_chung }}</h2>
        <div>
            <a href="{{ route('qldonhang') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Quay lại danh sách
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Sản phẩm trong đơn hàng</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th width="15%">Đơn giá</th>
                                    <th width="10%">Số lượng</th>
                                    <th width="20%" class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_items as $item)
                                <tr>
                                    <td>{{ $item->tensanpham }}</td>
                                    <td>{{ number_format($item->gia) }}đ</td>
                                    <td>{{ $item->soluong }}</td>
                                    <td class="text-end">{{ number_format($item->thanhtien) }}đ</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"><strong>Tạm tính</strong></td>
                                    <td class="text-end">{{ number_format($total) }}đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><strong>Phí vận chuyển</strong></td>
                                    <td class="text-end">{{ number_format($shipping) }}đ</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><h5>Tổng cộng</h5></td>
                                    <td class="text-end"><h5>{{ number_format($grand_total) }}đ</h5></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Thông tin khách hàng</h4>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Tên người nhận:</strong> {{ $order_info->tennguoinhan }}<br>
                        <strong>Số điện thoại:</strong> {{ $order_info->sdt_nguoinhan }}<br>
                        <strong>Địa chỉ:</strong> {{ $order_info->diachi_giaohang }}<br>
                        <strong>Ghi chú:</strong> {{ $order_info->ghichu ?? 'Không có' }}
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Cập nhật trạng thái</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donhang.updateStatus', $order_info->ma_don_hang_chung) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="trangthai" class="form-select">
                                <option value="Chờ xử lý" {{ $order_info->trangthai == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="Đang giao" {{ $order_info->trangthai == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="Hoàn thành" {{ $order_info->trangthai == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="Đã hủy" {{ $order_info->trangthai == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
