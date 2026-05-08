<?php
// admin/dashboard.php
// Dashboard admin - Giao diện đã được tối ưu UI/UX

session_start();
require_once '../config/db.php';

check_admin_login();

$page_title = 'Dashboard Admin';

// Lấy số lượng dữ liệu
$products_count = count(get_table_data('products'));
$posts_count = count(get_table_data('posts'));
$projects_count = count(get_table_data('projects'));
$contacts_count = count(get_table_data('contacts'));
$contacts = get_table_data('contacts');

// Lấy tin nhắn trực tiếp
$messages_file = '../data/messages.json';
$messages = [];
$messages_count = 0;
if(file_exists($messages_file)) {
    $messages = json_decode(file_get_contents($messages_file), true) ?? [];
    $messages_count = count($messages);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ENERGY Mặt Trời Việt</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* === TỐI ƯU CSS RIÊNG CHO TRANG ADMIN === */
        body { background-color: #f1f5f9; } /* Đổi nền xám nhạt để nổi bật các khối trắng */
        
        .admin-header {
            background: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .admin-header h1 { margin: 0; font-size: 1.8rem; font-weight: 800; color: #1e293b; }
        .admin-header p { margin: 0.5rem 0 0 0; color: #64748b; font-size: 1rem; }

        /* Lưới các thẻ thống kê */
        .admin-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        /* Thẻ thống kê */
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            border-color: #10b981;
        }
        .stat-card .label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }
        .stat-card .value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: auto;
        }
        /* Highlight màu sắc cho từng loại thông số */
        .stat-card:nth-child(1) .value { color: #3b82f6; } /* Xanh dương */
        .stat-card:nth-child(2) .value { color: #f59e0b; } /* Cam */
        .stat-card:nth-child(3) .value { color: #8b5cf6; } /* Tím */
        .stat-card:nth-child(4) .value { color: #10b981; } /* Xanh lá */
        .stat-card:nth-child(5) .value { color: #ef4444; } /* Đỏ */

        .stat-card a {
            margin-top: 1rem;
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }
        .stat-card a:hover { color: #059669; }

        /* Giao diện Bảng (Table) gọn gàng */
        .table-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            background: white;
        }
        .table-header h3 { margin: 0; font-size: 1.2rem; color: #1e293b; }
        .table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .table th, .table td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }
        .table th {
            background-color: #f8fafc;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .table tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="/" class="logo">
                    <i class="fas fa-sun" style="color: #10b981;"></i> ENERGY Mặt Trời Việt
                </a>
            </div>
            <ul class="nav-menu">
                <li><a href="dashboard.php" style="color: #10b981; font-weight: 700;">Dashboard</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="posts.php">Tin tức</a></li>
                <li><a href="projects.php">Dự án</a></li>
                <li><a href="messages.php"><i class="fas fa-comment-dots"></i> Tin nhắn <span style="background:#ef4444; color:white; padding:2px 8px; border-radius:10px; font-size:0.8rem;"><?php echo $messages_count; ?></span></a></li>
                <li><a href="logout.php" style="background: #ef4444; color: white; padding: 0.5rem 1.2rem; border-radius: 99px; font-size: 0.9rem;">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-header">
        <div class="container">
            <h1>Tổng Quan Hệ Thống</h1>
            <p>Xin chào, <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>. Chúc bạn một ngày làm việc hiệu quả!</p>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="admin-dashboard">
                <div class="stat-card">
                    <div class="label">Sản phẩm</div>
                    <div class="value"><?php echo $products_count; ?></div>
                    <a href="products.php">Quản lý <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card">
                    <div class="label">Bài viết</div>
                    <div class="value"><?php echo $posts_count; ?></div>
                    <a href="posts.php">Quản lý <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card">
                    <div class="label">Dự án</div>
                    <div class="value"><?php echo $projects_count; ?></div>
                    <a href="projects.php">Quản lý <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="stat-card">
                    <div class="label">Liên hệ Form</div>
                    <div class="value"><?php echo $contacts_count; ?></div>
                    <a href="javascript:void(0);" style="color: #94a3b8; border-color: transparent;">Xem bên dưới</a>
                </div>

                <div class="stat-card">
                    <div class="label">Tin nhắn trực tiếp</div>
                    <div class="value"><?php echo $messages_count; ?></div>
                    <a href="messages.php" style="color: #ef4444;">Đọc ngay <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-envelope-open-text" style="color: #10b981; margin-right: 8px;"></i> Khách hàng để lại liên hệ mới nhất</h3>
                </div>
                <?php if(count($contacts) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Họ Tên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Lấy 5 liên hệ mới nhất
                            $recent = array_slice($contacts, -5);
                            foreach(array_reverse($recent) as $contact):
                            ?>
                                <tr>
                                    <td style="font-weight: 600; color: #1e293b;"><?php echo htmlspecialchars($contact['name']); ?></td>
                                    <td>
                                        <a href="tel:<?php echo htmlspecialchars($contact['phone'] ?? ''); ?>" style="color: #10b981; text-decoration: none; font-weight: 500;">
                                            <?php echo htmlspecialchars($contact['phone'] ?? '-'); ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($contact['email'] ?? '-'); ?></td>
                                    <td style="color: #64748b; font-size: 0.9rem;"><?php echo date('d/m/Y - H:i', strtotime($contact['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div style="padding: 3rem; text-align: center; color: #94a3b8;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Chưa có liên hệ nào từ khách hàng.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div style="height: 50px;"></div>

</body>
</html>