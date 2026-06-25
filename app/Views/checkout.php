<?php include __DIR__ . '/partials/header.php'; ?>

<style>
.checkout-page { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; font-family: var(--font-body); }
.checkout-header { font-size: 2.5rem; font-family: var(--font-heading); text-transform: uppercase; letter-spacing: 2px; margin-bottom: 2rem; }
.checkout-layout { display: flex; gap: 4rem; }
.checkout-form-section { flex: 1.5; }
.checkout-summary-section { flex: 1; background: #f9f9f9; padding: 2rem; border-radius: 8px; align-self: flex-start; position: sticky; top: 20px; }

.form-group { margin-bottom: 1.5rem; }
.form-group label { display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.95rem; }
.form-control { width: 100%; padding: 0.8rem 1rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; font-family: var(--font-body); }
.form-control:focus { outline: none; border-color: #111; }
.form-row { display: flex; gap: 1rem; }
.form-row > .form-group { flex: 1; }

.section-title { font-family: var(--font-heading); font-size: 1.5rem; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 1.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eee; }

.payment-methods { display: flex; flex-direction: column; gap: 1rem; }
.payment-method { border: 1px solid #ddd; border-radius: 4px; padding: 1rem; cursor: pointer; display: flex; align-items: center; gap: 1rem; transition: border-color 0.2s; }
.payment-method:hover { border-color: #111; }
.payment-method input[type="radio"] { margin: 0; width: 1.2rem; height: 1.2rem; cursor: pointer; }
.payment-method label { margin: 0; cursor: pointer; font-weight: 500; flex: 1; }
.payment-method.active { border-color: #111; background: #fafafa; }

.summary-item { display: flex; gap: 1rem; margin-bottom: 1rem; }
.summary-item img { width: 60px; height: 60px; object-fit: contain; background: #fff; border-radius: 4px; border: 1px solid #eee; }
.summary-item-info { flex: 1; }
.summary-item-name { font-weight: 500; font-size: 0.95rem; margin-bottom: 0.2rem; }
.summary-item-qty { color: #666; font-size: 0.85rem; }
.summary-item-price { font-weight: 600; }

.summary-row { display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 0.95rem; }
.summary-total { display: flex; justify-content: space-between; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #ddd; font-weight: 700; font-size: 1.2rem; }

.btn-place-order { width: 100%; padding: 1.2rem; background: #111; color: #fff; border: none; border-radius: 100px; font-size: 1.1rem; font-weight: 500; cursor: pointer; margin-top: 2rem; transition: background 0.2s; }
.btn-place-order:hover { background: #333; }

@media (max-width: 900px) {
    .checkout-layout { flex-direction: column; }
    .checkout-summary-section { position: static; }
    .form-row { flex-direction: column; gap: 0; }
}
</style>

<div class="checkout-page">
    <h1 class="checkout-header">Thanh toán</h1>
    
    <div class="checkout-layout">
        <form class="checkout-form-section" id="checkoutForm" onsubmit="handleCheckout(event)">
            
            <h2 class="section-title">Thông tin giao hàng</h2>
            
            <div class="form-group">
                <label for="fullName">Họ và tên *</label>
                <input type="text" id="fullName" class="form-control" required placeholder="Nhập họ và tên">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Số điện thoại *</label>
                    <input type="tel" id="phone" class="form-control" required placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Nhập địa chỉ email (tuỳ chọn)">
                </div>
            </div>
            
            <div class="form-group">
                <label for="address">Địa chỉ chi tiết *</label>
                <input type="text" id="address" class="form-control" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố">
            </div>
            
            <div class="form-group">
                <label for="note">Ghi chú đơn hàng (Tuỳ chọn)</label>
                <textarea id="note" class="form-control" rows="3" placeholder="Ghi chú thêm về đơn hàng, thời gian giao hàng..."></textarea>
            </div>

            <h2 class="section-title" style="margin-top: 3rem;">Phương thức thanh toán</h2>
            <div class="payment-methods">
                <div class="payment-method active" onclick="selectPayment(this)">
                    <input type="radio" name="payment" id="pay_cod" value="cod" checked>
                    <label for="pay_cod">Thanh toán khi nhận hàng (COD)</label>
                </div>
                <div class="payment-method" onclick="selectPayment(this)">
                    <input type="radio" name="payment" id="pay_bank" value="bank">
                    <label for="pay_bank">Chuyển khoản ngân hàng</label>
                </div>
                <div class="payment-method" onclick="selectPayment(this)">
                    <input type="radio" name="payment" id="pay_momo" value="momo">
                    <label for="pay_momo">Thanh toán qua ví MoMo</label>
                </div>
            </div>

            <button type="submit" class="btn-place-order">Hoàn tất đặt hàng</button>
        </form>

        <div class="checkout-summary-section">
            <h2 class="section-title">Tóm tắt đơn hàng</h2>
            <div id="checkoutItems">
                <!-- Items will be injected here -->
            </div>
            
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #ddd;">
                <div class="summary-row">
                    <span>Tạm tính</span>
                    <span id="checkoutSubtotal">0 ₫</span>
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển</span>
                    <span>Miễn phí</span>
                </div>
                <div class="summary-total">
                    <span>Tổng cộng</span>
                    <span id="checkoutTotal">0 ₫</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let checkoutCart = JSON.parse(localStorage.getItem('paceup_cart')) || [];

document.addEventListener('DOMContentLoaded', () => {
    if (checkoutCart.length === 0) {
        alert('Giỏ hàng của bạn đang trống!');
        window.location.href = BASE_URL + 'shop';
        return;
    }
    renderCheckoutSummary();
});

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + ' ₫';
}

function renderCheckoutSummary() {
    const itemsContainer = document.getElementById('checkoutItems');
    let total = 0;
    
    itemsContainer.innerHTML = checkoutCart.map(item => {
        const itemTotal = item.price * item.qty;
        total += itemTotal;
        const imgUrl = item.image.startsWith('http') ? item.image : BASE_URL + item.image;
        return `
            <div class="summary-item">
                <img src="${imgUrl}" alt="${item.name}" onerror="this.src='${item.image}'">
                <div class="summary-item-info">
                    <div class="summary-item-name">${item.name}</div>
                    <div class="summary-item-qty">SL: ${item.qty}</div>
                </div>
                <div class="summary-item-price">${formatPrice(itemTotal)}</div>
            </div>
        `;
    }).join('');
    
    document.getElementById('checkoutSubtotal').textContent = formatPrice(total);
    document.getElementById('checkoutTotal').textContent = formatPrice(total);
}

function selectPayment(element) {
    document.querySelectorAll('.payment-method').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    element.querySelector('input').checked = true;
}

function handleCheckout(e) {
    e.preventDefault();
    
    // In a real app, send data to server here.
    // For now, we simulate success and clear cart.
    
    localStorage.removeItem('paceup_cart');
    
    // Redirect to success page
    window.location.href = BASE_URL + 'checkout-success';
}
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>