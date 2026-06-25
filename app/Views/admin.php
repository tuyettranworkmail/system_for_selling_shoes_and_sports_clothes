<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
include __DIR__ . '/partials/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<div class="admin-container">
    <aside class="admin-sidebar">
        <ul>
            <li><a href="?page=dashboard" class="<?= $page === 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="?page=products" class="<?= $page === 'products' ? 'active' : '' ?>">Sản phẩm</a></li>
            <li><a href="?page=orders" class="<?= $page === 'orders' ? 'active' : '' ?>">Đơn hàng</a></li>
            <li><a href="?page=users" class="<?= $page === 'users' ? 'active' : '' ?>">Người dùng</a></li>
            <li><a href="?page=settings" class="<?= $page === 'settings' ? 'active' : '' ?>">Cài đặt</a></li>
        </ul>
    </aside>

    <main class="admin-content">
        <?php if ($page === 'dashboard'): ?>
            <div class="admin-header" style="border-bottom: 1px solid #eee; padding-bottom: 1rem; margin-bottom: 2rem; background: transparent; box-shadow: none;">
                <div>
                    <h2 style="font-size: 2rem; letter-spacing: 1px;">Dashboard</h2>
                    <p style="color: #666; font-family: var(--font-ui); font-size: 0.95rem;">Xin chào Admin, đây là tổng quan hoạt động kinh doanh hôm nay.</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                <!-- Card 1: Doanh thu -->
                <div style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 1rem; border: 1px solid #f0f0f0;">
                    <div style="background: #E8F5E9; color: #4CAF50; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <div>
                        <div style="color: #888; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; font-family: var(--font-ui); margin-bottom: 0.2rem;">Tổng doanh thu</div>
                        <div style="font-size: 1.6rem; font-weight: 800; font-family: var(--font-ui); color: #111;">24.500.000 ₫</div>
                        <div style="color: #4CAF50; font-size: 0.8rem; font-weight: 500; margin-top: 0.2rem;">+12% so với tháng trước</div>
                    </div>
                </div>

                <!-- Card 2: Đơn hàng -->
                <div style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 1rem; border: 1px solid #f0f0f0;">
                    <div style="background: #E3F2FD; color: #2196F3; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0"></path></svg>
                    </div>
                    <div>
                        <div style="color: #888; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; font-family: var(--font-ui); margin-bottom: 0.2rem;">Đơn hàng mới</div>
                        <div style="font-size: 1.6rem; font-weight: 800; font-family: var(--font-ui); color: #111;">48</div>
                        <div style="color: #2196F3; font-size: 0.8rem; font-weight: 500; margin-top: 0.2rem;">+5% so với tháng trước</div>
                    </div>
                </div>

                <!-- Card 3: Khách hàng -->
                <div style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 1rem; border: 1px solid #f0f0f0;">
                    <div style="background: #F3E5F5; color: #9C27B0; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 7a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div>
                        <div style="color: #888; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; font-family: var(--font-ui); margin-bottom: 0.2rem;">Khách hàng</div>
                        <div style="font-size: 1.6rem; font-weight: 800; font-family: var(--font-ui); color: #111;">1,024</div>
                        <div style="color: #9C27B0; font-size: 0.8rem; font-weight: 500; margin-top: 0.2rem;">+28 thành viên mới</div>
                    </div>
                </div>

                <!-- Card 4: Sản phẩm -->
                <div style="background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 1rem; border: 1px solid #f0f0f0;">
                    <div style="background: #FFF3E0; color: #FF9800; width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <div>
                        <div style="color: #888; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; font-family: var(--font-ui); margin-bottom: 0.2rem;">Sản phẩm</div>
                        <div style="font-size: 1.6rem; font-weight: 800; font-family: var(--font-ui); color: #111;">156</div>
                        <div style="color: #FF9800; font-size: 0.8rem; font-weight: 500; margin-top: 0.2rem;">12 sản phẩm sắp hết</div>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 2.5rem;">
                <div style="background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f0f0f0;">
                    <h3 style="margin-bottom: 1.5rem; font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 1px;">Biểu đồ doanh thu (7 ngày)</h3>
                    <canvas id="revenueChart" height="120"></canvas>
                </div>
                <div style="background: #fff; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; display: flex; flex-direction: column;">
                    <h3 style="margin-bottom: 1.5rem; font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 1px;">Trạng thái đơn hàng</h3>
                    <div style="flex: 1; display: flex; align-items: center; justify-content: center;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="table-wrapper" style="border-radius: 12px; border: 1px solid #f0f0f0; padding: 2rem;">
                <h3 style="margin-bottom: 1.5rem; font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 1px;">Đơn hàng mới nhất</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-001</td>
                            <td>Nguyễn Văn A</td>
                            <td>25/06/2026</td>
                            <td>3.800.000 ₫</td>
                            <td><span style="background: #E3F2FD; color: #1976D2; padding: 6px 12px; border-radius: 100px; font-size: 0.8rem; font-weight: 700; font-family: var(--font-ui);">MỚI</span></td>
                        </tr>
                        <tr>
                            <td>#ORD-002</td>
                            <td>Trần Thị B</td>
                            <td>24/06/2026</td>
                            <td>4.200.000 ₫</td>
                            <td><span style="background: #FFF3E0; color: #F57C00; padding: 6px 12px; border-radius: 100px; font-size: 0.8rem; font-weight: 700; font-family: var(--font-ui);">ĐANG GIAO</span></td>
                        </tr>
                        <tr>
                            <td>#ORD-003</td>
                            <td>Lê Văn C</td>
                            <td>23/06/2026</td>
                            <td>2.100.000 ₫</td>
                            <td><span style="background: #E8F5E9; color: #388E3C; padding: 6px 12px; border-radius: 100px; font-size: 0.8rem; font-weight: 700; font-family: var(--font-ui);">HOÀN THÀNH</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
                new Chart(ctxRevenue, {
                    type: 'bar',
                    data: {
                        labels: ['19/06', '20/06', '21/06', '22/06', '23/06', '24/06', '25/06'],
                        datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: [3500000, 5200000, 4800000, 2100000, 7500000, 4200000, 8900000],
                            backgroundColor: '#111',
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { 
                            y: { 
                                beginAtZero: true,
                                grid: { color: '#f0f0f0' },
                                border: { dash: [4, 4] }
                            },
                            x: {
                                grid: { display: false }
                            }
                        }
                    }
                });

                const ctxStatus = document.getElementById('statusChart').getContext('2d');
                new Chart(ctxStatus, {
                    type: 'doughnut',
                    data: {
                        labels: ['Mới', 'Đang giao', 'Hoàn thành', 'Đã huỷ'],
                        datasets: [{
                            data: [15, 8, 22, 3],
                            backgroundColor: ['#1976D2', '#F57C00', '#388E3C', '#D32F2F'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { 
                                position: 'bottom',
                                labels: { font: { family: "'Poppins', sans-serif", size: 12 }, padding: 20 }
                            } 
                        },
                        cutout: '75%'
                    }
                });
            });
            </script>

        <?php elseif ($page === 'orders'): ?>
            <div class="admin-header">
                <h2>Quản lý đơn hàng</h2>
                <div style="display: flex; gap: 1rem;">
                    <select style="padding: 0.5rem 1rem; border-radius: 4px; border: 1px solid #ddd; font-family: var(--font-ui);">
                        <option>Tất cả trạng thái</option>
                        <option>Mới</option>
                        <option>Đang xử lý</option>
                        <option>Đang giao</option>
                        <option>Hoàn thành</option>
                        <option>Đã huỷ</option>
                    </select>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Thanh toán</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#ORD-001</td>
                            <td>Nguyễn Văn A</td>
                            <td>25/06/2026</td>
                            <td>COD</td>
                            <td>3.800.000 ₫</td>
                            <td><span style="background: #E3F2FD; color: #1976D2; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Mới</span></td>
                            <td>
                                <a href="#" style="color: #2196F3; margin-right: 10px; font-weight: bold; font-size: 0.9rem;">Chi tiết</a>
                                <a href="#" style="color: #4CAF50; font-weight: bold; font-size: 0.9rem;">Duyệt</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-002</td>
                            <td>Trần Thị B</td>
                            <td>24/06/2026</td>
                            <td>MoMo</td>
                            <td>4.200.000 ₫</td>
                            <td><span style="background: #FFF3E0; color: #F57C00; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Đang giao</span></td>
                            <td>
                                <a href="#" style="color: #2196F3; margin-right: 10px; font-weight: bold; font-size: 0.9rem;">Chi tiết</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-003</td>
                            <td>Lê Văn C</td>
                            <td>23/06/2026</td>
                            <td>Chuyển khoản</td>
                            <td>2.100.000 ₫</td>
                            <td><span style="background: #E8F5E9; color: #388E3C; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Hoàn thành</span></td>
                            <td>
                                <a href="#" style="color: #2196F3; font-weight: bold; font-size: 0.9rem;">Chi tiết</a>
                            </td>
                        </tr>
                        <tr>
                            <td>#ORD-004</td>
                            <td>Phạm Hoàng D</td>
                            <td>20/06/2026</td>
                            <td>COD</td>
                            <td>5.500.000 ₫</td>
                            <td><span style="background: #FFEBEE; color: #D32F2F; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Đã huỷ</span></td>
                            <td>
                                <a href="#" style="color: #2196F3; font-weight: bold; font-size: 0.9rem;">Chi tiết</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page === 'users'): ?>
            <div class="admin-header">
                <h2>Quản lý người dùng</h2>
                <button class="btn btn-dark">Thêm người dùng</button>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Vai trò</th>
                            <th>Ngày tham gia</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Admin PaceUp</td>
                            <td>admin@paceup.vn</td>
                            <td>0901234567</td>
                            <td><span style="background: #E0E0E0; color: #333; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Admin</span></td>
                            <td>01/01/2026</td>
                            <td>
                                <a href="#" style="color: #2196F3; margin-right: 15px; font-weight: bold;">Sửa</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Nguyễn Văn A</td>
                            <td>nguyenvana@gmail.com</td>
                            <td>0912345678</td>
                            <td><span style="background: #E3F2FD; color: #1976D2; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Khách hàng</span></td>
                            <td>15/06/2026</td>
                            <td>
                                <a href="#" style="color: #2196F3; margin-right: 15px; font-weight: bold;">Sửa</a>
                                <a href="#" style="color: #F44336; font-weight: bold;">Xóa</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Trần Thị B</td>
                            <td>tranthib@gmail.com</td>
                            <td>0987654321</td>
                            <td><span style="background: #E3F2FD; color: #1976D2; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">Khách hàng</span></td>
                            <td>20/06/2026</td>
                            <td>
                                <a href="#" style="color: #2196F3; margin-right: 15px; font-weight: bold;">Sửa</a>
                                <a href="#" style="color: #F44336; font-weight: bold;">Khóa</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page === 'settings'): ?>
            <div class="admin-header">
                <h2>Cài đặt hệ thống</h2>
            </div>
            <div style="background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); max-width: 600px;">
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui);">Tên website</label>
                    <input type="text" value="PaceUp" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui);">Email liên hệ</label>
                    <input type="email" value="cskh@paceup.vn" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui);">Phí vận chuyển mặc định</label>
                    <input type="text" value="30.000" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <button class="btn btn-dark">Lưu cài đặt</button>
            </div>

        <?php else: // products ?>
            <div class="admin-header">
                <h2>Danh mục sản phẩm</h2>
                <button class="btn btn-dark" onclick="openModal('productModal')">Thêm mới</button>
            </div>

            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Phân loại</th>
                            <th>Giá</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="<?= BASE_URL ?>assets/images/AIR+ZOOM+PEGASUS+42+WIDE.avif" alt="Shoe" width="60" height="60" style="object-fit: contain; background: #f5f5f5; border-radius: 4px;"></td>
                            <td>Nike Air Zoom Pegasus 42</td>
                            <td>Giày Chạy Bộ Nam</td>
                            <td>3.800.000 ₫</td>
                            <td>
                                <a href="javascript:void(0)" onclick="openModal('productModal')" style="color: #2196F3; margin-right: 15px; font-weight: bold;">Sửa</a>
                                <a href="javascript:void(0)" onclick="confirmDelete(1)" style="color: #F44336; font-weight: bold;">Xóa</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="<?= BASE_URL ?>assets/images/NIKE+SB+DUNK+LOW+PRO.avif" alt="Shoe" width="60" height="60" style="object-fit: contain; background: #f5f5f5; border-radius: 4px;"></td>
                            <td>Nike SB Dunk Low Pro</td>
                            <td>Giày Skate Nam</td>
                            <td>4.200.000 ₫</td>
                            <td>
                                <a href="javascript:void(0)" onclick="openModal('productModal')" style="color: #2196F3; margin-right: 15px; font-weight: bold;">Sửa</a>
                                <a href="javascript:void(0)" onclick="confirmDelete(2)" style="color: #F44336; font-weight: bold;">Xóa</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal Thêm/Sửa Sản Phẩm -->
            <div id="productModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
                <div style="background: #fff; width: 100%; max-width: 600px; border-radius: 12px; padding: 2rem; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <button onclick="closeModal('productModal')" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">&times;</button>
                    <h3 style="margin-bottom: 1.5rem; font-family: var(--font-heading); font-size: 1.5rem; text-transform: uppercase;">Thông tin sản phẩm</h3>
                    
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui); font-size: 0.9rem;">Tên sản phẩm *</label>
                                <input type="text" required placeholder="Nhập tên sản phẩm" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 6px; font-family: var(--font-ui);">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui); font-size: 0.9rem;">Giá bán (VNĐ) *</label>
                                <input type="number" required placeholder="Ví dụ: 3800000" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 6px; font-family: var(--font-ui);">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui); font-size: 0.9rem;">Phân loại *</label>
                                <select style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 6px; font-family: var(--font-ui);">
                                    <option value="men_running">Giày chạy bộ nam</option>
                                    <option value="women_running">Giày chạy bộ nữ</option>
                                    <option value="men_lifestyle">Giày thời trang nam</option>
                                    <option value="women_lifestyle">Giày thời trang nữ</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui); font-size: 0.9rem;">Hình ảnh *</label>
                                <input type="file" accept="image/*" style="width: 100%; padding: 0.6rem; border: 1px solid #ddd; border-radius: 6px; font-family: var(--font-ui); background: #fafafa;">
                            </div>
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-family: var(--font-ui); font-size: 0.9rem;">Mô tả sản phẩm</label>
                            <textarea rows="4" placeholder="Nhập mô tả chi tiết..." style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 6px; font-family: var(--font-ui); resize: vertical;"></textarea>
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                            <button type="button" onclick="closeModal('productModal')" style="padding: 0.8rem 1.5rem; background: #f5f5f5; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; color: #333;">Hủy</button>
                            <button type="submit" class="btn btn-dark" style="padding: 0.8rem 1.5rem; border-radius: 6px;">Lưu sản phẩm</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                function openModal(id) {
                    document.getElementById(id).style.display = 'flex';
                }
                function closeModal(id) {
                    document.getElementById(id).style.display = 'none';
                }
                function confirmDelete(id) {
                    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác.')) {
                        // Thêm logic xóa ở đây
                        alert('Đã xóa sản phẩm ID: ' + id);
                    }
                }
            </script>
        <?php endif; ?>
    </main>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
