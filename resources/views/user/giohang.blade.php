@extends('master')
@section('main')

    <div class="container py-5">
        <h1 class="mb-4">🛒 Giỏ Hàng Của Bạn</h1>

        <!-- Danh sách sản phẩm -->
        <div class="card mb-4">
            <div class="card-body">
                @foreach ($giohang as $gh)
                    <div class="row g-3 mb-4 cart-item">
                        <div class="col-12 col-md-3">
                            <img src="{{ asset($gh->anhsanpham) }}" class="cart-item-image img-fluid" alt="Sản phẩm">
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
                            <button class="btn btn-danger w-100" onclick="removeItem(this)">
                                <i class="fas fa-trash me-2"></i>Xóa
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

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
