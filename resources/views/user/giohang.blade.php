@extends('master')
@section('main')

    <div class="container py-5">
        <h1 class="mb-4">🛒 Giỏ Hàng Của Bạn</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('success delete'))
        <div class="alert alert-danger">
            {{ session('success delete') }}
        </div>
        @endif
        <!-- Danh sách sản phẩm -->
        @if($giohang->isEmpty())
        <h1 style="text-align: center; color:red; font-size:150%; border: 1px solid black">
            Không có sản phẩm nào trong giỏ hàng
            (<a href="{{ route('index') }}" style="text-decoration: none">Mua hàng</a>)
        </h1>
        @else
        <div class="card mb-4">
            <div class="card-body">
                @foreach ($giohang as $gh)
                    <div class="row g-3 mb-4 cart-item">
                        <div class="col-12 col-md-3">
                            <img src="{{ asset($gh->sanpham->anhsanpham) }}" class="cart-item-image img-fluid" alt="Sản phẩm">
                        </div>

                        <div class="col-12 col-md-5">
                            <h4 class="mb-2">{{ $gh->tensanpham }}</h4>
                            <p class="text-muted mb-2">{{ $gh->sanpham->thongso_sanpham }}</p>
                            <h5 class="text-danger">{{ number_format($gh->giasanpham) }}</h5>
                        </div>

                        <div class="col-12 col-md-2">
                            <div class="d-flex align-items-center quantity-control">
                                <button class="btn btn-outline-secondary" onclick="updateQuantity(this, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control quantity-input mx-2" value="{{ $gh->soluong }}"
                                    min="1">
                                <button class="btn btn-outline-secondary" onclick="updateQuantity(this, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-12 col-md-2">
                                <form action="{{ route('deletegiohang',$gh->id_giohang) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                    class="btn btn-danger w-100">Xóa</button>
                                </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Tổng kết -->
        <div class="cart-summary-card">
            <div class="row">
                <div class="col-md-6 offset-md-6">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Giá :</span>
                        <span id="subtotal">249.000₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span>Phí vận chuyển:</span>
                        <span>30.000₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 h4">
                        <span>Tổng tiền:</span>
                        <span class="text-danger" id="total-amount">279.000₫</span>
                    </div>
                    <button class="btn btn-success w-100 py-3">
                        <i class="fas fa-credit-card me-2"></i>THANH TOÁN
                    </button>
                </div>
            </div>
        </div>
    </div>

@stop()
