<?php
// admin/login.php
// Đăng nhập admin - dùng JSON
session_start();
require_once '../config/db.php';
$error = '';
// Kiểm tra nếu đã login rồi
if(isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}
// Xử lý form submit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = escape_input($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if(empty($username) || empty($password)) {
        $error = 'Vui lòng điền username và password!';
    } else {
        // Lấy dữ liệu admin từ JSON
        $admin_data = get_json_data('admin');
        $admin = $admin_data['admin'] ?? null;
        if($admin && $username === $admin['username'] && password_verify($password, $admin['password'])) {
            // Đúng - tạo session
            $_SESSION['admin_id'] = 1;
            $_SESSION['admin_username'] = $admin['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = 'Username hoặc password không chính xác!';
        }
    }
}
// Header cho trang login
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Năng Lượng Mặt Trời</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="/" class="logo">
                    <i class="fas fa-sun"></i> Solar Energy
                </a>
            </div>
        </div>
    </nav>
    <div class="page-content">
        <div class="login-container">
            <h2><i class="fas fa-lock"></i> Đăng nhập Admin</h2>
            <?php if($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 1rem;">
                    Đăng nhập
                </button>
                <p style="text-align: center; color: #999;">
                    <a href="/" style="color: #27ae60;">← Quay lại trang chủ</a>
                </p>
            </form>
            <div style="background: #f0f0f0; padding: 1rem; margin-top: 2rem; border-radius: 4px; font-size: 0.9rem; text-align: center;">
                <p><strong>Tài khoản test:</strong></p>
                <p>Username: admin</p>
                <p>Password: admin123</p>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>