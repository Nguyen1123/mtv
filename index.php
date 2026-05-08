<?php
// index.php
session_start();
require_once 'config/db.php';

$page_title = 'Trang chủ';
include 'includes/header.php';

// Lấy danh sách sản phẩm và dự án (Sắp xếp mới nhất lên đầu)
$all_products = get_table_data('products');
usort($all_products, function($a, $b) { return strtotime($b['created_at']) - strtotime($a['created_at']); });
$products = array_slice($all_products, 0, 8); // Lấy tối đa 8 sản phẩm

$all_projects = get_table_data('projects');
usort($all_projects, function($a, $b) { return strtotime($b['created_at']) - strtotime($a['created_at']); });
$projects = array_slice($all_projects, 0, 2); // LẤY ĐÚNG 2 DỰ ÁN THEO YÊU CẦU
?>

<style>
    :root {
        --primary-color: #10b981;
        --secondary-color: #059669;
    }

    /* BỐ CỤC BANNER HIỆN ĐẠI */
    .hero-banner {
        padding: 6rem 0 8rem;
        background: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)), url('https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1920') center/cover;
        color: white;
        text-align: center;
    }

    /* KHỐI THỐNG KÊ */
    .stats-container {
        margin-top: -4rem;
        position: relative;
        z-index: 5;
    }
    .stats-box {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border-bottom: 4px solid var(--primary-color);
    }
    .stat-card { text-align: center; border-right: 1px solid #e2e8f0; }
    .stat-card:last-child { border-right: none; }
    .stat-card h3 { color: var(--primary-color); font-size: 2.2rem; margin-bottom: 0.5rem; font-weight: 800; }
    .stat-card p { color: #64748b; font-weight: 600; font-size: 0.9rem; text-transform: uppercase; margin: 0;}
    @media (max-width: 768px) { .stat-card { border-right: none; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; } .stat-card:last-child { border-bottom: none; } }

    /* KHỐI GIẢI PHÁP */
    .solution-item {
        background: white; padding: 2rem; border-radius: 16px; border: 1px solid #e2e8f0;
        transition: all 0.3s ease; height: 100%; display: flex; flex-direction: column;
    }
    .solution-item:hover { border-color: var(--primary-color); transform: translateY(-5px); box-shadow: 0 10px 20px rgba(16, 185, 129, 0.1); }
    .solution-icon { width: 60px; height: 60px; background: rgba(16, 185, 129, 0.1); color: var(--primary-color); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1.5rem; }

    /* KHỐI SẢN PHẨM & DỰ ÁN */
    .product-card, .project-card {
        background: white; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; transition: 0.3s ease;
    }
    .product-card:hover, .project-card:hover { border-color: var(--primary-color); box-shadow: 0 10px 20px rgba(0,0,0,0.05); transform: translateY(-5px); }
    
    .view-more-btn {
        display: inline-block; padding: 12px 30px; border: 2px solid var(--primary-color); color: var(--primary-color);
        border-radius: 8px; font-weight: 600; text-decoration: none; transition: 0.3s;
    }
    .view-more-btn:hover { background: var(--primary-color); color: white; }

</style>

<section class="hero-banner">
    <div class="container">
        <h1 style="font-size: 2.5rem; font-weight: 800; line-height: 1.3;">NĂNG LƯỢNG XANH<br>KIẾN TẠO TƯƠNG LAI BỀN VỮNG</h1>
        <p style="margin: 1.5rem auto 2.5rem; opacity: 0.9; max-width: 600px; font-size: 1.1rem;">Chuyên cung cấp, thiết kế và thi công hệ thống điện mặt trời trọn gói chất lượng cao tại Cần Thơ và Miền Tây.</p>
        <a href="/lien-he" class="btn" style="background: var(--primary-color); color:white; padding: 14px 35px; border-radius: 8px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(16,185,129,0.3);">NHẬN BÁO GIÁ NGAY</a>
    </div>
</section>

<div class="container stats-container">
    <div class="stats-box">
        <div class="stat-card"><h3>500+</h3><p>Dự án hoàn thành</p></div>
        <div class="stat-card"><h3>15 MWp</h3><p>Tổng công suất</p></div>
        <div class="stat-card"><h3>99%</h3><p>Khách hàng hài lòng</p></div>
        <div class="stat-card"><h3>24/7</h3><p>Hỗ trợ kỹ thuật</p></div>
    </div>
</div>

<section class="section" style="padding: 5rem 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h2 style="font-size: 2rem; color: #1e293b; font-weight: 800;">GIẢI PHÁP TỐI ƯU</h2>
            <div style="width: 80px; height: 4px; background: var(--primary-color); margin: 15px auto; border-radius: 2px;"></div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            
            <a href="/giai-phap-ho-gia-dinh.php" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; background: white; padding: 1.8rem; border-radius: 12px; border: 1px solid #e2e8f0; transition: 0.3s;" onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 10px 20px rgba(16, 185, 129, 0.05)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                <div style="width: 48px; height: 48px; background: #e6f6ef; color: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.2rem;"><i class="fas fa-home"></i></div>
                <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Điện mặt trời hộ gia đình</h3>
                <p style="color: #64748b; font-size: 0.9rem; line-height: 1.5; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Giảm ngay 80-90% tiền điện mỗi tháng. Hệ thống vận hành bền bỉ trên 25 năm...</p>
            </a>

            <a href="/giai-phap-doanh-nghiep.php" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; background: white; padding: 1.8rem; border-radius: 12px; border: 1px solid #e2e8f0; transition: 0.3s;" onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 10px 20px rgba(16, 185, 129, 0.05)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                <div style="width: 48px; height: 48px; background: #e6f6ef; color: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.2rem;"><i class="fas fa-industry"></i></div>
                <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Điện mặt trời doanh nghiệp</h3>
                <p style="color: #64748b; font-size: 0.9rem; line-height: 1.5; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Giải pháp cắt giảm hàng tỷ đồng chi phí vận hành, đạt chứng nhận I-REC...</p>
            </a>

            <a href="/giai-phap-hybrid.php" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; background: white; padding: 1.8rem; border-radius: 12px; border: 1px solid #e2e8f0; transition: 0.3s;" onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 10px 20px rgba(16, 185, 129, 0.05)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                <div style="width: 48px; height: 48px; background: #e6f6ef; color: #10b981; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.2rem;"><i class="fas fa-charging-station"></i></div>
                <h3 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 8px; color: #1e293b;">Hệ thống lưu trữ (Hybrid)</h3>
                <p style="color: #64748b; font-size: 0.9rem; line-height: 1.5; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">Cung cấp nguồn điện liên tục, an tâm sử dụng ngay cả khi cúp điện lưới...</p>
            </a>

        </div>
    </div>
</section>

<section class="section" style="background: #f8fafc; padding: 5rem 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: 2rem; color: #1e293b; font-weight: 800;">SẢN PHẨM NỔI BẬT</h2>
            <div style="width: 80px; height: 4px; background: var(--primary-color); margin: 15px auto; border-radius: 2px;"></div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <?php if(!empty($products)): foreach($products as $row): ?>
            <div class="product-card" style="padding: 1.5rem; text-align: center;">
                <div style="height: 200px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center; background: white; border-radius: 8px;">
                    <?php if(!empty($row['image']) && file_exists("uploads/" . $row['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    <?php else: ?>
                        <i class="fas fa-solar-panel" style="font-size: 4rem; color: #cbd5e1;"></i>
                    <?php endif; ?>
                </div>
                <h4 style="margin: 0 0 0.5rem; font-size: 1.1rem; color: #1e293b;"><?php echo htmlspecialchars($row['name']); ?></h4>
                <p style="color: #64748b; font-size: 0.9rem; margin: 0 0 0.5rem;">Công suất: <strong><?php echo htmlspecialchars($row['power'] ?? '-'); ?></strong></p>
                <p style="color: var(--primary-color); font-weight: 800; font-size: 1.2rem; margin: 0;"><?php echo htmlspecialchars($row['price'] ?? 'Liên hệ'); ?></p>
            </div>
            <?php endforeach; else: ?>
                <p style="text-align:center; grid-column: 1 / -1; color: #94a3b8;">Hệ thống đang cập nhật sản phẩm.</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="/san-pham" class="view-more-btn">Xem Tất Cả Sản Phẩm</a>
        </div>
    </div>
</section>

<section class="section" style="padding: 5rem 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: 2rem; color: #1e293b; font-weight: 800;">DỰ ÁN ĐÃ THỰC HIỆN</h2>
            <div style="width: 80px; height: 4px; background: var(--primary-color); margin: 15px auto; border-radius: 2px;"></div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 450px)); gap: 2rem; justify-content: center;">
            <?php if(!empty($projects)): foreach($projects as $row): ?>
            <div class="project-card">
                <div style="height: 250px; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                    <?php if(!empty($row['image']) && file_exists("uploads/" . $row['image'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" style="width:100%; height:100%; object-fit:cover;">
                    <?php else: ?>
                        <i class="fas fa-bolt" style="font-size: 4rem; color: #cbd5e1;"></i>
                    <?php endif; ?>
                </div>
                <div style="padding: 1.5rem;">
                    <h4 style="margin: 0 0 0.5rem; font-size: 1.2rem; color: #1e293b; line-height: 1.4;"><?php echo htmlspecialchars($row['name']); ?></h4>
                    <p style="font-size:0.9rem; color:#64748b; margin: 0 0 1.5rem;"><i class="fas fa-map-marker-alt" style="color: #ef4444;"></i> <?php echo htmlspecialchars($row['location']); ?></p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding-top: 1rem; border-top: 1px dashed #cbd5e1;">
                        <div>
                            <span style="display: block; font-size: 0.85rem; color: #64748b;">Công suất</span>
                            <strong style="font-size: 1rem; color: var(--primary-color);"><?php echo htmlspecialchars($row['capacity'] ?? 'Liên hệ'); ?></strong>
                        </div>
                        <div>
                            <span style="display: block; font-size: 0.85rem; color: #64748b;">Năm thi công</span>
                            <strong style="font-size: 1rem; color: #1e293b;"><?php echo date('Y', strtotime($row['created_at'])); ?></strong>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; else: ?>
                <p style="text-align:center; grid-column: 1 / -1; color: #94a3b8;">Hệ thống đang cập nhật dự án.</p>
            <?php endif; ?>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="/du-an" class="view-more-btn">Xem Tất Cả Dự Án</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>