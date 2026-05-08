<?php
// admin/messages.php
// Quản lý tin nhắn trực tiếp từ contact widget

session_start();
require_once '../config/db.php';

check_admin_login();

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$messages = [];

// Load messages from JSON
$messages_file = '../data/messages.json';
if(file_exists($messages_file)) {
    $messages = json_decode(file_get_contents($messages_file), true) ?? [];
}

// Sắp xếp từ mới nhất đến cũ nhất
usort($messages, function($a, $b) {
    return strtotime($b['created_at'] ?? 0) - strtotime($a['created_at'] ?? 0);
});

// Xóa tin nhắn
if($action == 'delete' && $id) {
    $messages = array_filter($messages, function($msg) use ($id) {
        return ($msg['id'] ?? '') !== $id;
    });
    file_put_contents($messages_file, json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    header("Location: messages.php?success=1");
    exit;
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tin Nhắn - ENERGY Mặt Trời Việt</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { background-color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .admin-header { background: white; padding: 2rem 0; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; }
        .admin-header h1 { margin: 0; font-size: 1.5rem; color: #1e293b; }
        .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f8fafc; padding: 1rem; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #e2e8f0; }
        .table td { padding: 1rem; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        .table tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="/" class="logo"><i class="fas fa-sun" style="color: #10b981;"></i> ENERGY Mặt Trời Việt</a>
            </div>
            <ul class="nav-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="posts.php">Tin tức</a></li>
                <li><a href="projects.php">Dự án</a></li>
                <li><a href="messages.php" style="color: #10b981; font-weight: 700;">Tin nhắn</a></li>
                <li><a href="logout.php" style="background: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 99px;">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-header">
        <div class="container"><h1><i class="fas fa-comment-dots" style="color:#10b981;"></i> Quản lý Tin Nhắn</h1></div>
    </div>

    <div class="page-content">
        <div class="container">
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success" style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <i class="fas fa-check-circle"></i> Tin nhắn đã được xóa thành công khỏi hệ thống.
                </div>
            <?php endif; ?>

            <?php if(!empty($messages)): ?>
                <div class="card">
                    <div style="overflow-x: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Tên khách hàng</th>
                                    <th style="width: 15%;">Điện thoại</th>
                                    <th style="width: 20%;">Email</th>
                                    <th>Nội dung cần tư vấn</th>
                                    <th style="width: 100px;">Ngày gửi</th>
                                    <th style="width: 80px;">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($messages as $msg): ?>
                                    <tr>
                                        <td style="font-weight: 600; color: #1e293b;">
                                            <?php echo htmlspecialchars(substr($msg['name'] ?? '', 0, 30)); ?>
                                        </td>
                                        <td>
                                            <a href="tel:<?php echo htmlspecialchars($msg['phone'] ?? ''); ?>" style="color: #10b981; text-decoration: none; font-weight: 600;">
                                                <?php echo htmlspecialchars($msg['phone'] ?? ''); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if(!empty($msg['email'])): ?>
                                                <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>" style="color: #3b82f6; text-decoration: none;">
                                                    <?php echo htmlspecialchars(substr($msg['email'], 0, 30)); ?>
                                                </a>
                                            <?php else: ?>
                                                <span style="color: #94a3b8; font-style: italic;">Không có</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="color: #475569; line-height: 1.6;">
                                            <?php echo nl2br(htmlspecialchars($msg['message'] ?? '')); ?>
                                        </td>
                                        <td style="color: #64748b; font-size: 0.9rem;">
                                            <?php echo date('d/m/Y', strtotime($msg['created_at'] ?? date('Y-m-d'))); ?><br>
                                            <small style="color: #94a3b8;"><?php echo date('H:i', strtotime($msg['created_at'] ?? date('Y-m-d H:i'))); ?></small>
                                        </td>
                                        <td>
                                            <a href="messages.php?action=delete&id=<?php echo htmlspecialchars($msg['id'] ?? ''); ?>" class="btn" style="background:#ef4444;color:white;padding:6px 12px;font-size:0.85rem; border-radius:6px;" onclick="return confirm('Bạn chắc chắn muốn xóa tin nhắn này?');"><i class="fas fa-trash"></i> Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="margin-top: 1rem; text-align: right; color: #64748b; font-size: 0.95rem;">
                    Tổng cộng: <strong style="color: #10b981;"><?php echo count($messages); ?></strong> tin nhắn
                </div>

            <?php else: ?>
                <div class="card" style="text-align: center; padding: 4rem 2rem;">
                    <i class="fas fa-inbox" style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                    <h3 style="color: #475569; margin: 0 0 0.5rem 0;">Chưa có tin nhắn nào</h3>
                    <p style="color: #94a3b8; margin: 0;">Các yêu cầu liên hệ từ khách hàng sẽ xuất hiện tại đây.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>