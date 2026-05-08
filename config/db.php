<?php
// config/db.php
// TỐI ƯU HÓA SIÊU TỐC: RAM CACHING + FILE LOCKING

define('DATA_DIR', __DIR__ . '/../data/');

// Bộ nhớ đệm RAM trong cùng 1 request để tránh đọc ổ cứng nhiều lần
global $_JSON_CACHE;
$_JSON_CACHE = [];

// Tạo thư mục data nếu chưa có
if (!file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0777, true);
}

// Hàm đọc file JSON (Có Caching)
function get_json_data($file) {
    global $_JSON_CACHE;
    
    // Nếu đã load vào RAM ở lệnh trước đó thì lấy luôn từ RAM
    if (isset($_JSON_CACHE[$file])) {
        return $_JSON_CACHE[$file];
    }

    $path = DATA_DIR . $file . '.json';
    if (file_exists($path)) {
        $content = file_get_contents($path);
        $data = json_decode($content, true) ?: [];
        $_JSON_CACHE[$file] = $data; // Lưu vào đệm RAM
        return $data;
    }
    return [];
}

// Hàm ghi file JSON (Có Lock an toàn và Cập nhật Cache)
function save_json_data($file, $data) {
    global $_JSON_CACHE;
    
    $path = DATA_DIR . $file . '.json';
    // LOCK_EX giúp file không bị hỏng khi có 2 người mua hàng/ghi dữ liệu cùng lúc
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    
    // Cập nhật lại bộ nhớ đệm RAM
    $_JSON_CACHE[$file] = $data;
}

// Hàm escape dữ liệu (XSS Protection)
function escape_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Kiểm tra admin login
function check_admin_login() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: /admin/login.php");
        exit;
    }
}

// Hàm lấy admin data
function get_admin_data() {
    $data = get_json_data('admin');
    return isset($data['admin']) ? $data['admin'] : ['username' => 'admin', 'password' => password_hash('admin123', PASSWORD_DEFAULT)];
}

// Hàm lấy dữ liệu table
function get_table_data($table) {
    return get_json_data($table);
}

// Hàm thêm record (Tối ưu tìm ID bằng max nhanh hơn)
function add_record($table, $data) {
    $records = get_json_data($table);
    $data['id'] = empty($records) ? 1 : max(array_column($records, 'id')) + 1;
    $data['created_at'] = date('Y-m-d H:i:s');
    $records[] = $data;
    save_json_data($table, $records);
    return $data['id'];
}

// Hàm update record
function update_record($table, $id, $data) {
    $records = get_json_data($table);
    foreach ($records as &$record) {
        if ($record['id'] == $id) {
            $record = array_merge($record, $data);
            break;
        }
    }
    save_json_data($table, $records);
}

// Hàm xóa record
function delete_record($table, $id) {
    $records = get_json_data($table);
    $records = array_values(array_filter($records, function($r) use ($id) {
        return $r['id'] != $id;
    }));
    save_json_data($table, $records);
}

// Hàm lấy record by ID
function get_record($table, $id) {
    $records = get_json_data($table);
    foreach ($records as $record) {
        if ($record['id'] == $id) return $record;
    }
    return null;
}

// Khởi tạo file admin.json nếu chưa có
if (!file_exists(DATA_DIR . 'admin.json')) {
    save_json_data('admin', [
        'admin' => [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT)
        ]
    ]);
}

// Khởi tạo bảng trống hàng loạt nếu chưa có
foreach (['products', 'posts', 'projects', 'contacts'] as $table) {
    if (!file_exists(DATA_DIR . $table . '.json')) {
        save_json_data($table, []);
    }
}

// Fake DB Object (dùng để giữ logic tương thích nếu có ở chỗ khác)
class FakeDB {
    public function query($sql) { return clone $this; }
    public function prepare($sql) { return clone $this; }
}
$conn = new FakeDB();
?>