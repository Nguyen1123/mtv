<?php
session_start();
require_once 'config/db.php';
$page_title = 'Giải pháp Hộ gia đình';
include 'includes/header.php';
?>
<section class="section">
    <div class="container">
        <h1 style="color: #10b981; font-weight: 800; margin-bottom: 2rem;">Điện Mặt Trời Cho Hộ Gia Đình</h1>
        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 3rem; align-items: center;">
            <div>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #475569;">
                    Giải pháp không chỉ mang đến nguồn năng lượng sạch thân thiện với môi trường mà còn tạo ra hiệu quả kinh tế cao cho gia đình Việt, tiết kiệm đáng kể chi phí tiền điện hằng tháng.
                </p>
                <ul style="list-style: none; padding-left: 0; margin: 2rem 0; color: #475569; line-height: 2;">
                    <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 8px;"></i> Tiết kiệm đến 90% hóa đơn tiền điện.</li>
                    <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 8px;"></i> Thời gian hoàn vốn nhanh: 4 - 5 năm.</li>
                    <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 8px;"></i> Chống nóng mái nhà cực tốt.</li>
                    <li><i class="fas fa-check-circle" style="color: #10b981; margin-right: 8px;"></i> Tuổi thọ hệ thống trên 25 năm.</li>
                </ul>
                <a href="/lien-he" class="btn btn-primary" style="padding: 12px 30px; border-radius: 8px;">Nhận Báo Giá Ngay</a>
            </div>
            <img src="https://images.unsplash.com/photo-1613665813446-82a78c468a1d?q=80&w=800" style="width: 100%; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>