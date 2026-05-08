<?php
session_start();
require_once 'config/db.php';
$page_title = 'Hệ thống Hybrid';
include 'includes/header.php';
?>
<section class="section" style="padding: 4rem 0 6rem;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h1 style="color: #10b981; font-weight: 800; margin-bottom: 2rem;">Hệ Thống Lưu Trữ Hybrid</h1>
            <p style="font-size: 1.1rem; color: #475569; margin-bottom: 3rem; line-height: 1.6;">
                Giải pháp tối ưu cho những khu vực điện lưới không ổn định hoặc các hộ gia đình muốn tự chủ nguồn năng lượng 24/7.
            </p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; text-align: left; margin-bottom: 3.5rem;">
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.02); transition: 0.3s;" onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)';">
                    <h4 style="color: #1e293b; font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-battery-full" style="color: #10b981; margin-right: 8px;"></i> Lưu trữ thông minh</h4>
                    <p style="font-size: 0.95rem; color: #64748b; line-height: 1.5;">Tự động nạp điện mặt trời dư thừa vào pin Lithium để sử dụng vào ban đêm hoặc những ngày mưa bão.</p>
                </div>
                <div style="background: white; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.02); transition: 0.3s;" onmouseover="this.style.borderColor='#10b981'; this.style.transform='translateY(-5px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.transform='translateY(0)';">
                    <h4 style="color: #1e293b; font-size: 1.1rem; margin-bottom: 10px;"><i class="fas fa-shield-alt" style="color: #10b981; margin-right: 8px;"></i> Bảo vệ liên tục</h4>
                    <p style="font-size: 0.95rem; color: #64748b; line-height: 1.5;">Hệ thống tự động chuyển sang dùng pin dự phòng chỉ trong 0.01 giây ngay khi phát hiện sự cố mất điện lưới.</p>
                </div>
            </div>

            <a href="/lien-he" class="btn btn-primary" style="display: inline-block; padding: 14px 35px; border-radius: 8px; font-size: 1.1rem; font-weight: 600; box-shadow: 0 4px 15px rgba(16,185,129,0.3); text-decoration: none;">
                <i class="fas fa-bolt" style="margin-right: 5px;"></i> Nhận Báo Giá Ngay
            </a>
            
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>