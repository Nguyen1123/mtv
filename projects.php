<?php
// projects.php
// Danh sách dự án

session_start();
require_once 'config/db.php';

$page_title = 'Dự án';
include 'includes/header.php';

// Lấy danh sách dự án
$projects = get_table_data('projects');
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Dự án năng lượng mặt trời</h2>
            <p>Tham khảo những dự án tiêu biểu mà chúng tôi đã thực hiện.</p>
        </div>
        
        <?php if(!empty($projects)): ?>
            <div class="grid">
                <?php foreach($projects as $project): ?>
                    <div class="card">
                        <div class="card-image-wrapper">
                            <?php if(!empty($project['image']) && file_exists('uploads/' . $project['image'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($project['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($project['name']); ?>" 
                                     class="card-image" loading="lazy">
                            <?php else: ?>
                                <div class="card-image-placeholder">
                                    <i class="fas fa-project-diagram"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                            <div class="project-meta">
                                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($project['location']); ?></span>
                                <span><i class="fas fa-bolt"></i> <?php echo htmlspecialchars($project['capacity']); ?></span>
                                <span><i class="fas fa-calendar"></i> <?php echo date('d/m/Y', strtotime($project['created_at'])); ?></span>
                            </div>
                            <p class="desc"><?php echo htmlspecialchars($project['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state text-center" style="padding: 4rem 2rem; color: var(--text-muted);">
                <i class="fas fa-folder-open" style="font-size: 4rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                <p style="font-size: 1.1rem;">Hiện tại chưa có dự án nào. Vui lòng quay lại sau!</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
