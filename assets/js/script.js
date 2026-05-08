// assets/js/script.js
// JavaScript cho website năng lượng mặt trời

document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when link is clicked
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNav = navMenu.contains(event.target);
            const isClickOnToggle = menuToggle.contains(event.target);
            
            if (!isClickInsideNav && !isClickOnToggle) {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });
    }

    // Close alert messages sau 5 giây
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.style.borderColor = '#e74c3c';
                    isValid = false;
                } else {
                    input.style.borderColor = '#ddd';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Vui lòng điền đầy đủ tất cả các trường bắt buộc!');
            }
        });
    });

    // Show password toggle
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    togglePasswordBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                this.textContent = 'Ẩn';
            } else {
                input.type = 'password';
                this.textContent = 'Hiện';
            }
        });
    });

    // Confirm delete
    const deleteLinks = document.querySelectorAll('a.delete');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Bạn chắc chắn muốn xóa?')) {
                e.preventDefault();
            }
        });
    });
});

// Hàm format tiền tệ
function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(value);
}

