# Hướng Dẫn Upload Logo

## 📁 Vị Trí Logo

Logo được lưu tại: `/assets/images/logo.svg`

## 🖼️ Logo Hiện Tại

Hiện tại website sử dụng logo SVG mặc định (logo.svg) với thiết kế mặt trời đơn giản.

## 📤 Cách Thay Đổi Logo

### Cách 1: Upload Logo PNG

1. **Chuẩn Bị File Logo**
   - Tên file: `logo.png` (hoặc các tên khác)
   - Kích thước khuyến nghị: 200x60 pixel
   - Định dạng: PNG, JPG, SVG

2. **Upload Lên Server**
   - Truy cập cPanel → File Manager
   - Điều hướng đến `/public_html/assets/images/`
   - Upload file logo của bạn

3. **Cập Nhật Header**
   - Truy cập `/includes/header.php`
   - Thay thế dòng:
   ```html
   <img src="/assets/images/logo.svg" alt="Solar Energy Logo" class="logo-img">
   ```
   thành:
   ```html
   <img src="/assets/images/logo.png" alt="Solar Energy Logo" class="logo-img">
   ```

### Cách 2: Chỉnh Sửa Logo SVG

Nếu muốn tùy chỉnh logo SVG:

1. Download file `/assets/images/logo.svg`
2. Chỉnh sửa bằng bất kỳ trình soạn thảo đồ họa nào (Illustrator, Inkscape, v.v.)
3. Upload lại file

## 🎨 Đặc Điểm Logo SVG

- ✅ Kích thước nhỏ (scalable)
- ✅ Độ phân giải cao ở mọi kích thước
- ✅ Tốc độ tải nhanh
- ✅ Tương thích với mọi trình duyệt

## 📱 Responsive Logo

Logo tự động thích ứng với kích thước màn hình:

- **Desktop** (> 768px): Logo cao 50px
- **Tablet** (768px - 640px): Logo cao 40px
- **Mobile** (< 640px): Logo cao 40px
- **Small Mobile** (< 480px): Logo cao 35px

## 💡 Tips

- Sử dụng SVG để tiết kiệm không gian
- PNG tốt cho logo phức tạp hoặc có hình ảnh
- Đảm bảo logo có nền trong suốt (transparent)
- Tỷ lệ khuyến nghị: 3:1 (rộng:cao)

## 📍 Files Liên Quan

- **Header**: `/includes/header.php`
- **CSS**: `/assets/css/style.css`
- **JavaScript**: `/assets/js/script.js`
- **Folder Logo**: `/assets/images/`
