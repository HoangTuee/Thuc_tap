@extends('master')
@section('main')
    <style>
        body {
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .payment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .payment-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .payment-body {
            padding: 2rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .btn-payment {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-payment:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .payment-method {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .payment-method:hover {
            border-color: #667eea;
            background: white;
        }

        .payment-method.active {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .card-icons {
            display: flex;
            gap: 10px;
            margin-top: 0.5rem;
        }

        .card-icon {
            width: 40px;
            height: 25px;
            background-size: contain;
            background-repeat: no-repeat;
            border-radius: 4px;
        }

        .order-summary {
            background: rgba(248, 249, 250, 0.8);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
        }

        .security-info {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-radius: 8px;
            padding: 1rem;
            border-left: 4px solid #28a745;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
            color: #6c757d;
        }

        .step.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .step.completed {
            background: #28a745;
            color: white;
        }

        @media (max-width: 768px) {
            .payment-container {
                margin: 1rem;
                border-radius: 15px;
            }

            .payment-header {
                padding: 1.5rem;
            }

            .payment-body {
                padding: 1.5rem;
            }
        }

        .payment-method {
            /* Thêm style cho label để click được */
            position: relative;
            /* Để input radio ẩn có thể được định vị */
        }

        .payment-method input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .payment-method-label {
            /* Bọc nội dung của payment-method bằng label */
            display: block;
            cursor: pointer;
            padding: 1rem;
            /* Giữ padding gốc của .payment-method */
            border: 2px solid #e9ecef;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .payment-method input[type="radio"]:checked+.payment-method-label {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .payment-method:hover .payment-method-label {
            /* Hover effect */
            border-color: #667eea;
            background: white;
        }

        .order-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
        }

        .order-summary-item .item-details {
            flex-grow: 1;
        }

        .order-summary-item .item-name {
            font-weight: 500;
            color: #333;
        }

        .order-summary-item .item-quantity-price {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .order-summary-item .item-total-price {
            font-weight: 500;
            color: #212529;
            min-width: 90px;
            text-align: right;
        }

        .summary-separator {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border-top: 1px solid #dee2e6;
        }

        /* Hiển thị lỗi validation */
        .alert-danger ul {
            margin-bottom: 0;
        }
    </style>
    </head>

    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9"> {{-- Có thể điều chỉnh độ rộng --}}
                    <div class="payment-container">
                        <div class="payment-header">
                            <h2 class="mb-0">
                                <i class="fas fa-credit-card me-3"></i>
                                Thông tin thanh toán
                            </h2>
                            <p class="mb-0 mt-2 opacity-75">Hoàn tất đơn hàng của bạn một cách an toàn</p>
                        </div>

                        <div class="payment-body">
                            <div class="step-indicator">
                                <div class="step completed"><i class="fas fa-shopping-cart"></i></div>
                                <div class="step active"><i class="fas fa-truck"></i></div> {{-- Giao hàng/Địa chỉ --}}
                                <div class="step active"><i class="fas fa-credit-card"></i></div> {{-- Thanh toán --}}
                            </div>

                            <div class="mb-4">
                                <a href="{{ route('giohang') }}" class="text-decoration-none">
                                    <i class="fas fa-arrow-left me-2"></i>Quay lại giỏ hàng
                                </a>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger mb-4">
                                    <h5 class="alert-heading">Có lỗi xảy ra!</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mb-4">
                                    {{ session('error') }}
                                </div>
                            @endif


                            <div class="row">
                                <div class="col-lg-7">
                                    <form id="paymentForm" action="{{ route('checkout.process') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <h5 class="mb-3">Phương thức thanh toán</h5>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="payment-method" data-method="cod">
                                                        <input type="radio" name="payment_method" value="cod"
                                                            id="method_cod"
                                                            {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                                                        <label for="method_cod" class="payment-method-label w-100">
                                                            <div class="d-flex align-items-center">
                                                                <i
                                                                    class="fas fa-hand-holding-usd text-warning me-3 fa-fw"></i>
                                                                <div>
                                                                    <strong>Thanh toán khi nhận hàng (COD)</strong>
                                                                    <div class="small text-muted">Tiện lợi và an toàn</div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="payment-method" data-method="card">
                                                        <input type="radio" name="payment_method" value="card"
                                                            id="method_card"
                                                            {{ old('payment_method') == 'card' ? 'checked' : '' }}>
                                                        <label for="method_card" class="payment-method-label w-100">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-credit-card text-primary me-3 fa-fw"></i>
                                                                <div>
                                                                    <strong>Thẻ tín dụng/ghi nợ</strong>
                                                                    <div class="card-icons mt-1">
                                                                        <i class="fab fa-cc-visa fa-lg text-primary"></i>
                                                                        <i
                                                                            class="fab fa-cc-mastercard fa-lg text-danger ms-1"></i>
                                                                        <i class="fab fa-cc-jcb fa-lg text-info ms-1"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="payment-method" data-method="wallet">
                                                        <input type="radio" name="payment_method" value="wallet"
                                                            id="method_wallet"
                                                            {{ old('payment_method') == 'wallet' ? 'checked' : '' }}>
                                                        <label for="method_wallet" class="payment-method-label w-100">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-wallet text-success me-3 fa-fw"></i>
                                                                <div>
                                                                    <strong>Ví điện tử</strong>
                                                                    <div class="small text-muted">MoMo, ZaloPay, VNPay</div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="payment-method" data-method="bank">
                                                        <input type="radio" name="payment_method" value="bank"
                                                            id="method_bank"
                                                            {{ old('payment_method') == 'bank' ? 'checked' : '' }}>
                                                        <label for="method_bank" class="payment-method-label w-100">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-university text-info me-3 fa-fw"></i>
                                                                <div>
                                                                    <strong>Chuyển khoản ngân hàng</strong>
                                                                    <div class="small text-muted">QR Code hoặc STK</div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="cardInfo"
                                            style="display: {{ old('payment_method') == 'card' ? 'block' : 'none' }};">
                                            <h5 class="mb-3">Thông tin thẻ</h5>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="card_number" class="form-label">Số thẻ</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-credit-card"></i></span>
                                                        <input type="text" id="card_number" name="card_number"
                                                            class="form-control" placeholder="1234 5678 9012 3456"
                                                            maxlength="19" value="{{ old('card_number') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <label for="card_holder_name" class="form-label">Tên chủ thẻ</label>
                                                    <input type="text" id="card_holder_name" name="card_holder_name"
                                                        class="form-control" placeholder="NGUYEN VAN A"
                                                        value="{{ old('card_holder_name') }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="card_expiry" class="form-label">Ngày hết hạn</label>
                                                    <input type="text" id="card_expiry" name="card_expiry"
                                                        class="form-control" placeholder="MM/YY" maxlength="5"
                                                        value="{{ old('card_expiry') }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="card_cvv" class="form-label">Mã CVV</label>
                                                    <div class="input-group">
                                                        <input type="password" id="card_cvv" name="card_cvv"
                                                            class="form-control" placeholder="123" maxlength="4">
                                                        <span class="input-group-text"><i class="fas fa-question-circle"
                                                                title="3-4 chữ số ở mặt sau thẻ"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <h5 class="mb-3">Thông tin giao hàng & người nhận</h5>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="customer_name" class="form-label">Họ và tên người nhận
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" id="customer_name" name="customer_name"
                                                        class="form-control" placeholder="Nguyễn Văn A"
                                                        value="{{ old('customer_name', Auth::user()->hoten ?? '') }}"
                                                        required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="customer_phone" class="form-label">Số điện thoại người
                                                        nhận <span class="text-danger">*</span></label>
                                                    <input type="tel" id="customer_phone" name="customer_phone"
                                                        class="form-control" placeholder="0123456789"
                                                        value="{{ old('customer_phone', Auth::user()->sodienthoai ?? '') }}"
                                                        required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="customer_address" class="form-label">Địa chỉ giao hàng
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" id="customer_address" name="customer_address"
                                                        class="form-control"
                                                        placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"
                                                        value="{{ old('customer_address', Auth::user()->diachi ?? '') }}"
                                                        required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="order_notes" class="form-label">Ghi chú đơn hàng (tùy
                                                        chọn)</label>
                                                    <textarea name="order_notes" id="order_notes" class="form-control" rows="3"
                                                        placeholder="Ví dụ: Giao hàng giờ hành chính,...">{{ old('order_notes') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="security-info mt-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-shield-alt text-success me-3 fs-4"></i>
                                                <div><strong>Thanh toán an toàn</strong>
                                                    <div class="small">Thông tin của bạn được mã hóa.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-5 mt-4 mt-lg-0">
                                    <div class="order-summary" style="position: sticky; top: 20px;">
                                        <h5 class="mb-4">Tóm tắt đơn hàng</h5>

                                        @if (isset($thanhtoan) && $thanhtoan->count() > 0)
                                            @foreach ($thanhtoan as $item)
                                                <div class="order-summary-item">
                                                    <div class="item-details">
                                                        <div class="item-name">{{ Str::limit($item->tensanpham, 30) }}
                                                        </div>
                                                        <div class="item-quantity-price">SL: {{ $item->soluong }} x
                                                            {{ number_format($item->sanpham->giasanpham - ($item->sanpham->giasanpham * $item->sanpham->giakhuyenmai) / 100, 0, ',', '.') }}₫
                                                        </div>
                                                    </div>
                                                    <div class="item-total-price">
                                                        {{ number_format(($item->sanpham->giasanpham - ($item->sanpham->giasanpham * $item->sanpham->giakhuyenmai) / 100) * $item->soluong, 0, ',', '.') }}₫
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Giỏ hàng của bạn trống.</p>
                                        @endif

                                        <div class="summary-separator"></div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Tạm tính ({{ $loai ?? 0 }} món, sl {{ $tongsoluong }})</span>
                                            <span>{{ number_format($tongtien ?? 0, 0, ',', '.') }}₫</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Phí vận chuyển</span>
                                            <span>{{ number_format($shipping ?? 0, 0, ',', '.') }}₫</span>
                                        </div>

                                        @if (isset($discount) && $discount > 0)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Giảm giá</span>
                                                <span
                                                    class="text-success">-{{ number_format($discount, 0, ',', '.') }}₫</span>
                                            </div>
                                        @endif

                                        @if (isset($vatAmount) && $vatAmount > 0)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>Thuế VAT (ước tính)</span>
                                                <span>{{ number_format($vatAmount, 0, ',', '.') }}₫</span>
                                            </div>
                                        @endif

                                        <hr>
                                        <div class="d-flex justify-content-between mb-3 h5">
                                            <strong>Tổng cộng</strong>
                                            <strong
                                                class="text-primary">{{ number_format($tongtien + $shipping ?? 0, 0, ',', '.') }}₫</strong>
                                        </div>

                                        <button type="submit" form="paymentForm"
                                            class="btn btn-primary btn-payment w-100 mb-3">
                                            <span id="paymentButtonText"><i class="fas fa-lock me-2"></i>Đặt hàng</span>
                                            (<span
                                                id="paymentButtonAmount">{{ number_format($tongtien + $shipping ?? 0, 0, ',', '.') }}₫</span>)
                                        </button>

                                        <div class="text-center">
                                            <small class="text-muted">
                                                Bằng việc nhấp "Đặt hàng", bạn đồng ý với
                                                <a href="#" class="text-decoration-none">Điều khoản sử dụng</a>.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const paymentMethodRadios = document.querySelectorAll('.payment-method input[type="radio"]');
                const cardInfoDiv = document.getElementById('cardInfo');
                const paymentBtn = document.querySelector('.btn-payment'); // Nút submit form chính
                const paymentButtonTextSpan = document.getElementById('paymentButtonText'); // Span chứa text của nút
                const paymentButtonAmountSpan = document.getElementById('paymentButtonAmount'); // Span chứa số tiền
                // const totalAmount = parseFloat("{{ $total ?? 0 }}");
                const formattedTotalAmount = "{{ number_format($total ?? 0, 0, ',', '.') }}₫";

                function toggleCardInfo() {
                    const selectedMethod = document.querySelector('.payment-method input[type="radio"]:checked');
                    if (selectedMethod && selectedMethod.value === 'card') {
                        cardInfoDiv.style.display = 'block';
                        cardInfoDiv.querySelectorAll('input').forEach(input => input.required = true);
                    } else {
                        cardInfoDiv.style.display = 'none';
                        cardInfoDiv.querySelectorAll('input').forEach(input => input.required = false);
                    }
                }

                function updateButtonText() {
                    const selectedMethodRadio = document.querySelector('.payment-method input[type="radio"]:checked');
                    if (!selectedMethodRadio) return;
                    const method = selectedMethodRadio.value;
                    let iconClass = 'fas fa-lock'; // Default icon

                    switch (method) {
                        case 'card':
                            iconClass = 'fas fa-credit-card';
                            paymentButtonTextSpan.innerHTML = `<i class="${iconClass} me-2"></i>Thanh toán`;
                            break;
                        case 'wallet':
                            iconClass = 'fas fa-wallet';
                            paymentButtonTextSpan.innerHTML = `<i class="${iconClass} me-2"></i>Thanh toán qua ví`;
                            break;
                        case 'cod':
                            iconClass = 'fas fa-hand-holding-usd';
                            paymentButtonTextSpan.innerHTML = `<i class="${iconClass} me-2"></i>Đặt hàng COD`;
                            break;
                        case 'bank':
                            iconClass = 'fas fa-university';
                            paymentButtonTextSpan.innerHTML = `<i class="${iconClass} me-2"></i>Chuyển khoản`;
                            break;
                        default:
                            paymentButtonTextSpan.innerHTML = `<i class="${iconClass} me-2"></i>Đặt hàng`;
                    }
                }


                paymentMethodRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        toggleCardInfo();
                        updateButtonText();
                    });
                });

                // Initial setup
                toggleCardInfo();
                updateButtonText();
                if (paymentButtonAmountSpan) paymentButtonAmountSpan.textContent = formattedTotalAmount;


                const cardNumberInput = document.querySelector('input[name="card_number"]');
                if (cardNumberInput) {
                    cardNumberInput.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/\s/g, '').replace(/[^0-9]/gi, '');
                        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                        e.target.value = formattedValue;
                    });
                }

                const cardExpiryInput = document.querySelector('input[name="card_expiry"]');
                if (cardExpiryInput) {
                    cardExpiryInput.addEventListener('input', function(e) {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length > 2) {
                            value = value.substring(0, 2) + '/' + value.substring(2, 4);
                        }
                        e.target.value = value;
                    });
                }

                const cardCvvInput = document.querySelector('input[name="card_cvv"]');
                if (cardCvvInput) {
                    cardCvvInput.addEventListener('input', function(e) {
                        e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    });
                }

                const paymentForm = document.getElementById('paymentForm');
                if (paymentForm) {
                    paymentForm.addEventListener('submit', function(e) {
                        // Không preventDefault() để form được submit lên server
                        const originalButtonHtml = paymentBtn.innerHTML;
                        paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
                        paymentBtn.disabled = true;
                        // Form sẽ tự submit. Nếu có lỗi server-side validation, Laravel sẽ tự xử lý và hiển thị lỗi.
                    });
                }
            });
        </script>
    </body>
@stop()
