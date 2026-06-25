<?php include __DIR__ . '/partials/header.php'; ?>

<?php
$gender = isset($_GET['gender']) ? $_GET['gender'] : 'all';
$genderLabel = 'Tất cả sản phẩm';
if ($gender === 'men') $genderLabel = 'Sản phẩm Nam';
if ($gender === 'women') $genderLabel = 'Sản phẩm Nữ';

// Controllers provide $products and $categories

$category = $_GET['category'] ?? 'all';
$sort = $_GET['sort'] ?? 'default';
$priceRange = $_GET['price'] ?? 'all'; // all | lt3 | 3to5 | gt5

// Helper: build URL keeping other params
function shopUrl(array $overrides): string {
    $params = array_merge($_GET, $overrides);
    return 'shop.php?' . http_build_query($params);
}
?>

<main>
    <section class="shop-page">
        <div class="shop-topbar">
            <h1><?= htmlspecialchars($genderLabel) ?> (<?= count($products) ?>)</h1>
            <div class="shop-sort">
                <form method="get" action="<?= BASE_URL ?>shop" id="sortForm">
                    <input type="hidden" name="gender" value="<?= htmlspecialchars($gender) ?>">
                    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($priceRange) ?>">
                    <label for="sortSel">Sắp xếp</label>
                    <select name="sort" id="sortSel" onchange="this.form.submit()">
                        <option value="default" <?= $sort === 'default' ? 'selected' : '' ?>>Mặc định</option>
                        <option value="price-asc" <?= $sort === 'price-asc' ? 'selected' : '' ?>>Giá: Thấp → Cao</option>
                        <option value="price-desc" <?= $sort === 'price-desc' ? 'selected' : '' ?>>Giá: Cao → Thấp</option>
                        <option value="name-asc" <?= $sort === 'name-asc' ? 'selected' : '' ?>>Tên: A → Z</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="shop-layout">
            <aside class="shop-sidebar">
                <ul class="filter-cat-list">
                    <li><a href="<?= htmlspecialchars(shopUrl(['category' => 'all'])) ?>" class="<?= $category === 'all' ? 'active' : '' ?>">Tất cả</a></li>
                    <?php foreach ($categories as $c): ?>
                        <li><a href="<?= htmlspecialchars(shopUrl(['category' => $c['name']])) ?>" class="<?= $category === $c['name'] ? 'active' : '' ?>"><?= htmlspecialchars($c['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <details class="filter-group" <?= $gender !== 'all' ? 'open' : '' ?>>
                    <summary>Giới tính</summary>
                    <ul>
                        <li><a href="<?= htmlspecialchars(shopUrl(['gender' => 'all'])) ?>" class="<?= $gender === 'all' ? 'active' : '' ?>">Tất cả</a></li>
                        <li><a href="<?= htmlspecialchars(shopUrl(['gender' => 'men'])) ?>" class="<?= $gender === 'men' ? 'active' : '' ?>">Nam</a></li>
                        <li><a href="<?= htmlspecialchars(shopUrl(['gender' => 'women'])) ?>" class="<?= $gender === 'women' ? 'active' : '' ?>">Nữ</a></li>
                    </ul>
                </details>

                <details class="filter-group" <?= $priceRange !== 'all' ? 'open' : '' ?>>
                    <summary>Giá</summary>
                    <ul>
                        <li><a href="<?= htmlspecialchars(shopUrl(['price' => 'all'])) ?>" class="<?= $priceRange === 'all' ? 'active' : '' ?>">Tất cả</a></li>
                        <li><a href="<?= htmlspecialchars(shopUrl(['price' => 'lt3'])) ?>" class="<?= $priceRange === 'lt3' ? 'active' : '' ?>">Dưới 3.000.000 ₫</a></li>
                        <li><a href="<?= htmlspecialchars(shopUrl(['price' => '3to5'])) ?>" class="<?= $priceRange === '3to5' ? 'active' : '' ?>">3.000.000 – 5.000.000 ₫</a></li>
                        <li><a href="<?= htmlspecialchars(shopUrl(['price' => 'gt5'])) ?>" class="<?= $priceRange === 'gt5' ? 'active' : '' ?>">Trên 5.000.000 ₫</a></li>
                    </ul>
                </details>
            </aside>

            <div class="shop-grid">
                <?php foreach ($products as $index => $product): ?>
                <div class="shop-product-card" data-index="<?= $index ?>">
                    <a href="<?= BASE_URL ?>product?id=<?= $product['id'] ?>" class="product-img-wrapper">
                        <img src="<?= BASE_URL ?>assets/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="product-actions" onclick="event.preventDefault(); event.stopPropagation()">
                            <button class="btn-add-cart" onclick="addToCart('<?= htmlspecialchars(addslashes($product['name'])) ?>', <?= $product['price'] ?>, 'assets/images/<?= htmlspecialchars($product['image']) ?>')">
                                Thêm vào giỏ
                            </button>
                            <button class="btn-quick-view" onclick="openQuickView(<?= $index ?>)">Xem nhanh</button>
                        </div>
                    </a>
                    <a href="<?= BASE_URL ?>product?id=<?= $product['id'] ?>" class="product-info">
                        <span class="product-name"><?= htmlspecialchars($product['name']) ?></span>
                        <span class="product-type"><?= htmlspecialchars($product['type']) ?></span>
                        <span class="product-price"><?= number_format($product['price'], 0, ',', '.') ?> ₫</span>
                    </a>
                </div>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                    <p class="shop-empty">Không có sản phẩm phù hợp bộ lọc.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<!-- Cart Sidebar -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>
<div class="cart-sidebar" id="cartSidebar">
    <div class="cart-sidebar-header">
        <h3>Giỏ hàng (<span id="cartCount">0</span>)</h3>
        <button class="cart-close-btn" onclick="toggleCart()">✕</button>
    </div>
    <div class="cart-items" id="cartItems">
        <div class="cart-empty" id="cartEmpty">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            <p>Giỏ hàng trống</p>
        </div>
    </div>
    <div class="cart-footer">
        <div class="cart-total">
            <span class="label">Tổng cộng</span>
            <span class="amount" id="cartTotal">0 ₫</span>
        </div>
        <button class="btn-checkout" onclick="checkout()">Thanh toán</button>
    </div>
</div>

<!-- Quick View Modal -->
<div class="modal-overlay" id="modalOverlay" onclick="closeQuickView()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeQuickView()">✕</button>
        <div class="modal-img">
            <img id="modalImg" src="" alt="">
        </div>
        <div class="modal-details">
            <h2 id="modalName"></h2>
            <p class="modal-category" id="modalCategory"></p>
            <p class="modal-price" id="modalPrice"></p>
            <p class="modal-desc">Sản phẩm Nike chính hãng 100%. Cam kết chất lượng và bảo hành đầy đủ. Miễn phí vận chuyển cho đơn hàng trên 1.000.000 ₫.</p>
            <div class="modal-size-select">
                <label>Chọn size</label>
                <div class="size-options">
                    <button class="size-btn" onclick="selectSize(this)">38</button>
                    <button class="size-btn" onclick="selectSize(this)">39</button>
                    <button class="size-btn" onclick="selectSize(this)">40</button>
                    <button class="size-btn selected" onclick="selectSize(this)">41</button>
                    <button class="size-btn" onclick="selectSize(this)">42</button>
                    <button class="size-btn" onclick="selectSize(this)">43</button>
                    <button class="size-btn" onclick="selectSize(this)">44</button>
                </div>
            </div>
            <button class="btn-add-cart-modal" id="modalAddBtn">Thêm vào giỏ hàng</button>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"></div>

<script>
// Product data for JS (from PHP)
const productsData = <?= json_encode(array_values($products), JSON_UNESCAPED_UNICODE) ?>;

// ===== QUICK VIEW MODAL =====
function openQuickView(index) {
    const product = productsData.find((_, i) => i === index) || productsData[index];
    if (!product) return;

    document.getElementById('modalImg').src = BASE_URL + 'assets/images/' + product.image;
    document.getElementById('modalImg').alt = product.name;
    document.getElementById('modalName').textContent = product.name;
    document.getElementById('modalCategory').textContent = product.type;
    document.getElementById('modalPrice').textContent = formatPrice(product.price);

    const addBtn = document.getElementById('modalAddBtn');
    addBtn.onclick = () => {
        addToCart(product.name, product.price, 'assets/images/' + product.image);
        closeQuickView();
    };

    document.getElementById('modalOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeQuickView() {
    document.getElementById('modalOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

function selectSize(btn) {
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
}

// ===== CART SYSTEM (localStorage) =====
let cart = JSON.parse(localStorage.getItem('paceup_cart')) || [];

function saveCart() {
    localStorage.setItem('paceup_cart', JSON.stringify(cart));
    updateCartUI();
}

function addToCart(name, price, image) {
    const existing = cart.find(item => item.name === name);
    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({ name, price, image, qty: 1 });
    }
    saveCart();
    showToast('Đã thêm vào giỏ hàng!');
    toggleCart(true);
}

function removeFromCart(index) {
    cart.splice(index, 1);
    saveCart();
}

function updateQty(index, delta) {
    cart[index].qty += delta;
    if (cart[index].qty <= 0) {
        cart.splice(index, 1);
    }
    saveCart();
}

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + ' ₫';
}

function updateCartUI() {
    const cartItems = document.getElementById('cartItems');
    const cartCount = document.getElementById('cartCount');
    const cartTotal = document.getElementById('cartTotal');

    const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

    cartCount.textContent = totalItems;
    cartTotal.textContent = formatPrice(totalPrice);

    // Update badge
    document.querySelectorAll('.cart-badge').forEach(b => {
        b.textContent = totalItems;
        b.style.display = totalItems > 0 ? 'flex' : 'none';
    });

    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div class="cart-empty">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                <p>Giỏ hàng trống</p>
            </div>`;
    } else {
        cartItems.innerHTML = cart.map((item, i) => `
            <div class="cart-item">
                <img src="${item.image.startsWith('http') ? item.image : BASE_URL + item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <div class="item-name">${item.name}</div>
                    <div class="item-price">${formatPrice(item.price)}</div>
                    <div class="cart-item-qty">
                        <button onclick="updateQty(${i}, -1)">−</button>
                        <span>${item.qty}</span>
                        <button onclick="updateQty(${i}, 1)">+</button>
                    </div>
                </div>
                <button class="cart-item-remove" onclick="removeFromCart(${i})">✕</button>
            </div>
        `).join('');
    }
}

function toggleCart(forceOpen) {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('cartOverlay');
    if (forceOpen === true) {
        sidebar.classList.add('active');
        overlay.classList.add('active');
    } else {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
}

function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2500);
}

function checkout() {
    if (cart.length === 0) {
        showToast('Giỏ hàng trống!');
        return;
    }
    window.location.href = BASE_URL + 'checkout';
}

// Init
document.addEventListener('DOMContentLoaded', () => {
    updateCartUI();

    // Attach cart toggle to cart icon
    const cartIcon = document.querySelector('a[href="<?= BASE_URL ?>cart"]');
    if (cartIcon) {
        cartIcon.addEventListener('click', (e) => {
            e.preventDefault();
            toggleCart();
        });
        // Check if badge already exists (added by header.php)
        if (!cartIcon.querySelector('.cart-badge')) {
            const badge = document.createElement('span');
            badge.className = 'cart-badge';
            badge.style.display = 'none';
            badge.textContent = '0';
            cartIcon.appendChild(badge);
        }
        updateCartUI();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeQuickView();
        toggleCart();
    }
});
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>
