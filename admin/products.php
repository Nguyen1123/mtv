<?php
// admin/products.php
session_start();
require_once '../config/db.php';
require_once '../config/image-processor.php';

check_admin_login();

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$error = ''; $success = '';
$products = get_table_data('products');

usort($products, function($a, $b) { return strtotime($b['created_at']) - strtotime($a['created_at']); });

if($action == 'delete' && $id) {
    $product = get_record('products', $id);
    if($product && !empty($product['image'])) { @unlink("../uploads/" . $product['image']); }
    delete_record('products', $id);
    header("Location: products.php?success=1"); exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = escape_input($_POST['name'] ?? ''); $description = escape_input($_POST['description'] ?? '');
    $power = escape_input($_POST['power'] ?? ''); $price = escape_input($_POST['price'] ?? '');

    if(empty($name) || empty($description)) { $error = 'Vui lòng điền tên và mô tả!'; } 
    else {
        $image = '';
        if(!empty($_FILES['image']['name'])) {
            $result = ImageProcessor::process($_FILES['image'], 'product', '../uploads/');
            if($result['success']) { $image = $result['filename']; } else { $error = $result['error']; }
        }

        if($action == 'edit' && $id) {
            $old_product = get_record('products', $id);
            if(empty($image)) { $image = $old_product['image']; } 
            else if(!empty($old_product['image'])) { @unlink("../uploads/" . $old_product['image']); }

            if(!$error) {
                update_record('products', $id, ['name' => $name, 'description' => $description, 'power' => $power, 'price' => $price, 'image' => $image]);
                $success = 'Cập nhật sản phẩm thành công!';
            }
        } else {
            if(!$error) {
                add_record('products', ['name' => $name, 'description' => $description, 'power' => $power, 'price' => $price, 'image' => $image]);
                $success = 'Thêm sản phẩm thành công!';
            }
        }
        if($success) { $_POST = []; $action = 'list'; $id = null; $products = get_table_data('products'); }
    }
}

$product = null;
if($action == 'edit' && $id) {
    $product = get_record('products', $id);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản Phẩm - ENERGY Mặt Trời Việt</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { background-color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .admin-header { background: white; padding: 2rem 0; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; }
        .admin-header h1 { margin: 0; font-size: 1.5rem; color: #1e293b; }
        .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden; }
        .card-content { padding: 1.5rem; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f8fafc; padding: 1rem; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #e2e8f0; }
        .table td { padding: 1rem; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }

        /* FORM UI OPTIMIZATION */
        .form-group { margin-bottom: 1.5rem; width: 100%; }
        .form-group label { display: block; margin-bottom: 0.6rem; font-weight: 600; color: #1e293b; font-size: 0.95rem; }
        .form-group input[type="text"], .form-group textarea {
            display: block; width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; 
            border-radius: 8px; font-family: inherit; font-size: 1rem;
            background-color: #f8fafc; box-sizing: border-box; transition: 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none; border-color: #10b981; background-color: #fff; 
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .form-row { display: flex; gap: 1.5rem; }
        .form-row .form-group { flex: 1; }
        .form-group input[type="file"] {
            display: block; width: 100%; padding: 12px; border: 1.5px dashed #cbd5e1; 
            border-radius: 8px; background-color: #f8fafc; cursor: pointer; box-sizing: border-box;
        }
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
                <li><a href="products.php" style="color: #10b981; font-weight: 700;">Sản phẩm</a></li>
                <li><a href="posts.php">Tin tức</a></li>
                <li><a href="projects.php">Dự án</a></li>
                <li><a href="messages.php"><i class="fas fa-comment-dots"></i> Tin nhắn</a></li>
                <li><a href="logout.php" style="background: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 99px;">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-header">
        <div class="container"><h1><i class="fas fa-box" style="color:#10b981;"></i> Quản lý Sản Phẩm</h1></div>
    </div>

    <div class="page-content">
        <div class="container">
            <?php if($success): ?><div class="alert alert-success"><i class="fas fa-check"></i> <?php echo $success; ?></div><?php endif; ?>
            <?php if($error): ?><div class="alert alert-danger"><i class="fas fa-times"></i> <?php echo $error; ?></div><?php endif; ?>

            <?php if($action == 'add' || $action == 'edit'): ?>
                <div class="card" style="max-width: 700px; margin: 0 auto;">
                    <div class="card-content">
                        <h3 style="margin-top:0; margin-bottom:1.5rem;"><?php echo $action == 'add' ? 'Thêm sản phẩm mới' : 'Sửa sản phẩm'; ?></h3>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên sản phẩm *</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group"><label>Công suất</label><input type="text" name="power" value="<?php echo htmlspecialchars($product['power'] ?? ''); ?>" placeholder="VD: 450W"></div>
                                <div class="form-group"><label>Giá hiển thị</label><input type="text" name="price" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" placeholder="VD: 5.500.000 VNĐ"></div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả chi tiết *</label>
                                <textarea name="description" rows="5" required><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh sản phẩm</label>
                                <input type="file" name="image" accept="image/*">
                            </div>
                            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                                <button type="submit" class="btn btn-primary" style="flex: 1; padding: 12px; border-radius: 8px;"><i class="fas fa-save"></i> Lưu Sản Phẩm</button>
                                <a href="products.php" class="btn" style="flex: 1; background: #94a3b8; color: white; text-align: center; border-radius: 8px; padding: 12px; text-decoration: none;">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div style="margin-bottom: 1.5rem;"><a href="?action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm sản phẩm</a></div>
                <div class="card">
                    <table class="table">
                        <thead><tr><th>Hình</th><th>Tên sản phẩm</th><th>Công suất</th><th>Giá</th><th>Hành động</th></tr></thead>
                        <tbody>
                            <?php if(count($products) > 0): foreach($products as $row): ?>
                                <tr>
                                    <td>
                                        <?php if(!empty($row['image']) && file_exists("../uploads/" . $row['image'])): ?>
                                            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" style="max-width: 60px; border-radius: 6px;">
                                        <?php else: ?>
                                            <div style="width:60px;height:60px;background:#e2e8f0;border-radius:6px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image" style="color:#94a3b8;"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-weight:600;"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['power']); ?></td>
                                    <td style="color:#10b981; font-weight:700;"><?php echo htmlspecialchars($row['price']); ?></td>
                                    <td>
                                        <a href="?action=edit&id=<?php echo $row['id']; ?>" class="btn" style="background:#3b82f6;color:white;padding:6px 12px;font-size:0.85rem; border-radius:6px;"><i class="fas fa-edit"></i></a>
                                        <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn" style="background:#ef4444;color:white;padding:6px 12px;font-size:0.85rem; border-radius:6px;" onclick="return confirm('Xóa sản phẩm này?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:2rem;">Chưa có sản phẩm nào</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>