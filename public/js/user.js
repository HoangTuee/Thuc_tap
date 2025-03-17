 // Cập nhật số lượng
 function updateQuantity(button, change) {
    const input = button.parentNode.querySelector('.quantity-input');
    let newValue = parseInt(input.value) + change;
    if(newValue < 1) newValue = 1;
    input.value = newValue;
    calculateTotal();
}

// Xóa sản phẩm
function removeItem(button) {
    const item = button.closest('.cart-item');
    item.remove();
    calculateTotal();
}

// Tính toán tổng tiền
function calculateTotal() {
    let subtotal = 0;
    const items = document.querySelectorAll('.cart-item');

    items.forEach(item => {
        const price = parseFloat(item.querySelector('h5').textContent.replace(/[^\d.]/g, ''));
        const quantity = parseInt(item.querySelector('.quantity-input').value);
        subtotal += price * quantity;
    });

    const shipping = 30000;
    const total = subtotal + shipping;

    document.getElementById('subtotal').textContent = formatCurrency(subtotal);
    document.getElementById('total-amount').textContent = formatCurrency(total);
}

// Định dạng tiền tệ
function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(amount);
}

// Tính tổng ban đầu
calculateTotal();
