// Слайдшоу
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.slide-dot');

function showSlide(index) {
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    if (index >= slides.length) currentSlide = 0;
    if (index < 0) currentSlide = slides.length - 1;
    
    slides[currentSlide].classList.add('active');
    if (dots[currentSlide]) dots[currentSlide].classList.add('active');
}

function nextSlide() {
    currentSlide++;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide--;
    showSlide(currentSlide);
}

function goToSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
}

// Автоматическое переключение слайдов
let slideInterval;
function startSlideshow() {
    if (slides.length > 0) {
        slideInterval = setInterval(nextSlide, 5000);
    }
}

// Инициализация слайдшоу
document.addEventListener('DOMContentLoaded', function() {
    if (slides.length > 0) {
        showSlide(0);
        startSlideshow();
    }
    
    // Обработчики для кнопок слайдшоу
    const prevBtn = document.querySelector('.slide-prev');
    const nextBtn = document.querySelector('.slide-next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            clearInterval(slideInterval);
            prevSlide();
            startSlideshow();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            clearInterval(slideInterval);
            nextSlide();
            startSlideshow();
        });
    }
    
    // Обработчики для точек
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            clearInterval(slideInterval);
            goToSlide(index);
            startSlideshow();
        });
    });
});

// Добавление в корзину
function addToCart(productId) {
    if (!confirm('Добавить товар в корзину?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'add');
    formData.append('product_id', productId);
    
    fetch('cart_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Товар добавлен в корзину!');
            if (window.location.pathname.includes('cart.php')) {
                location.reload();
            }
        } else {
            alert('Ошибка: ' + (data.message || 'Не удалось добавить товар'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при добавлении товара');
    });
}

// Удаление из корзины
function removeFromCart(productId) {
    if (!confirm('Удалить товар из корзины?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'remove');
    formData.append('product_id', productId);
    
    fetch('cart_ajax.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Ошибка: ' + (data.message || 'Не удалось удалить товар'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при удалении товара');
    });
}

// Плавная прокрутка
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

