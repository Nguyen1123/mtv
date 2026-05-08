# Responsive Design - Solar Energy Website

## 📱 Tối Ưu Hóa Responsive

Website đã được tối ưu hóa hoàn toàn cho tất cả kích thước màn hình:

- ✅ **Desktop** (> 1200px)
- ✅ **Laptop** (1024px - 1200px)
- ✅ **Tablet** (640px - 1024px)
- ✅ **Mobile** (320px - 640px)

## 🎯 Điểm Breakpoint

| Thiết Bị | Kích Thước | Breakpoint |
|---------|-----------|-----------|
| Desktop | > 768px | Không có media query |
| Tablet | 640px - 768px | `@media (max-width: 768px)` |
| Mobile | < 640px | `@media (max-width: 640px)` |
| Small Mobile | < 480px | `@media (max-width: 480px)` |

## 🔧 Thành Phần Responsive

### 1. Header Navigation

**Desktop:**
- Menu hiển thị ngang
- Logo + text đầy đủ
- Tidak ada hamburger menu

**Tablet:**
- Menu vẫn hiển thị ngang
- Logo nhỏ hơn (40px)
- Hamburger menu không hiển thị

**Mobile:**
- Hamburger menu (☰)
- Menu ẩn/hiện khi nhấp
- Logo nhỏ nhất (35-40px)
- Chi tiết từng menu item khi click

### 2. Hero Section

**Desktop:**
- Tiêu đề: 3rem
- Mô tả: 1.2rem
- Padding: 6rem

**Tablet:**
- Tiêu đề: 2.2rem
- Mô tả: 1rem
- Padding: 4rem

**Mobile:**
- Tiêu đề: 1.6rem
- Mô tả: 0.9rem
- Padding: 2.5rem

**Small Mobile:**
- Tiêu đề: 1.4rem
- Mô tả: 0.85rem
- Padding: 2rem

### 3. Grid Layout

**Desktop:**
- Hiển thị 3-4 cột tùy vào nội dung
- Gap: 2rem

**Tablet:**
- Hiển thị 2-3 cột
- Gap: 1.5rem

**Mobile:**
- Hiển thị 1 cột
- Gap: 1rem

**Small Mobile:**
- Hiển thị 1 cột
- Gap: 0.8rem

### 4. Form

**Desktop & Tablet:**
- 2 cột (form-row)

**Mobile:**
- 1 cột
- Input height: 60px (cho dễ sử dụng)

### 5. Table

**Desktop & Tablet:**
- Hiển thị bình thường

**Mobile:**
- Chuyển thành dạng card
- Header ẩn, data labels hiển thị
- Cuộn ngang nếu cần

### 6. Footer

**Desktop:**
- 3 cột (mặc định auto-fit)

**Tablet:**
- 2 cột

**Mobile:**
- 1 cột

## 📊 Hamburger Menu

### Desktop/Tablet
- Ẩn toàn bộ (display: none)

### Mobile
- Hiển thị nút ☰
- Click để mở/đóng menu
- Smooth animation

**JavaScript Handler:**
- Toggle class `active`
- Menu slides xuống từ dưới navbar
- Tự động đóng khi click link hoặc ngoài menu

## 🎨 CSS Media Queries

```css
/* Tablet */
@media (max-width: 768px) { ... }

/* Mobile */
@media (max-width: 640px) { ... }

/* Small Mobile */
@media (max-width: 480px) { ... }
```

## 🚀 JavaScript Interactivity

### Mobile Menu Toggle

```javascript
// Mở/đóng menu
menuToggle.addEventListener('click', function() {
    menuToggle.classList.toggle('active');
    navMenu.classList.toggle('active');
});

// Đóng menu khi click link
navLinks.forEach(link => {
    link.addEventListener('click', function() {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
    });
});

// Đóng menu khi click ngoài
document.addEventListener('click', function(event) {
    if (!navMenu.contains(event.target) && 
        !menuToggle.contains(event.target)) {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
    }
});
```

## 📸 Ảnh Responsive

Tất cả ảnh sử dụng:
```css
width: 100%;
height: auto;
object-fit: cover;
```

Giúp hình ảnh tự động thích ứng với container.

## ♿ Accessibility

- ✅ Semantic HTML
- ✅ ARIA labels cho hamburger menu
- ✅ Focus states cho keyboard navigation
- ✅ Color contrast >= 4.5:1
- ✅ Font size >= 16px trên mobile

## 🧪 Kiểm Tra Responsive

### Browser DevTools
1. Mở Chrome/Firefox DevTools (F12)
2. Click "Toggle device toolbar" (Ctrl+Shift+M)
3. Chọn thiết bị từ danh sách

### Online Tools
- [Google Mobile-Friendly Test](https://search.google.com/test/mobile-friendly)
- [ResponsivelyApp](https://responsively.app/)
- [BrowserStack](https://www.browserstack.com/)

## 📝 Cách Thử Trên Thiết Bị Thực

1. **Đổi màn hình trình duyệt:**
   - Desktop: 1920x1080
   - Tablet: 768x1024 hoặc 1024x768
   - Mobile: 375x667 hoặc 414x896

2. **Test Gestures:**
   - Swipe (nếu tester device hỗ trợ touch)
   - Tap/click
   - Rotate screen

## 🔄 Performance

- ✅ Mobile-first CSS approach
- ✅ Minimal JavaScript
- ✅ CSS animations (không JavaScript)
- ✅ Optimized images
- ✅ Lazy loading (nếu có)

## 🎯 Best Practices

1. **Test thực tế trên nhiều device**
2. **Kiểm tra network throttling (slow 3G)**
3. **Đảm bảo touch targets >= 44x44px**
4. **Viewport meta tag:** `<meta name="viewport" content="width=device-width, initial-scale=1.0">`
5. **Không disable zoom:** Tránh `user-scalable=no`

---

**Website sẵn sàng cho mọi thiết bị! 📱💻🖥️**
