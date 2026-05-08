<?php
/**
 * Image Processor - Tự động resize ảnh theo kích thước quy định
 * Hỗ trợ: JPG, PNG, GIF, WebP
 */

class ImageProcessor {
    // Kích thước quy định cho từng loại ảnh
    private static $sizes = [
        'product' => ['width' => 400, 'height' => 300, 'quality' => 85],  // Sản phẩm: 4:3
        'post' => ['width' => 600, 'height' => 400, 'quality' => 85],     // Tin tức: 3:2
        'project' => ['width' => 400, 'height' => 300, 'quality' => 85],  // Dự án: 4:3
        'avatar' => ['width' => 200, 'height' => 200, 'quality' => 90],   // Avatar: 1:1
    ];

    /**
     * Process uploaded image
     * @param array $file - $_FILES array item
     * @param string $type - 'product', 'post', 'project', 'avatar'
     * @param string $upload_dir - directory path
     * @return array - ['success' => bool, 'filename' => string, 'error' => string]
     */
    public static function process($file, $type = 'product', $upload_dir = '../uploads/') {
        // Kiểm tra file có hợp lệ không
        if(empty($file['name']) || $file['error'] != UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'File upload failed'];
        }

        // Kiểm tra loại ảnh
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if(!in_array($file['type'], $allowed)) {
            return ['success' => false, 'error' => 'Invalid image format'];
        }

        // Lấy kích thước quy định
        if(!isset(self::$sizes[$type])) {
            return ['success' => false, 'error' => 'Unknown image type'];
        }

        $config = self::$sizes[$type];
        $size_info = getimagesize($file['tmp_name']);
        
        if(!$size_info) {
            return ['success' => false, 'error' => 'Invalid image file'];
        }

        // Tạo tên file
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if(!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $ext = 'jpg';
        }
        $filename = $type . '_' . time() . '_' . random_int(1000, 9999) . '.' . $ext;
        
        // Tạo thư mục nếu chưa có
        if(!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $target_path = $upload_dir . $filename;

        try {
            // Resize và lưu ảnh
            $result = self::resizeImage(
                $file['tmp_name'],
                $target_path,
                $config['width'],
                $config['height'],
                $config['quality']
            );

            if($result) {
                return ['success' => true, 'filename' => $filename];
            } else {
                return ['success' => false, 'error' => 'Failed to process image'];
            }
        } catch(Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Resize image to specified dimensions using GD Library
     */
    private static function resizeImage($source, $dest, $max_width, $max_height, $quality = 85) {
        // Lấy thông tin ảnh gốc
        $size_info = getimagesize($source);
        $source_width = $size_info[0];
        $source_height = $size_info[1];
        $mime = $size_info['mime'];

        // Tính toán kích thước mới (fit inside, maintain aspect ratio)
        $ratio = min($max_width / $source_width, $max_height / $source_height);
        $new_width = round($source_width * $ratio);
        $new_height = round($source_height * $ratio);

        // Tạo ảnh mới với background màu trắng
        $new_image = imagecreatetruecolor($max_width, $max_height);
        $white = imagecolorallocate($new_image, 255, 255, 255);
        imagefill($new_image, 0, 0, $white);

        // Load ảnh gốc
        switch($mime) {
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $source_image = imagecreatefrompng($source);
                imagecolortransparent($source_image, imagecolorat($source_image, 0, 0));
                break;
            case 'image/gif':
                $source_image = imagecreatefromgif($source);
                break;
            case 'image/webp':
                $source_image = imagecreatefromwebp($source);
                break;
            default:
                return false;
        }

        // Tính vị trí để center ảnh
        $x = round(($max_width - $new_width) / 2);
        $y = round(($max_height - $new_height) / 2);

        // Resize và dán ảnh lên background
        imagecopyresampled($new_image, $source_image, $x, $y, 0, 0, 
                          $new_width, $new_height, $source_width, $source_height);

        // Lưu ảnh
        switch($mime) {
            case 'image/jpeg':
                imagejpeg($new_image, $dest, $quality);
                break;
            case 'image/png':
                imagepng($new_image, $dest, round(9 * $quality / 100));
                break;
            case 'image/gif':
                imagegif($new_image, $dest);
                break;
            case 'image/webp':
                imagewebp($new_image, $dest, $quality);
                break;
        }

        imagedestroy($source_image);
        imagedestroy($new_image);

        return file_exists($dest);
    }
}
?>
