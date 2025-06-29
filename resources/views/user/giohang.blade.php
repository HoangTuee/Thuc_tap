@extends('master')
@section('main')

    <style>
        body {
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cart-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cart-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 1.5rem;
        }

        .cart-item {
            background: white;
            border-radius: 15px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .cart-item-image {
            width: 100%;
            max-width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
            flex-direction: row;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.5rem;
        }

        .price {
            font-weight: bold;
            color: #667eea;
            font-size: 1.2rem;
        }

        .remove-btn {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .remove-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        }

        .cart-summary {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .checkout-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            font-size: 1.1rem;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        }

        .continue-shopping {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .continue-shopping:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
            background: white;
            border-radius: 15px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .empty-cart i {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
            color: #667eea;
        }

        .badge-count {
            background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
            animation: pulse 2s infinite;
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-specs {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .cart-item-image {
                width: 80px;
                height: 80px;
            }

            .cart-item {
                padding: 1rem;
            }

            .quantity-control {
                flex-direction: row;
                gap: 0.3rem;
                justify-content: center;
            }

            .quantity-btn {
                width: 30px;
                height: 30px;
            }

            .quantity-input {
                width: 50px;
            }

            .cart-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="container py-4">
        <div class="cart-container">
            <div class="cart-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mb-0">
                        <i class="fas fa-shopping-cart me-2"></i>
                        Giỏ hàng của bạn
                    </h1>
                    @if (!$giohang->isEmpty())
                        <span class="badge badge-count rounded-pill">{{ $giohang->count() }} sản phẩm</span>
                    @endif
                </div>
            </div>

            <div class="p-4">
                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="alert alert-success mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('success delete'))
                    <div class="alert alert-danger mb-4" role="alert">
                        <i class="fas fa-trash me-2"></i>
                        {{ session('success delete') }}
                    </div>
                @endif

                <!-- Cart Content -->
                @if ($giohang->isEmpty())
                    <!-- Empty Cart -->
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h3 class="mb-3">Giỏ hàng trống</h3>
                        <p class="mb-4">Không có sản phẩm nào trong giỏ hàng của bạn</p>
                        <a href="{{ route('index') }}" class="btn checkout-btn text-white">
                            <i class="fas fa-shopping-bag me-2"></i>
                            Khám phá sản phẩm
                        </a>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- Cart Items -->
                            <div id="cartItems">
                                @foreach ($giohang as $gh)
                                    <div class="cart-item" data-price="{{ $gh->giasanpham }}">
                                        <div class="row align-items-center">
                                            <div class="col-md-3 col-4">
                                                <img src="{{ asset($gh->sanpham->anhsanpham) }}" alt="{{ $gh->tensanpham }}"
                                                    class="cart-item-image">
                                            </div>

                                            <div class="col-md-4 col-8">
                                                <h5 class="product-title">{{ $gh->tensanpham }}</h5>
                                                <p class="product-specs">{{ $gh->sanpham->thongso_sanpham }}</p>
                                                <div class="price">{{ number_format($gh->giasanpham * $gh->soluong) }}₫
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-6 mt-3 mt-md-0">
                                                <div class="quantity-control">
                                                    <button type="button" class="quantity-btn"
                                                        onclick="updateQuantity(this, -1)">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" value="{{ $gh->soluong }}" min="1"
                                                        class="form-control quantity-input"
                                                        onchange="handleManualInputChange(this)" {{-- Dòng mới --}}
                                                        data-id="{{ $gh->id_giohang }}">
                                                    <button type="button" class="quantity-btn"
                                                        onclick="updateQuantity(this, 1)">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-6 mt-3 mt-md-0 text-end">
                                                <form action="{{ route('deletegiohang', $gh->id_giohang) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
                                                        class="btn remove-btn">
                                                        <i class="fas fa-trash me-1"></i>Xóa
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Continue Shopping -->
                            <div class="mt-4">
                                <a href="{{ route('index') }}" class="continue-shopping">
                                    <i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm
                                </a>
                            </div>
                        </div>

                        <!-- Cart Summary -->
                        <div class="col-lg-4 mt-4 mt-lg-0">
                            <div class="cart-summary">
                                <h4 class="mb-4">
                                    <i class="fas fa-receipt me-2"></i>
                                    Tổng đơn hàng
                                </h4>

                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tạm tính:</span>
                                    <span
                                        id="subtotal">{{ number_format($subtotal ??$giohang->sum(function ($item) {return $item->giasanpham * $item->soluong;})) }}₫</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span>Phí vận chuyển:</span>
                                    <span id="shipping">{{ number_format($shipping ?? 30000) }}₫</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3 text-success">
                                    <span>Giảm giá:</span>
                                    <span id="discount">{{ number_format($discount ?? 0) }}₫</span>
                                </div>

                                <hr class="my-3">

                                <div class="d-flex justify-content-between mb-4">
                                    <strong class="h5">Tổng cộng:</strong>
                                    <strong class="h5 text-danger" id="total-amount">
                                        {{ number_format($total ??$giohang->sum(function ($item) {return $item->giasanpham * $item->soluong;}) +($shipping ?? 30000) -($discount ?? 0)) }}₫
                                    </strong>
                                </div>

                                <!-- Coupon Code -->
                                <div class="mb-4">
                                    <label for="couponCode" class="form-label">
                                        <i class="fas fa-ticket-alt me-1"></i>Mã giảm giá
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="couponCode"
                                            placeholder="Nhập mã giảm giá" style="border-radius: 8px 0 0 8px;">
                                        <button class="btn btn-outline-secondary" type="button" onclick="applyCoupon()"
                                            id="applyCouponBtn" style="border-radius: 0 8px 8px 0;">
                                            Áp dụng
                                        </button>
                                    </div>
                                </div>

                                <!-- Checkout Button -->
                                <button class="btn checkout-btn w-100 text-white mb-3" onclick="proceedToCheckout()">
                                    <i class="fas fa-credit-card me-2"></i>
                                    THANH TOÁN
                                </button>

                                <!-- Security Badge -->
                                <div class="text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt me-1"></i>
                                        Thanh toán bảo mật 100%
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(btn, change) {
            const input = btn.parentElement.querySelector('.quantity-input');
            const currentValue = parseInt(input.value);
            const newValue = Math.max(1, currentValue + change);

            input.value = newValue;
            updateItemPrice(input);
            updateCartTotal();

            // Gửi AJAX request để cập nhật database (tuỳ chọn)
            updateCartDatabase(input.dataset.id, newValue);
        }

        function updateItemPrice(input) {
            const cartItem = input.closest('.cart-item');
            const basePrice = parseInt(cartItem.dataset.price);
            const quantity = parseInt(input.value);
            const priceElement = cartItem.querySelector('.price');
            const newPrice = basePrice * quantity;

            priceElement.textContent = newPrice.toLocaleString() + '₫';
        }

        function updateCartTotal() {
            let subtotal = 0;

            document.querySelectorAll('.cart-item').forEach(item => {
                const basePrice = parseInt(item.dataset.price);
                const quantity = parseInt(item.querySelector('.quantity-input').value);
                subtotal += basePrice * quantity;
            });

            const shipping = 30000;
            const discount = 0;
            const total = subtotal + shipping - discount;

            document.getElementById('subtotal').textContent = subtotal.toLocaleString() + '₫';
            document.getElementById('total-amount').textContent = total.toLocaleString() + '₫';
        }

        function updateCartDatabase(itemId, quantity) {
            fetch(`/cart/update/${itemId}`, { // URL khớp với route
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw new Error(errData.message || `Lỗi HTTP: ${response.status}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('Server response:', data.data); // Kiểm tra dữ liệu server trả về

                        // Cập nhật giá của item hiện tại
                        const currentItemInput = document.querySelector(
                            `.quantity-input[data-id="${data.data.item_id}"]`);
                        if (currentItemInput) {
                            const cartItemRow = currentItemInput.closest('.cart-item');
                            const priceElement = cartItemRow.querySelector('.price');
                            priceElement.textContent = data.data.item_total_price.toLocaleString() + '₫';
                        }

                        // Cập nhật tổng tiền và các thông tin khác từ server
                        document.getElementById('subtotal').textContent = data.data.subtotal.toLocaleString() + '₫';
                        document.getElementById('shipping').textContent = data.data.shipping.toLocaleString() + '₫';
                        document.getElementById('discount').textContent = (data.data.discount > 0 ? '-' : '') + data
                            .data.discount.toLocaleString() + '₫';
                        document.getElementById('total-amount').textContent = data.data.total.toLocaleString() + '₫';

                        // Cập nhật badge số lượng
                        const badge = document.querySelector('.badge-count');
                        if (badge && data.data.cart_count !== undefined) {
                            badge.textContent = data.data.cart_count + ' sản phẩm';
                        }
                        // Thông báo thành công (tùy chọn, có thể dùng thư viện toast)
                        // alert(data.message);
                    } else {
                        alert(data.message || 'Có lỗi xảy ra khi cập nhật giỏ hàng!');
                        // Có thể rollback giá trị input ở đây nếu muốn
                        // Hoặc gọi updateCartTotal() để tính lại theo giá trị input hiện tại (sau khi user sửa)
                        updateCartTotal
                            (); // Tính lại tổng cục bộ nếu server báo lỗi nhưng client vẫn muốn giữ thay đổi tạm thời
                    }
                })
                .catch(error => {
                    console.error('Error updating cart:', error);
                    alert('Lỗi phía client hoặc mạng: ' + error.message);
                    updateCartTotal(); // Tính lại tổng cục bộ
                });
        }

        function applyCoupon() {
            const couponCodeInput = document.getElementById('couponCode');
            const couponCode = couponCodeInput.value.trim();

            if (!couponCode) {
                alert('Vui lòng nhập mã giảm giá!');
                return;
            }

            const applyBtn = document.getElementById('applyCouponBtn'); // Sử dụng ID
            const originalText = applyBtn.textContent;
            applyBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...'; // Thêm spinner
            applyBtn.disabled = true;
            couponCodeInput.disabled = true; // Vô hiệu hóa input khi đang xử lý

            // Xóa các thông báo cũ về coupon
            const existingCouponMessage = document.getElementById('couponMessage');
            if (existingCouponMessage) {
                existingCouponMessage.remove();
            }

            fetch('/cart/apply-coupon', { // URL khớp với route
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        coupon_code: couponCode
                    })
                })
                .then(response => {
                    // if (!response.ok) { // Ngay cả khi response không ok, vẫn có thể là JSON chứa lỗi
                    //     return response.json().then(errData => {
                    //         throw new Error(errData.message || `Lỗi HTTP: ${response.status}`);
                    //     });
                    // }
                    return response.json();
                })
                .then(data => {
                    const couponContainer = couponCodeInput.parentElement; // div class="input-group"
                    const messageElement = document.createElement('small');
                    messageElement.id = 'couponMessage'; // Để dễ dàng xóa/cập nhật
                    messageElement.className = 'mt-1 d-block';

                    if (data.success) {
                        document.getElementById('discount').textContent = '-' + data.discount.toLocaleString() + '₫';
                        document.getElementById('total-amount').textContent = data.total.toLocaleString() + '₫';
                        // Cập nhật các giá trị khác nếu server trả về (ví dụ subtotal, shipping có thể không đổi)

                        messageElement.className += ' text-success';
                        messageElement.innerHTML =
                            `<i class="fas fa-check-circle me-1"></i>${data.message} (Mã: ${data.coupon_code})`;

                        applyBtn.textContent = 'Đã áp dụng';
                        applyBtn.classList.remove('btn-outline-secondary');
                        applyBtn.classList.add('btn-success'); // Đổi màu nút
                        // couponCodeInput.disabled = true; // Giữ disabled
                        // applyBtn.disabled = true; // Giữ disabled

                    } else {
                        messageElement.className += ' text-danger';
                        messageElement.innerHTML =
                            `<i class="fas fa-times-circle me-1"></i>${data.message || 'Mã giảm giá không hợp lệ!'}`;
                        // Reset trường discount nếu coupon không hợp lệ và trước đó có coupon khác
                        document.getElementById('discount').textContent = '0₫';
                        // Gọi updateCartTotal để tính lại tổng nếu mã coupon trước đó bị gỡ bỏ
                        updateCartTotal();
                        couponCodeInput.disabled = false; // Cho phép nhập lại
                        applyBtn.disabled = false;
                        applyBtn.textContent = originalText; // Reset nút
                    }
                    // Chèn thông báo vào sau input group
                    if (couponContainer.nextSibling && couponContainer.nextSibling.id === 'couponMessage') {
                        couponContainer.parentElement.replaceChild(messageElement, couponContainer.nextSibling);
                    } else {
                        couponContainer.insertAdjacentElement('afterend', messageElement);
                    }

                })
                .catch(error => {
                    console.error('Error applying coupon:', error);
                    alert('Lỗi phía client hoặc mạng khi áp dụng mã: ' + error.message);
                    couponCodeInput.disabled = false;
                    applyBtn.disabled = false;
                    applyBtn.textContent = originalText;
                    // Xóa thông báo lỗi cũ nếu có
                    const oldMsg = document.getElementById('couponMessage');
                    if (oldMsg) oldMsg.remove();

                    const couponContainer = couponCodeInput.parentElement;
                    const errorMsgElement = document.createElement('small');
                    errorMsgElement.id = 'couponMessage';
                    errorMsgElement.className = 'text-danger mt-1 d-block';
                    errorMsgElement.innerHTML =
                        `<i class="fas fa-exclamation-circle me-1"></i> Lỗi kết nối khi áp dụng mã.`;
                    couponContainer.insertAdjacentElement('afterend', errorMsgElement);
                })
                .finally(() => {
                    // Chỉ reset button nếu không thành công hoặc muốn cho phép thử lại
                    if (!applyBtn.classList.contains('btn-success')) {
                        applyBtn.textContent = originalText;
                        applyBtn.disabled = false;
                        couponCodeInput.disabled = false;
                    }
                });
        }

        function handleManualInputChange(inputElement) {
            const itemId = inputElement.dataset.id;
            let newQuantity = parseInt(inputElement.value);
            const minQuantity = parseInt(inputElement.min);

            // Đảm bảo số lượng hợp lệ
            if (isNaN(newQuantity) || newQuantity < minQuantity) {
                newQuantity = minQuantity;
                inputElement.value = newQuantity; // Cập nhật lại UI nếu giá trị không hợp lệ
            }

            // Cập nhật giá và tổng tiền cục bộ trên UI
            updateItemPrice(inputElement);
            updateCartTotal(); // Hàm này bạn đã có để tính lại tổng

            // Gửi yêu cầu cập nhật lên server
            updateCartDatabase(itemId, newQuantity);
        }

        // Auto-update totals when page loads
        document.addEventListener('DOMContentLoaded', function() {
            updateCartTotal();
        });

        //

        // 2. Thêm JavaScript function vào cuối script tag:
        function proceedToCheckout() {
            // Kiểm tra giỏ hàng có sản phẩm không
            const cartItems = document.querySelectorAll('.cart-item');
            if (cartItems.length === 0) {
                alert('Giỏ hàng của bạn đang trống!');
                return;
            }

            // Thu thập thông tin đơn hàng
            const orderData = {
                items: [],
                subtotal: 0,
                shipping: 30000,
                discount: 0,
                total: 0
            };

            // Lấy thông tin từng sản phẩm
            cartItems.forEach(item => {
                const productName = item.querySelector('.product-title').textContent.trim();
                const productSpecs = item.querySelector('.product-specs').textContent.trim();
                const quantity = parseInt(item.querySelector('.quantity-input').value);
                const unitPrice = parseInt(item.dataset.price);
                const totalPrice = unitPrice * quantity;

                orderData.items.push({
                    name: productName,
                    specs: productSpecs,
                    quantity: quantity,
                    unitPrice: unitPrice,
                    totalPrice: totalPrice
                });

                orderData.subtotal += totalPrice;
            });

            // Tính tổng tiền
            const discountText = document.getElementById('discount').textContent;
            const discountAmount = parseInt(discountText.replace(/[^\d]/g, '')) || 0;
            orderData.discount = discountAmount;
            orderData.total = orderData.subtotal + orderData.shipping - orderData.discount;

            // Lưu vào sessionStorage để truyền sang trang thanh toán
            sessionStorage.setItem('orderData', JSON.stringify(orderData));

            // Chuyển đến trang thanh toán
            window.location.href = '/checkout'; // Thay bằng route thanh toán của bạn
        }

        // 3. Thêm animation loading cho nút checkout:
        function addCheckoutLoading() {
            const checkoutBtn = document.querySelector('.checkout-btn');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Đang xử lý...';
                    this.disabled = true;

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 2000);
                });
            }
        }

        // 4. CSS bổ sung cho animation (thêm vào style tag):
        /*
        .checkout-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: text-bottom;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }
        */

        // 5. Khởi tạo khi trang load
        document.addEventListener('DOMContentLoaded', function() {
            addCheckoutLoading();

            // Kiểm tra nếu có dữ liệu order từ trang trước
            const savedOrderData = sessionStorage.getItem('orderData');
            if (savedOrderData) {
                console.log('Order data from cart:', JSON.parse(savedOrderData));
            }
        });

        // 6. Validation form trước khi checkout
        function validateCartBeforeCheckout() {
            const cartItems = document.querySelectorAll('.cart-item');
            let isValid = true;
            let errors = [];

            if (cartItems.length === 0) {
                errors.push('Giỏ hàng đang trống');
                isValid = false;
            }

            cartItems.forEach((item, index) => {
                const quantity = parseInt(item.querySelector('.quantity-input').value);
                const productName = item.querySelector('.product-title').textContent.trim();

                if (quantity < 1) {
                    errors.push(`Số lượng ${productName} không hợp lệ`);
                    isValid = false;
                }
            });

            if (!isValid) {
                alert('Lỗi:\n' + errors.join('\n'));
            }

            return isValid;
        }
    </script>

@stop
