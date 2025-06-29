function updateQuantity(btn, change) {
    const input = btn.parentElement.querySelector(".quantity-input");
    const currentValue = parseInt(input.value);
    const newValue = Math.max(1, currentValue + change);

    input.value = newValue;
    updateItemPrice(input);
    updateCartTotal();

    // Gửi AJAX request để cập nhật database (tuỳ chọn)
    updateCartDatabase(input.dataset.id, newValue);
}

function updateItemPrice(input) {
    const cartItem = input.closest(".cart-item");
    const basePrice = parseInt(cartItem.dataset.price);
    const quantity = parseInt(input.value);
    const priceElement = cartItem.querySelector(".price");
    const newPrice = basePrice * quantity;

    priceElement.textContent = newPrice.toLocaleString() + "₫";
}

function updateCartTotal() {
    let subtotal = 0;

    document.querySelectorAll(".cart-item").forEach((item) => {
        const basePrice = parseInt(item.dataset.price);
        const quantity = parseInt(item.querySelector(".quantity-input").value);
        subtotal += basePrice * quantity;
    });

    const shipping = 30000;
    const discount = 0;
    const total = subtotal + shipping - discount;

    document.getElementById("subtotal").textContent =
        subtotal.toLocaleString() + "₫";
    document.getElementById("total-amount").textContent =
        total.toLocaleString() + "₫";
}

function updateCartDatabase(itemId, quantity) {
    fetch(`/cart/update/${itemId}`, {
        // URL khớp với route
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            quantity: quantity,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                return response.json().then((errData) => {
                    throw new Error(
                        errData.message || `Lỗi HTTP: ${response.status}`
                    );
                });
            }
            return response.json();
        })
        .then((data) => {
            if (data.success) {
                console.log("Server response:", data.data); // Kiểm tra dữ liệu server trả về

                // Cập nhật giá của item hiện tại
                const currentItemInput = document.querySelector(
                    `.quantity-input[data-id="${data.data.item_id}"]`
                );
                if (currentItemInput) {
                    const cartItemRow = currentItemInput.closest(".cart-item");
                    const priceElement = cartItemRow.querySelector(".price");
                    priceElement.textContent =
                        data.data.item_total_price.toLocaleString() + "₫";
                }

                // Cập nhật tổng tiền và các thông tin khác từ server
                document.getElementById("subtotal").textContent =
                    data.data.subtotal.toLocaleString() + "₫";
                document.getElementById("shipping").textContent =
                    data.data.shipping.toLocaleString() + "₫";
                document.getElementById("discount").textContent =
                    (data.data.discount > 0 ? "-" : "") +
                    data.data.discount.toLocaleString() +
                    "₫";
                document.getElementById("total-amount").textContent =
                    data.data.total.toLocaleString() + "₫";

                // Cập nhật badge số lượng
                const badge = document.querySelector(".badge-count");
                if (badge && data.data.cart_count !== undefined) {
                    badge.textContent = data.data.cart_count + " sản phẩm";
                }
                // Thông báo thành công (tùy chọn, có thể dùng thư viện toast)
                // alert(data.message);
            } else {
                alert(data.message || "Có lỗi xảy ra khi cập nhật giỏ hàng!");
                // Có thể rollback giá trị input ở đây nếu muốn
                // Hoặc gọi updateCartTotal() để tính lại theo giá trị input hiện tại (sau khi user sửa)
                updateCartTotal(); // Tính lại tổng cục bộ nếu server báo lỗi nhưng client vẫn muốn giữ thay đổi tạm thời
            }
        })
        .catch((error) => {
            console.error("Error updating cart:", error);
            alert("Lỗi phía client hoặc mạng: " + error.message);
            updateCartTotal(); // Tính lại tổng cục bộ
        });
}

function applyCoupon() {
    const couponCode = document.getElementById("couponCode").value.trim();
    if (couponCode) {
        // AJAX call để áp dụng mã giảm giá
        fetch("/cart/apply-coupon", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ coupon_code: couponCode }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    document.getElementById("discount").textContent =
                        "-" + data.discount.toLocaleString() + "₫";
                    updateCartTotal();
                    alert("Mã giảm giá đã được áp dụng!");
                } else {
                    alert("Mã giảm giá không hợp lệ!");
                }
            })
            .catch((error) => {
                console.error("Error applying coupon:", error);
            });
    }
}

// Auto-update totals when page loads
document.addEventListener("DOMContentLoaded", function () {
    updateCartTotal();
});
