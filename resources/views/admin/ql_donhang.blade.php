@extends('admin.master')

@section('body')
<div class="content-page">
    <div class="content-header">
        <h2 class="content-title">Quản lý đơn hàng</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row gx-3">
                <div class="col-lg-8 col-md-6 me-auto">
                    {{-- Sửa: Form action trỏ đến route admin.donhang.index --}}
                    <form action="{{ route('qldonhang') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Tìm theo mã đơn hàng, tên, SĐT..." value="{{ request('keyword') }}">
                            <select class="form-select" name="status" style="max-width: 150px;">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả</option>
                                <option value="Chờ xử lý" {{ request('status') == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="Đang giao" {{ request('status') == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="Hoàn thành" {{ request('status') == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="Đã hủy" {{ request('status') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Lọc</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã ĐH</th>
                            <th>Tên người nhận</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Ngày đặt</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donhangs as $donhang)
                        <tr>
                            {{-- Sửa: Dùng đúng tên cột trong database --}}
                            <td><strong>{{ $donhang->ma_don_hang }}</strong></td>
                            <td>{{ $donhang->tennguoinhan }}</td>
                            <td>{{ number_format($donhang->tong_thanhtien) }}₫</td>
                            <td><span class="badge rounded-pill bg-primary">{{ $donhang->phuongthuc_thanhtoan }}</span></td>
                            <td>
                                @php
                                    $badge_class = '';
                                    switch($donhang->trangthai) {
                                        case 'Chờ xử lý': $badge_class = 'bg-warning'; break;
                                        case 'Đang giao': $badge_class = 'bg-info'; break;
                                        case 'Hoàn thành': $badge_class = 'bg-success'; break;
                                        case 'Đã hủy': $badge_class = 'bg-danger'; break;
                                    }
                                @endphp
                                <span class="badge rounded-pill {{ $badge_class }}">{{ $donhang->trangthai }}</span>
                            </td>
                            <td>{{ $donhang->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                {{-- Sửa: Dùng id_donhang để liên kết --}}
                                <a href="{{ route('admin.donhang.show', $donhang->id_donhang) }}" class="btn btn-sm btn-light">Chi tiết</a>
                                <form action="{{ route('admin.donhang.destroy', $donhang->id_donhang) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có đơn hàng nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-area mt-3">
                {{-- Sửa: Thêm appends để giữ lại tham số lọc khi chuyển trang --}}
                {{ $donhangs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@stop
