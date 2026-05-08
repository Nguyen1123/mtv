<?php
/**
 * API xử lý tin nhắn trực tiếp
 */
header('Content-Type: application/json; charset=utf-8');

session_start();
require_once '../config/db.php';

// Kiểm tra request method
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
    exit;
}

$action = $_GET['action'] ?? '';

switch($action) {
    case 'send':
        handleSendMessage();
        break;
    case 'get':
        handleGetMessages();
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        exit;
}

/**
 * Gửi tin nhắn mới
 */
function handleSendMessage() {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if(empty($data['name']) || empty($data['message']) || empty($data['phone'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing required fields']);
        return;
    }

    // Validate phone
    if(!preg_match('/^(\+84|0)[0-9]{9,10}$/', $data['phone'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid phone number']);
        return;
    }

    // Validate email (optional but if provided, must be valid)
    if(!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid email']);
        return;
    }

    $message_data = [
        'name' => htmlspecialchars($data['name']),
        'phone' => htmlspecialchars($data['phone']),
        'email' => htmlspecialchars($data['email'] ?? ''),
        'message' => htmlspecialchars($data['message']),
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'created_at' => date('Y-m-d H:i:s')
    ];

    // Lưu vào JSON
    $messages_file = '../data/messages.json';
    $messages = file_exists($messages_file) ? json_decode(file_get_contents($messages_file), true) : [];
    
    if(!is_array($messages)) {
        $messages = [];
    }

    // Tạo ID cho message
    $message_data['id'] = date('YmdHis') . '_' . substr(md5(uniqid()), 0, 8);
    
    $messages[] = $message_data;

    // Lưu file
    if(file_put_contents($messages_file, json_encode($messages, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))) {
        // Gửi email thông báo cho admin (nếu cần)
        sendAdminNotification($message_data);
        
        echo json_encode([
            'success' => true,
            'message' => 'Tin nhắn đã được gửi. Chúng tôi sẽ liên lạc lại với bạn sớm!',
            'message_id' => $message_data['id']
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Failed to save message']);
    }
}

/**
 * Lấy tin nhắn (chỉ dùng cho admin)
 */
function handleGetMessages() {
    // Kiểm tra quyền admin
    if(empty($_SESSION['admin_id'])) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'Unauthorized']);
        return;
    }

    $messages_file = '../data/messages.json';
    
    if(!file_exists($messages_file)) {
        echo json_encode(['success' => true, 'messages' => []]);
        return;
    }

    $messages = json_decode(file_get_contents($messages_file), true) ?? [];
    
    // Sắp xếp từ mới nhất đến cũ nhất
    usort($messages, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });

    echo json_encode(['success' => true, 'messages' => $messages]);
}

/**
 * Gửi email thông báo cho admin
 */
function sendAdminNotification($message_data) {
    // Thay đổi email admin của bạn ở đây
    $admin_email = 'admin@solar.vn';
    $subject = "Tin nhắn mới từ {$message_data['name']}";
    
    $body = "Tin nhắn mới:\n\n";
    $body .= "Tên: {$message_data['name']}\n";
    $body .= "Điện thoại: {$message_data['phone']}\n";
    $body .= "Email: {$message_data['email']}\n";
    $body .= "Nội dung: {$message_data['message']}\n";
    $body .= "Thời gian: {$message_data['created_at']}\n";

    $headers = "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "From: noreply@solar.vn\r\n";

    @mail($admin_email, $subject, $body, $headers);
}
?>
