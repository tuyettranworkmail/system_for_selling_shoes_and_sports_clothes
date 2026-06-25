<?php include __DIR__ . '/partials/header.php'; ?>

<?php
$gender = isset($_GET['gender']) ? $_GET['gender'] : 'all';
$genderLabel = 'Tất cả sản phẩm';
if ($gender === 'men') $genderLabel = 'Sản phẩm Nam';
if ($gender === 'women') $genderLabel = 'Sản phẩm Nữ';

// Product data - hardcoded based on available images
$allProducts = [
    // === MEN'S PRODUCTS ===
    ['name' => 'Air Zoom Pegasus 42 Wide', 'image' => 'AIR+ZOOM+PEGASUS+42+WIDE.avif', 'price' => 3800000, 'type' => 'Giày chạy bộ Nam', 'gender' => 'men', 'category' => 'Running'],
    ['name' => 'Nike SB Dunk Low Pro', 'image' => 'NIKE+SB+DUNK+LOW+PRO.avif', 'price' => 4200000, 'type' => 'Giày Skateboarding Nam', 'gender' => 'men', 'category' => 'Skateboarding'],
    ['name' => 'Nike Air Max Moto 2K', 'image' => 'NIKE+AIR+MAX+MOTO+2K.avif', 'price' => 3500000, 'type' => 'Giày Lifestyle Nam', 'gender' => 'men', 'category' => 'Lifestyle'],
    ['name' => 'Vapor 17 Pro FG', 'image' => 'VAPOR+17+PRO+FG.avif', 'price' => 4500000, 'type' => 'Giày đá bóng Nam', 'gender' => 'men', 'category' => 'Football'],
    ['name' => 'Giannis Freak 7 EP', 'image' => 'GIANNIS+FREAK+7+EP.avif', 'price' => 4800000, 'type' => 'Giày bóng rổ Nam', 'gender' => 'men', 'category' => 'Basketball'],
    ['name' => 'Nike Court Lite 4', 'image' => 'M+NIKE+COURT+LITE+4.avif', 'price' => 2200000, 'type' => 'Giày tennis Nam', 'gender' => 'men', 'category' => 'Tennis'],
    ['name' => 'Nike Metcon 10', 'image' => 'M+NIKE+METCON+10.avif', 'price' => 3600000, 'type' => 'Giày Training Nam', 'gender' => 'men', 'category' => 'Training'],
    ['name' => 'Nike Vapor Lite 3 HC', 'image' => 'M+VAPOR+LITE+3+HC.avif', 'price' => 2800000, 'type' => 'Giày tennis Nam', 'gender' => 'men', 'category' => 'Tennis'],
    ['name' => 'Nike Air Max Cirro Slide', 'image' => 'NIKE+AIR+MAX+CIRRO+SLIDE.avif', 'price' => 1800000, 'type' => 'Dép Nam', 'gender' => 'men', 'category' => 'Slide'],
    ['name' => 'Nike P-6000', 'image' => 'NIKE+P-6000.avif', 'price' => 3200000, 'type' => 'Giày Lifestyle Nam', 'gender' => 'men', 'category' => 'Lifestyle'],
    ['name' => 'Nike ReactX Rejuven8 Slide', 'image' => 'NIKE+REACTX+REJUVEN8+SLIDE.avif', 'price' => 2100000, 'type' => 'Dép Nam', 'gender' => 'men', 'category' => 'Slide'],
    ['name' => 'Nike SB Chron 2 Canvas', 'image' => 'NIKE+SB+CHRON+2+CNVS.avif', 'price' => 2000000, 'type' => 'Giày Skateboarding Nam', 'gender' => 'men', 'category' => 'Skateboarding'],
    ['name' => 'Nike SB Zoom Blazer Mid', 'image' => 'NIKE+SB+ZOOM+BLAZER+MID.avif', 'price' => 2900000, 'type' => 'Giày Skateboarding Nam', 'gender' => 'men', 'category' => 'Skateboarding'],
    ['name' => 'Nike Zoom Vomero 5 SE', 'image' => 'NIKE+ZOOM+VOMERO+5+SE.avif', 'price' => 4100000, 'type' => 'Giày chạy bộ Nam', 'gender' => 'men', 'category' => 'Running'],
    ['name' => 'Phantom 6 High Acad FG/MG', 'image' => 'PHANTOM+6+HIGH+ACAD+FG_MG.avif', 'price' => 2600000, 'type' => 'Giày đá bóng Nam', 'gender' => 'men', 'category' => 'Football'],
    ['name' => 'Sabrina 3 EP', 'image' => 'SABRINA+3+EP.avif', 'price' => 3900000, 'type' => 'Giày bóng rổ Nam', 'gender' => 'men', 'category' => 'Basketball'],
    ['name' => 'Tiempo Maestro Elite FG SE', 'image' => 'TIEMPO+MAESTRO+ELITE+FG+SE.avif', 'price' => 6500000, 'type' => 'Giày đá bóng Nam', 'gender' => 'men', 'category' => 'Football'],
    ['name' => 'Tiempo Maestro Elite FG T', 'image' => 'TIEMPO+MAESTRO+ELITE+FG+T.avif', 'price' => 6200000, 'type' => 'Giày đá bóng Nam', 'gender' => 'men', 'category' => 'Football'],
    ['name' => 'Air Jordan 1 Low G SPK', 'image' => 'AIR+JORDAN+1+LOW+G+SPK.avif', 'price' => 4500000, 'type' => 'Giày Golf Nam', 'gender' => 'men', 'category' => 'Golf'],
    ['name' => 'Air Jordan Mule', 'image' => 'AIR+JORDAN+MULE.avif', 'price' => 3100000, 'type' => 'Giày Lifestyle Nam', 'gender' => 'men', 'category' => 'Lifestyle'],
    ['name' => 'Victory Pro 4', 'image' => 'VICTORY+PRO+4.avif', 'price' => 3800000, 'type' => 'Giày Golf Nam', 'gender' => 'men', 'category' => 'Golf'],
    ['name' => 'Victory Tour 4', 'image' => 'VICTORY+TOUR+4.avif', 'price' => 4600000, 'type' => 'Giày Golf Nam', 'gender' => 'men', 'category' => 'Golf'],
    ['name' => 'Waffle Racer SE', 'image' => 'WAFFLE+RACER+SE.avif', 'price' => 3400000, 'type' => 'Giày Lifestyle Nam', 'gender' => 'men', 'category' => 'Lifestyle'],

    // === WOMEN'S PRODUCTS ===
    ['name' => 'Nike Air Max Moto 2K', 'image' => 'W+NIKE+AIR+MAX+MOTO+2K.avif', 'price' => 3500000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Nike Cortez', 'image' => 'W+NIKE+CORTEZ.avif', 'price' => 2800000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Nike Metcon 10', 'image' => 'W+NIKE+METCON+10.avif', 'price' => 3600000, 'type' => 'Giày Training Nữ', 'gender' => 'women', 'category' => 'Training'],
    ['name' => 'Nike P-6000', 'image' => 'W+NIKE+P-6000.avif', 'price' => 3200000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Nike Reax 8 NSW SL', 'image' => 'W+NIKE+REAX+8+NSW+SL.avif', 'price' => 2500000, 'type' => 'Giày Training Nữ', 'gender' => 'women', 'category' => 'Training'],
    ['name' => 'Air Jordan 1 Low SE APLA', 'image' => 'WMNS+AIR+JORDAN+1+LOW+SE+APLA.avif', 'price' => 3900000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Air Jordan 1 Low SE', 'image' => 'WMNS+AIR+JORDAN+1+LOW+SE.avif', 'price' => 3600000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Jordan Flight Court', 'image' => 'WMNS+JORDAN+FLIGHT+COURT.avif', 'price' => 3300000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Nike Air Rift Neo', 'image' => 'WMNS+NIKE+AIR++RIFT+NEO.avif', 'price' => 3100000, 'type' => 'Giày Lifestyle Nữ', 'gender' => 'women', 'category' => 'Lifestyle'],
    ['name' => 'Nike Court Legacy NN', 'image' => 'WMNS+NIKE+COURT+LEGACY+NN.avif', 'price' => 2200000, 'type' => 'Giày Tennis Nữ', 'gender' => 'women', 'category' => 'Tennis'],
    ['name' => 'Nike Motiva 2', 'image' => 'WMNS+NIKE+MOTIVA+2.avif', 'price' => 3400000, 'type' => 'Giày chạy bộ Nữ', 'gender' => 'women', 'category' => 'Running'],
    ['name' => 'Nike ReactX Rejuven8', 'image' => 'WMNS+NIKE+REACTX+REJUVEN8.avif', 'price' => 2100000, 'type' => 'Dép Nữ', 'gender' => 'women', 'category' => 'Slide'],
];

// Keep original index as stable product id
foreach ($allProducts as $i => &$p) { $p['id'] = $i; }
unset($p);

// Filters from query
$category = $_GET['category'] ?? 'all';
$sort = $_GET['sort'] ?? 'default';
$priceRange = $_GET['price'] ?? 'all'; // all | lt3 | 3to5 | gt5

$products = array_filter($allProducts, function ($p) use ($gender, $category, $priceRange) {
    if ($gender !== 'all' && $p['gender'] !== $gender) return false;
    if ($category !== 'all' && $p['category'] !== $category) return false;
    if ($priceRange === 'lt3' && !($p['price'] < 3000000)) return false;
    if ($priceRange === '3to5' && !($p['price'] >= 3000000 && $p['price'] <= 5000000)) return false;
    if ($priceRange === 'gt5' && !($p['price'] > 5000000)) return false;
    return true;
});

// Sort
$products = array_values($products);
usort($products, function ($a, $b) use ($sort) {
    return match ($sort) {
        'price-asc'  => $a['price'] <=> $b['price'],
        'price-desc' => $b['price'] <=> $a['price'],
        'name-asc'   => strcmp($a['name'], $b['name']),
        default      => 0,
    };
});

// Unique categories for filter dropdown (within current gender)
$catSource = array_filter($allProducts, fn($p) => $gender === 'all' || $p['gender'] === $gender);
$categories = array_values(array_unique(array_map(fn($p) => $p['category'], $catSource)));
sort($categories);

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
                        <li><a href="<?= htmlspecialchars(shopUrl(['category' => $c])) ?>" class="<?= $category === $c ? 'active' : '' ?>"><?= htmlspecialchars($c) ?></a></li>
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
