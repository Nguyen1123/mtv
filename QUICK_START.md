# Hướng Dẫn Nhanh - Website Năng Lượng Mặt Trời

## 🚀 Bắt Đầu Nhanh

### 1. Upload Lên Hosting

1. Tải tất cả file từ thư mục `/web_mtv/` 
2. Upload lên `/public_html/` (hoặc thư mục gốc của hosting)

### 2. Cấu Hình Quyền Thư Mục

Truy cập cPanel → File Manager:

1. Chọn thư mục `data/`
   - Nhấp chuột phải → Change Permissions → Nhập `777`
   - Đánh dấu "Recursive" và nhấp OK

2. Chọn thư mục `uploads/`
   - Nhấp chuột phải → Change Permissions → Nhập `777`
   - Đánh dấu "Recursive" và nhấp OK

### 3. Kiểm Tra Setup

Truy cập: `http://yourdomain.com/setup-check.php`

Nếu tất cả dấu ✅ - website sẵn sàng!

### Các URL Công Khai

- 🏠 **Trang chủ**: `http://yourdomain.com/`
- 📦 **Sản phẩm**: `http://yourdomain.com/san-pham`
- 🏗️ **Dự án**: `http://yourdomain.com/du-an`
- 📰 **Tin tức**: `http://yourdomain.com/tin-tuc`
- 📧 **Liên hệ**: `http://yourdomain.com/lien-he`
- 👨 **Admin**: `http://yourdomain.com/admin/login.php`

### 4. Đăng Nhập Admin

**Đường dẫn**: `http://yourdomain.com/admin/login.php`

**Tên đăng nhập**: admin  
**Mật khẩu**: admin123

⚠️ **Thay đổi mật khẩu ngay sau đăng nhập lần đầu!**

### 5. Quản Lý Nội Dung

**Thêm sản phẩm:**
- Chọn "Quản lý sản phẩm"
- Click "Thêm sản phẩm mới"
- Điền thông tin & upload ảnh

**Thêm dự án:**
- Chọn "Quản lý dự án"
- Click "Thêm dự án"
- Điền thông tin & upload ảnh

**Viết bài blog:**
- Chọn "Quản lý bài viết"
- Click "Thêm bài viết mới"
- Viết tiêu đề & nội dung

## 📋 Danh Sách Kiểm Tra

✅ Upload file lên `/public_html/`
✅ Set quyền `/data/` = 777
✅ Set quyền `/uploads/` = 777
✅ Kiểm tra `setup-check.php`
✅ Đăng nhập admin thành công
✅ Thay đổi mật khẩu

## 🔒 Bảo Mật

1. **Thay đổi mật khẩu admin** ngay lập tức
2. **Backup `/data/` thường xuyên** - lưu tất cả dữ liệu
3. Các file `.json` được bảo vệ khỏi truy cập trực tiếp

## 🖼️ Hình Ảnh

Hình ảnh được tự động lưu vào thư mục `/uploads/` khi:
- Thêm/sửa sản phẩm
- Thêm/sửa dự án
- Thêm/sửa bài viết

**Định dạng hỗ trợ**: JPG, PNG, GIF, WebP
**Kích thước được khuyến nghị**: Dưới 5MB

## ⚠️ Xử Lý Sự Cố

### Lỗi: "Permission Denied" viết vào `/data/`
**Giải pháp**: Đặt quyền `/data/` = 777

### Lỗi: Hình ảnh không hiển thị
**Giải pháp**:
1. Kiểm tra `/uploads/` tồn tại & có quyền 777
2. Kiểm tra tên file ảnh không có ký tự đặc biệt

### Không thể đăng nhập admin
**Giải pháp**:
1. Xóa cookies trình duyệt
2. Kiểm tra `/data/admin.json` tồn tại
3. Thử truy cập `setup-check.php` để chẩn đoán

## 📞 Liên Hệ & Hỗ Trợ

Xem file [DEPLOYMENT.md](DEPLOYMENT.md) để có thêm thông tin chi tiết.

---

**🌟 Website sẵn sàng! Hãy bắt đầu tạo nội dung.**
