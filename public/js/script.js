document.addEventListener("DOMContentLoaded", function() {
    let index = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(n) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === n);
            dots[i].classList.toggle('active', i === n);
        });
    }

    // Để hàm goToSlide có thể được gọi từ inline attribute trong HTML
    window.goToSlide = function(n) {
        index = n;
        showSlide(index);
    };

    // Tự động chuyển ảnh mỗi 3 giây
    setInterval(() => {
        index = (index + 1) % slides.length;
        showSlide(index);
    }, 3000);
});