<?php
// admin/logout.php
// Đăng xuất

session_start();
session_destroy();
header("Location: /");
exit;
?>
