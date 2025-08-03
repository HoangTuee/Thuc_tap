@extends('admin.master')

@section('body')
<div class="content-page">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Chi tiết đơn hàng</h2>
            <p>Mã đơn hàng: <strong>{{ $donhang->ma_don_hang }}</strong></p>
        </div>
        <div>
            <a href="{{ route('qldonhang') }}" class="btn btn-light rounded-pill">Quay lại danh sách</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Thông tin sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th width="20%">Đơn giá</th>
                                    <th width="15%">Số lượng</th>
                                    <th width="20%" class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donhang->chiTietDonHangs as $chitiet)
                                <tr>
                                    <td>
                                        {{-- Giả sử bạn đã có relationship 'sanpham' trong model ChiTietDonHang --}}
                                        <strong>{{ $chitiet->sanpham->tensanpham ?? '[Sản phẩm đã xóa]' }}</strong>
                                    </td>
                                    <td>{{ number_format($chitiet->gia) }}₫</td>
                                    <td>{{ $chitiet->soluong }}</td>
                                    <td class="text-end">{{ number_format($chitiet->thanhtien) }}₫</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Phí vận chuyển:</dt> <dd>30,000₫</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt><strong>Tổng cộng:</strong></dt>
                                                <dd><strong>{{ number_format($donhang->tong_thanhtien) }}₫</strong></dd>
                                            </dl>
                                        </article>
                                    </td>
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
                    <h4>Thông tin người nhận</h4>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Tên:</strong> {{ $donhang->tennguoinhan }} <br>
                        <strong>SĐT:</strong> {{ $donhang->sdt_nguoinhan }} <br>
                        <strong>Địa chỉ:</strong> {{ $donhang->diachi_giaohang }}
                    </p>
                    @if($donhang->ghichu)
                    <p><strong>Ghi chú:</strong> {{ $donhang->ghichu }}</p>
                    @endif
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Cập nhật trạng thái</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donhang.update_status', $donhang->id_donhang) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="trangthai" class="form-label">Trạng thái</label>
                            <select class="form-select" name="trangthai" id="trangthai">
                                <option value="Chờ xử lý" {{ $donhang->trangthai == 'Chờ xử lý' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="Đang giao" {{ $donhang->trangthai == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="Hoàn thành" {{ $donhang->trangthai == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="Đã hủy" {{ $donhang->trangthai == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
