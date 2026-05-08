<?php
// admin/projects.php
session_start();
require_once '../config/db.php';
require_once '../config/image-processor.php';

check_admin_login();

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$error = ''; $success = '';
$projects = get_table_data('projects');

usort($projects, function($a, $b) { return strtotime($b['created_at']) - strtotime($a['created_at']); });

if($action == 'delete' && $id) {
    $project = get_record('projects', $id);
    if($project && !empty($project['image'])) { @unlink("../uploads/" . $project['image']); }
    delete_record('projects', $id);
    header("Location: projects.php?success=1"); exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = escape_input($_POST['name'] ?? ''); $location = escape_input($_POST['location'] ?? '');
    $capacity = escape_input($_POST['capacity'] ?? ''); $description = escape_input($_POST['description'] ?? '');

    if(empty($name) || empty($location)) { $error = 'Vui lòng điền tên và địa điểm!'; } 
    else {
        $image = '';
        if(!empty($_FILES['image']['name'])) {
            $result = ImageProcessor::process($_FILES['image'], 'project', '../uploads/');
            if($result['success']) { $image = $result['filename']; } else { $error = $result['error']; }
        }

        if($action == 'edit' && $id) {
            $old_project = get_record('projects', $id);
            if(empty($image)) { $image = $old_project['image']; } 
            else if(!empty($old_project['image'])) { @unlink("../uploads/" . $old_project['image']); }

            if(!$error) {
                update_record('projects', $id, ['name' => $name, 'location' => $location, 'capacity' => $capacity, 'description' => $description, 'image' => $image]);
                $success = 'Cập nhật dự án thành công!';
            }
        } else {
            if(!$error) {
                add_record('projects', ['name' => $name, 'location' => $location, 'capacity' => $capacity, 'description' => $description, 'image' => $image]);
                $success = 'Thêm dự án thành công!';
            }
        }
        $_POST = []; $action = 'list'; $id = null; $projects = get_table_data('projects');
    }
}

$project = null;
if($action == 'edit' && $id) {
    $project = get_record('projects', $id);
    if(!$project) { header("Location: projects.php"); exit; }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Dự Án - Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        body { background-color: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif !important; }
        .admin-header { background: white; padding: 2rem 0; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .admin-header h1 { margin: 0; font-size: 1.5rem; color: #1e293b; }
        
        .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden; }
        .card-content { padding: 1.5rem; }
        
        .table { width: 100%; border-collapse: collapse; }
        .table th { background-color: #f8fafc; padding: 1rem; text-align: left; font-weight: 600; color: #475569; border-bottom: 2px solid #e2e8f0; }
        .table td { padding: 1rem; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        .table tr:hover { background-color: #f8fafc; }

        /* =========================================
           CSS GIAO DIỆN FORM ĐẸP (CHỐNG LỖI CACHE)
           ========================================= */
        .form-group { margin-bottom: 1.5rem; width: 100%; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #1e293b; font-size: 0.95rem; }
        
        .form-group input[type="text"], 
        .form-group textarea {
            display: block; width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; 
            border-radius: 8px; font-family: inherit; font-size: 1rem;
            background-color: #f8fafc; color: #1e293b; box-sizing: border-box; transition: all 0.3s ease;
        }
        
        .form-group input[type="text"]:focus, 
        .form-group textarea:focus {
            outline: none; border-color: #10b981; background-color: #ffffff; 
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }
        
        .form-group input[type="file"] {
            display: block; width: 100%; padding: 12px; border: 1.5px dashed #cbd5e1; 
            border-radius: 8px; background-color: #f8fafc; cursor: pointer; 
            color: #64748b; box-sizing: border-box;
        }
        
        .form-row { display: flex; gap: 1.5rem; width: 100%; }
        .form-row .form-group { margin-bottom: 0; flex: 1; }
        
        @media (max-width: 640px) { .form-row { flex-direction: column; gap: 1.5rem; } }
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
                <li><a href="projects.php" style="color: #10b981; font-weight: 700;">Dự án</a></li>
                <li><a href="messages.php"><i class="fas fa-comment-dots"></i> Tin nhắn</a></li>
                <li><a href="logout.php" style="background: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 99px;">Đăng xuất</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-header">
        <div class="container"><h1><i class="fas fa-solar-panel" style="color:#10b981;"></i> Quản lý Dự Án</h1></div>
    </div>

    <div class="page-content">
        <div class="container">
            <?php if($success): ?><div class="alert alert-success"><i class="fas fa-check"></i> <?php echo $success; ?></div><?php endif; ?>
            <?php if($error): ?><div class="alert alert-danger"><i class="fas fa-times"></i> <?php echo $error; ?></div><?php endif; ?>

            <?php if($action == 'add' || $action == 'edit'): ?>
                <div class="card" style="max-width: 700px; margin: 0 auto;">
                    <div class="card-content">
                        <h3 style="margin-top:0; margin-bottom:1.5rem; font-size:1.3rem; color:#1e293b;">
                            <?php echo $action == 'add' ? 'Thêm dự án mới' : 'Sửa dự án'; ?>
                        </h3>
                        
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên dự án *</label>
                                <input type="text" name="name" value="<?php echo htmlspecialchars($project['name'] ?? ''); ?>" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Địa điểm *</label>
                                    <input type="text" name="location" value="<?php echo htmlspecialchars($project['location'] ?? ''); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Công suất</label>
                                    <input type="text" name="capacity" value="<?php echo htmlspecialchars($project['capacity'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description" rows="4"><?php echo htmlspecialchars($project['description'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="image" accept="image/*">
                            </div>
                            
                            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                                <button type="submit" class="btn btn-primary" style="flex: 1; padding: 12px; border-radius: 8px; font-size: 1rem;"><i class="fas fa-save"></i> Lưu Dự Án</button>
                                <a href="projects.php" class="btn" style="flex: 1; background: #94a3b8; color: white; text-align: center; text-decoration: none; border-radius: 8px; padding: 12px; font-size: 1rem;">Hủy Bỏ</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div style="margin-bottom: 1.5rem;"><a href="?action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm dự án</a></div>
                <div class="card">
                    <table class="table">
                        <thead><tr><th>Hình ảnh</th><th>Tên dự án</th><th>Địa điểm</th><th>Công suất</th><th>Hành động</th></tr></thead>
                        <tbody>
                            <?php if(count($projects) > 0): foreach($projects as $row): ?>
                                <tr>
                                    <td>
                                        <?php if(!empty($row['image']) && file_exists("../uploads/" . $row['image'])): ?>
                                            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" style="max-width: 60px; border-radius: 6px;">
                                        <?php else: ?>
                                            <div style="width:60px;height:60px;background:#e2e8f0;border-radius:6px;display:flex;align-items:center;justify-content:center;"><i class="fas fa-image" style="color:#94a3b8;"></i></div>
                                        <?php endif; ?>
                                    </td>
                                    <td style="font-weight:600; color:#1e293b;"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><i class="fas fa-map-marker-alt" style="color:#ef4444;"></i> <?php echo htmlspecialchars($row['location']); ?></td>
                                    <td><?php echo htmlspecialchars($row['capacity']); ?></td>
                                    <td>
                                        <a href="?action=edit&id=<?php echo $row['id']; ?>" class="btn" style="background:#3b82f6;color:white;padding:6px 12px;font-size:0.85rem; border-radius:6px;"><i class="fas fa-edit"></i> Sửa</a>
                                        <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn" style="background:#ef4444;color:white;padding:6px 12px;font-size:0.85rem; border-radius:6px;" onclick="return confirm('Bạn chắc chắn muốn xóa?');"><i class="fas fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:2rem;">Chưa có dự án nào</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>