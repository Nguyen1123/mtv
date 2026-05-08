<?php
// products.php
// Danh sách sản phẩm

session_start();
require_once 'config/db.php';

$page_title = 'Sản phẩm';
include 'includes/header.php';

// Lấy danh sách sản phẩm
$products = get_table_data('products');
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Danh sách sản phẩm</h2>
            <p>Khám phá bộ sưu tập sản phẩm năng lượng mặt trời chất lượng cao của chúng tôi.</p>
        </div>
        
        <?php if(!empty($products)): ?>
            <div class="grid">
                <?php foreach($products as $product): ?>
                    <div class="card">
                        <div class="card-image-wrapper">
                            <?php if(!empty($product['image']) && file_exists('uploads/' . $product['image'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                     class="card-image" loading="lazy">
                            <?php else: ?>
                                <div class="card-image-placeholder">
                                    <i class="fas fa-solar-panel"></i>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($product['power'])): ?>
                                <div class="card-badge"><?php echo htmlspecialchars($product['power']); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="desc"><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="card-footer">
                                <span class="price"><?php echo htmlspecialchars($product['price']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state text-center" style="padding: 4rem 2rem; color: var(--text-muted);">
                <i class="fas fa-inbox" style="font-size: 4rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                <p style="font-size: 1.1rem;">Hiện tại chưa có sản phẩm nào. Vui lòng quay lại sau!</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
