<?php
// giai-phap.php - Trang tổng quan các giải pháp
session_start();
require_once 'config/db.php';
$page_title = 'Giải pháp Năng lượng';
include 'includes/header.php';
?>

<style>
    .solution-header {
        background: linear-gradient(rgba(16, 185, 129, 0.9), rgba(5, 150, 105, 0.9)), url('https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200');
        background-size: cover;
        background-position: center;
        padding: 5rem 0;
        color: white;
        text-align: center;
    }
    .solution-grid-detailed {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        margin-top: -3rem;
    }
    .sol-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
        transition: 0.3s;
        display: flex;
        flex-direction: column;
    }
    .sol-card:hover { transform: translateY(-10px); border-color: #10b981; }
    .sol-card img { width: 100%; height: 220px; object-fit: cover; }
    .sol-card-body { padding: 2rem; flex-grow: 1; display: flex; flex-direction: column; }
    .sol-card-body h3 { color: #1e293b; font-size: 1.4rem; margin-bottom: 1rem; }
    .sol-card-body p { color: #64748b; line-height: 1.6; margin-bottom: 1.5rem; }
    .btn-outline {
        margin-top: auto;
        padding: 10px 20px;
        border: 2px solid #10b981;
        color: #10b981;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        transition: 0.3s;
    }
    .btn-outline:hover { background: #10b981; color: white; }
</style>

<section class="solution-header">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1rem;">GIẢI PHÁP NĂNG LƯỢNG TOÀN DIỆN</h1>
        <p style="opacity: 0.9; max-width: 700px; margin: 0 auto;">Chúng tôi cung cấp các hệ thống tối ưu nhất dựa trên nhu cầu thực tế của từng khách hàng.</p>
    </div>
</section>

<section class="section" style="padding-bottom: 5rem;">
    <div class="container">
        <div class="solution-grid-detailed">
            
            <div class="sol-card">
                <img src="https://images.unsplash.com/photo-1613665813446-82a78c468a1d?q=80&w=800" alt="Hộ gia đình">
                <div class="sol-card-body">
                    <h3>Hệ Thống Cho Hộ Gia Đình</h3>
                    <p>Tận dụng diện tích mái nhà để tạo ra nguồn điện sạch, giúp giảm hóa đơn tiền điện và làm mát không gian sống.</p>
                    <a href="/giai-phap-ho-gia-dinh.php" class="btn-outline">Xem chi tiết giải pháp</a>
                </div>
            </div>

            <div class="sol-card">
                <img src="https://images.unsplash.com/photo-1592833159155-c62df1b65634?q=80&w=800" alt="Doanh nghiệp">
                <div class="sol-card-body">
                    <h3>Giải Pháp Cho Doanh Nghiệp</h3>
                    <p>Cắt giảm chi phí vận hành, nâng cao uy tín thương hiệu xanh và tối ưu hóa lợi nhuận đầu tư dài hạn.</p>
                    <a href="/giai-phap-doanh-nghiep.php" class="btn-outline">Xem chi tiết giải pháp</a>
                </div>
            </div>

            <div class="sol-card">
                <img src="https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?q=80&w=800" alt="Hybrid">
                <div class="sol-card-body">
                    <h3>Hệ Thống Lưu Trữ Hybrid</h3>
                    <p>Đảm bảo nguồn điện liên tục 24/7 cho các thiết bị quan trọng, kể cả khi lưới điện gặp sự cố.</p>
                    <a href="/giai-phap-hybrid.php" class="btn-outline">Xem chi tiết giải pháp</a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>