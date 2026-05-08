<?php
// includes/footer.php
$current_page = $_SERVER['REQUEST_URI'];
$is_admin = (strpos($current_page, '/admin/') !== false);
?>
    </div> <?php if (!$is_admin): ?>
    <footer class="footer" style="background: #0f172a; color: #94a3b8; padding: 4rem 0 2rem;">
        <div class="container">
            <div class="footer-content" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
                <div class="footer-section">
                    <h3 style="color: white; margin-bottom: 1.2rem; font-size: 1.1rem;">ENERGY Mặt Trời Việt</h3>
                    <p style="font-size: 0.95rem; line-height: 1.6;">Cung cấp giải pháp năng lượng mặt trời chuyên nghiệp, bền vững cho mọi công trình.</p>
                </div>

                <div class="footer-section">
                    <h3 style="color: white; margin-bottom: 1.2rem; font-size: 1.1rem;">Liên hệ nhanh</h3>
                    <p style="font-size: 0.95rem; margin-bottom: 0.8rem;">
                        <i class="fas fa-phone-alt" style="color: #10b981; margin-right: 8px;"></i> 
                        <a href="tel:0789686565" style="color: inherit; text-decoration: none;">0789 68 65 65</a>
                    </p>
                    <p style="font-size: 0.95rem;">
                        <i class="fas fa-envelope" style="color: #10b981; margin-right: 8px;"></i> 
                        <a href="mailto:info@solar.vn" style="color: inherit; text-decoration: none;">info@solar.vn</a>
                    </p>
                </div>

                <div class="footer-section">
                    <h3 style="color: white; margin-bottom: 1.2rem; font-size: 1.1rem;">Vị trí văn phòng</h3>
                    <div style="width: 100%; height: 130px; border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); margin-bottom: 1rem;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.9142691353354!2d105.77102057457255!3d10.023933290082686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0890004c001ad%3A0x8b322112e95e558b!2zQ8O0bmcgVHkgVE5ISCBFTkVSR1kgTeG6t3QgVHLhu51pIFZp4buHdA!5e0!3m2!1svi!2s!4v1777134317472!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <p style="font-size: 0.85rem; line-height: 1.5; color: #cbd5e1; display: flex; align-items: flex-start; gap: 8px;">
                        <i class="fas fa-map-marker-alt" style="color: #ef4444; margin-top: 3px;"></i>
                        <span>231 Đ. 30 Tháng 4, P. Xuân Khánh, Q. Ninh Kiều, Cần Thơ</span>
                    </p>
                </div>
            </div>
            
            <div class="footer-bottom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <p style="margin: 0; color: #64748b; font-size: 0.9rem;">© 2026 ENERGY Mặt Trời Việt. Tất cả quyền được bảo lưu.</p>
                
                <a href="/admin/login.php" style="color: #475569; text-decoration: none; font-size: 0.85rem; display: flex; align-items: center; gap: 6px; transition: 0.3s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#475569'">
                    <i class="fas fa-user-shield"></i> Quản trị viên
                </a>
            </div>
        </div>
    </footer>

    <?php if (file_exists(__DIR__ . '/contact-widget.php')) include __DIR__ . '/contact-widget.php'; ?>
    <?php endif; ?>

    <script src="/assets/js/script.js"></script>
</body>
</html>