<?php
session_start();
require_once 'config/db.php';
$page_title = 'Giải pháp Doanh nghiệp';
include 'includes/header.php';
?>
<section class="section">
    <div class="container">
        <h1 style="color: #10b981; font-weight: 800; margin-bottom: 2rem;">Điện Mặt Trời Cho Doanh Nghiệp</h1>
        <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 3rem; align-items: center;">
            <img src="https://images.unsplash.com/photo-1592833159155-c62df1b65634?q=80&w=800" style="width: 100%; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #475569;">
                    Giúp doanh nghiệp tiết kiệm hàng tỷ đồng tiền điện mỗi năm, nâng cao uy tín, giá trị thương hiệu xanh và hướng đến hình ảnh doanh nghiệp bền vững.
                </p>
                <div style="background: #f8fafc; padding: 2rem; border-radius: 12px; margin: 2rem 0; border-left: 5px solid #10b981;">
                    <h3 style="margin-bottom: 1rem;">Lợi ích vượt trội:</h3>
                    <p>✔ Giảm chi phí vận hành tối đa.</p>
                    <p>✔ Đạt chứng chỉ I-REC (Năng lượng tái tạo).</p>
                    <p>✔ Bảo vệ mái nhà xưởng, giảm nhiệt độ bên dưới 3-5 độ C.</p>
                </div>
                <a href="/lien-he" class="btn btn-primary">Tư Vấn Giải Pháp ESCO</a>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>