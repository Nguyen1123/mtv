<?php
// posts.php
// Danh sách bài viết tin tức

session_start();
require_once 'config/db.php';

$page_title = 'Tin tức';
include 'includes/header.php';

// Lấy danh sách bài viết
$posts = get_table_data('posts');
?>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Tin tức năng lượng mặt trời</h2>
            <p>Cập nhật những thông tin mới nhất về công nghệ năng lượng tái tạo.</p>
        </div>
        
        <?php if(!empty($posts)): ?>
            <div class="post-list">
                <?php foreach($posts as $post): ?>
                    <article class="post-card">
                        <div class="post-card-image">
                            <?php if(!empty($post['image']) && file_exists('uploads/' . $post['image'])): ?>
                                <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" 
                                     alt="<?php echo htmlspecialchars($post['title']); ?>" 
                                     loading="lazy">
                            <?php else: ?>
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--bg-light); color: #cbd5e1;">
                                    <i class="fas fa-newspaper" style="font-size: 3rem;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="post-card-content">
                            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                            <div class="post-card-meta">
                                <span><i class="fas fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                                <span><i class="fas fa-clock"></i> <?php echo date('H:i', strtotime($post['created_at'])); ?></span>
                            </div>
                            <p class="post-card-excerpt"><?php 
                                $content = htmlspecialchars($post['content']);
                                echo (strlen($content) > 150) ? substr($content, 0, 150) . '...' : $content;
                            ?></p>
                            <a href="#" class="post-read-more">
                                Đọc thêm <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state text-center" style="padding: 4rem 2rem; color: var(--text-muted);">
                <i class="fas fa-newspaper" style="font-size: 4rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
                <p style="font-size: 1.1rem;">Chưa có bài viết nào. Hãy quay lại sau!</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
