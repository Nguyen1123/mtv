<?php
/**
 * Contact Widget - Các nút liên hệ trôi nổi (Vertical Floating Buttons)
 */
?>
<style>
    .floating-contact-menu {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 999;
    }

    .floating-btn {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border: 2px solid white;
    }

    .floating-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        color: white;
    }

    /* Tooltip hiển thị khi hover */
    .floating-btn::before {
        content: attr(data-tooltip);
        position: absolute;
        right: 70px;
        background: rgba(15, 23, 42, 0.85);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .floating-btn:hover::before {
        opacity: 1;
        visibility: visible;
        right: 75px;
    }

    /* Màu sắc từng nút giống hình mẫu */
    .btn-phone { background: linear-gradient(135deg, #f97316, #ea580c); }
    .btn-sms { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
    .btn-messenger { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .btn-zalo { 
        background: white; 
        color: #0068ff; 
        font-weight: 800; 
        font-size: 16px; 
        border: 2px solid #e2e8f0;
    }
    .btn-zalo:hover { color: #0068ff; border-color: #0068ff; }
    .btn-contact { background: linear-gradient(135deg, #10b981, #059669); }
    
    /* Reponsive cho điện thoại */
    @media (max-width: 640px) {
        .floating-contact-menu {
            bottom: 1.5rem;
            right: 1.5rem;
            gap: 12px;
        }
        .floating-btn {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }
        .btn-zalo { font-size: 14px; }
        .floating-btn::before { display: none; } /* Ẩn tooltip trên điện thoại để tránh vướng */
    }
</style>

<div class="floating-contact-menu">
    <a href="tel:0789686565" class="floating-btn btn-phone" data-tooltip="Gọi ngay cho chúng tôi">
        <i class="fas fa-phone-alt"></i>
    </a>
    
    <a href="sms:0789686565" class="floating-btn btn-sms" data-tooltip="Gửi tin nhắn SMS">
        <i class="fas fa-comment-dots"></i>
    </a>

    <a href="https://www.facebook.com/energy.mattroiviet/" target="_blank" class="floating-btn btn-messenger" data-tooltip="Chat qua Messenger">
        <i class="fab fa-facebook-messenger"></i>
    </a>

    <a href="https://zalo.me/0789686565" target="_blank" class="floating-btn btn-zalo" data-tooltip="Chat qua Zalo">
        Zalo
    </a>

    <a href="/lien-he" class="floating-btn btn-contact" data-tooltip="Gửi yêu cầu tư vấn chi tiết">
        <i class="fas fa-headset"></i>
    </a>
</div>