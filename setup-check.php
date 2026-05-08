<?php
// setup-check.php
// Check if environment is properly configured

$checks = [
    'PHP Version' => ['pass' => version_compare(PHP_VERSION, '7.4.0', '>='), 'requirement' => 'PHP 7.4+'],
    'Sessions Enabled' => ['pass' => function_exists('session_start'), 'requirement' => 'session_start() function'],
    'File Functions' => ['pass' => function_exists('file_get_contents'), 'requirement' => 'file_get_contents() function'],
    'JSON Support' => ['pass' => function_exists('json_encode'), 'requirement' => 'json_encode() function'],
];

// Check file/folder permissions
$folders = [
    '/data' => 'data/',
    '/uploads' => 'uploads/',
];

$file_checks = [];
foreach ($folders as $path => $display) {
    $full_path = __DIR__ . $path;
    $exists = is_dir($full_path);
    $writable = $exists ? is_writable($full_path) : false;
    $file_checks[$display] = ['exists' => $exists, 'writable' => $writable];
}

$files = [
    'config/db.php',
    'includes/header.php',
    'includes/footer.php',
    'admin/login.php',
    'admin/dashboard.php',
];

$file_exists_checks = [];
foreach ($files as $file) {
    $full_path = __DIR__ . '/' . $file;
    $file_exists_checks[$file] = file_exists($full_path);
}

// Check data files
$data_files = [
    'data/admin.json',
    'data/products.json',
    'data/projects.json',
    'data/posts.json',
    'data/contacts.json',
];

$data_checks = [];
foreach ($data_files as $file) {
    $full_path = __DIR__ . '/' . $file;
    $data_checks[$file] = file_exists($full_path);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Check - Solar Energy Website</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 2rem; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #27ae60; margin-bottom: 1rem; }
        h2 { color: #333; margin-top: 2rem; margin-bottom: 1rem; font-size: 1.2rem; border-bottom: 2px solid #27ae60; padding-bottom: 0.5rem; }
        .check { display: flex; justify-content: space-between; align-items: center; padding: 0.8rem; margin-bottom: 0.5rem; background: #f9f9f9; border-left: 4px solid #ddd; }
        .check.pass { border-left-color: #27ae60; }
        .check.fail { border-left-color: #e74c3c; }
        .check-name { font-weight: bold; }
        .check-status { font-weight: bold; }
        .pass .check-status { color: #27ae60; }
        .fail .check-status { color: #e74c3c; }
        .summary { margin-top: 2rem; padding: 1rem; border-radius: 4px; }
        .summary.ok { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .summary.warning { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
        .summary.error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .status { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>☀️ Setup Check - Solar Energy Website</h1>
        
        <h2>PHP Requirements</h2>
        <?php foreach ($checks as $name => $check): ?>
            <div class="check <?php echo $check['pass'] ? 'pass' : 'fail'; ?>">
                <span class="check-name"><?php echo htmlspecialchars($name); ?></span>
                <span class="check-status"><?php echo $check['pass'] ? '✅ OK' : '❌ FAIL'; ?></span>
            </div>
        <?php endforeach; ?>

        <h2>Folder Permissions</h2>
        <?php foreach ($file_checks as $folder => $check): ?>
            <div class="check <?php echo ($check['exists'] && $check['writable']) ? 'pass' : 'fail'; ?>">
                <span class="check-name"><?php echo htmlspecialchars($folder); ?></span>
                <span class="check-status">
                    <?php if ($check['exists'] && $check['writable']): ?>
                        ✅ Writable
                    <?php elseif ($check['exists']): ?>
                        ⚠️ Exists, Not Writable
                    <?php else: ?>
                        ❌ Not Found
                    <?php endif; ?>
                </span>
            </div>
        <?php endforeach; ?>

        <h2>Required Files</h2>
        <?php foreach ($file_exists_checks as $file => $exists): ?>
            <div class="check <?php echo $exists ? 'pass' : 'fail'; ?>">
                <span class="check-name"><?php echo htmlspecialchars($file); ?></span>
                <span class="check-status"><?php echo $exists ? '✅ Found' : '❌ Missing'; ?></span>
            </div>
        <?php endforeach; ?>

        <h2>Data Files</h2>
        <?php foreach ($data_checks as $file => $exists): ?>
            <div class="check <?php echo $exists ? 'pass' : 'fail'; ?>">
                <span class="check-name"><?php echo htmlspecialchars($file); ?></span>
                <span class="check-status"><?php echo $exists ? '✅ Found' : '❌ Missing'; ?></span>
            </div>
        <?php endforeach; ?>

        <div class="summary <?php 
            $all_pass = 
                array_reduce($checks, fn($c, $v) => $c && $v['pass'], true) &&
                array_reduce($file_checks, fn($c, $v) => $c && ($v['exists'] && $v['writable']), true) &&
                array_reduce($file_exists_checks, fn($c, $v) => $c && $v, true) &&
                array_reduce($data_checks, fn($c, $v) => $c && $v, true);
            echo $all_pass ? 'ok' : 'warning';
        ?>">
            <?php if ($all_pass): ?>
                <span class="status">✅ All checks passed!</span><br>
                Your website is ready. <a href="index.php">Go to homepage</a> or <a href="admin/login.php">login to admin panel</a>
            <?php else: ?>
                <span class="status">⚠️ Some checks failed</span><br>
                Please fix the issues above before using the website.
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
