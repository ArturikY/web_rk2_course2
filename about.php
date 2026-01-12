<?php
$pageTitle = 'О нас';
require_once 'header.php';
?>

<div class="container">
    <div class="about-content">
        <h2>О компании TechShop</h2>
        
        <p>
            TechShop - это современный интернет-магазин техники и электроники, который начал свою работу в 2020 году. 
            За время нашей деятельности мы зарекомендовали себя как надежный партнер для тысяч клиентов по всей России.
        </p>
        
        <h3 style="margin-top: 2rem; margin-bottom: 1rem;">Наша миссия</h3>
        <p>
            Мы стремимся сделать передовые технологии доступными каждому. Наша цель - предоставить клиентам 
            широкий выбор качественной техники по справедливым ценам, обеспечивая при этом высокий уровень сервиса 
            и поддержки.
        </p>
        
        <h3 style="margin-top: 2rem; margin-bottom: 1rem;">Что мы предлагаем</h3>
        <ul style="margin-left: 2rem; line-height: 2;">
            <li><strong>Широкий ассортимент</strong> - более 1000 товаров от ведущих производителей</li>
            <li><strong>Качество</strong> - официальная гарантия на всю продукцию</li>
            <li><strong>Доставка</strong> - быстрая и удобная доставка по всей России</li>
            <li><strong>Поддержка</strong> - профессиональная консультация и техническая поддержка</li>
            <li><strong>Цены</strong> - конкурентные цены и регулярные акции</li>
        </ul>
        
        <h3 style="margin-top: 2rem; margin-bottom: 1rem;">Наши преимущества</h3>
        <div class="product-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin-top: 2rem;">
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h4 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-star" style="color: #fbbf24;"></i> Высокий рейтинг
                    </h4>
                    <p style="text-align: center; font-size: 0.9rem;">4.8 из 5 звезд на основе отзывов клиентов</p>
                </div>
            </div>
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h4 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-users" style="color: var(--primary-color);"></i> 50,000+ клиентов
                    </h4>
                    <p style="text-align: center; font-size: 0.9rem;">Довольных покупателей по всей России</p>
                </div>
            </div>
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h4 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-box" style="color: var(--success-color);"></i> 1000+ товаров
                    </h4>
                    <p style="text-align: center; font-size: 0.9rem;">Разнообразный ассортимент техники</p>
                </div>
            </div>
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h4 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-clock" style="color: var(--accent-color);"></i> Быстрая доставка
                    </h4>
                    <p style="text-align: center; font-size: 0.9rem;">Доставка в течение 1-3 дней</p>
                </div>
            </div>
        </div>
        
        <h3 style="margin-top: 2rem; margin-bottom: 1rem;">Контакты</h3>
        <p>
            Если у вас есть вопросы или предложения, мы всегда рады помочь. Свяжитесь с нами удобным для вас способом:
        </p>
        <ul style="margin-left: 2rem; line-height: 2; margin-top: 1rem;">
            <li><strong>Телефон:</strong> +7 (495) 123-45-67</li>
            <li><strong>Email:</strong> info@techshop.ru</li>
            <li><strong>Адрес:</strong> г. Москва, ул. Техническая, д. 1</li>
            <li><strong>Режим работы:</strong> Пн-Пт: 9:00 - 20:00, Сб-Вс: 10:00 - 18:00</li>
        </ul>
    </div>
</div>

<?php require_once 'footer.php'; ?>

