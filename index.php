<?php
$pageTitle = 'Главная';
require_once 'header.php';
require_once 'functions.php';

$products = getAllProducts();
$featuredProducts = array_slice($products, 0, 6);
?>

<div class="hero">
    <div class="container">
        <h1>Добро пожаловать в TechShop</h1>
        <p>Лучшая техника и электроника по доступным ценам</p>
        <a href="shop.php" class="btn-register" style="display: inline-block; margin-top: 1rem;">Перейти в магазин</a>
    </div>
</div>

<div class="container">
    <!-- Слайдшоу преимуществ -->
    <div class="slideshow-container">
        <div class="slide slide-advantage active">
            <div class="slide-content">
                <div class="slide-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h2>Гарантия качества</h2>
                <p>Официальная гарантия на всю продукцию от производителя. Мы работаем только с проверенными поставщиками и гарантируем подлинность каждого товара.</p>
            </div>
        </div>
        
        <div class="slide slide-advantage">
            <div class="slide-content">
                <div class="slide-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h2>Быстрая доставка</h2>
                <p>Доставка по всей России в кратчайшие сроки. Бесплатная доставка при заказе от 5000 рублей. Курьерская доставка в день заказа доступна в крупных городах.</p>
            </div>
        </div>
        
        <div class="slide slide-advantage">
            <div class="slide-content">
                <div class="slide-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h2>Поддержка 24/7</h2>
                <p>Наша служба поддержки всегда готова помочь. Консультации по выбору товара, помощь с оформлением заказа и решение любых вопросов в любое время.</p>
            </div>
        </div>
        
        <div class="slide slide-advantage">
            <div class="slide-content">
                <div class="slide-icon">
                    <i class="fas fa-ruble-sign"></i>
                </div>
                <h2>Лучшие цены</h2>
                <p>Конкурентные цены и регулярные акции. Следите за нашими специальными предложениями и получайте скидки до 30% на популярные товары.</p>
            </div>
        </div>
        
        <button class="slide-prev">&#10094;</button>
        <button class="slide-next">&#10095;</button>
        
        <div class="slideshow-controls">
            <span class="slide-dot active" onclick="goToSlide(0)"></span>
            <span class="slide-dot" onclick="goToSlide(1)"></span>
            <span class="slide-dot" onclick="goToSlide(2)"></span>
            <span class="slide-dot" onclick="goToSlide(3)"></span>
        </div>
    </div>

    <!-- О магазине -->
    <section class="section">
        <h2 class="section-title">О нашем магазине</h2>
        <div class="about-content">
            <p>
                TechShop - это современный интернет-магазин техники и электроники, где вы найдете все необходимое 
                для работы, учебы и развлечений. Мы предлагаем широкий ассортимент качественных товаров от ведущих 
                производителей по выгодным ценам.
            </p>
            <p>
                Наша команда тщательно отбирает каждый товар, чтобы гарантировать высочайшее качество. 
                Мы работаем только с проверенными поставщиками и предоставляем официальную гарантию на всю продукцию.
            </p>
            <p>
                В нашем магазине вы найдете:
            </p>
            <ul style="margin-left: 2rem; margin-top: 1rem; line-height: 2;">
                <li>Смартфоны и планшеты</li>
                <li>Ноутбуки и компьютеры</li>
                <li>Наушники и аудиотехнику</li>
                <li>Аксессуары и периферию</li>
                <li>И многое другое</li>
            </ul>
        </div>
    </section>

    <!-- Популярные товары -->
    <section class="section">
        <h2 class="section-title">Популярные товары</h2>
        <div class="product-grid">
            <?php foreach ($featuredProducts as $product): ?>
                <div class="product-card" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'">
                    <div class="product-image">
                        <?php if ($product['image']): ?>
                            <img src="<?php echo escape($product['image']); ?>" alt="<?php echo escape($product['name']); ?>" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-image\'></i>';">
                        <?php else: ?>
                            <i class="fas fa-image"></i>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3 class="product-name"><?php echo escape($product['name']); ?></h3>
                        <div class="product-price"><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</div>
                        <p class="product-description"><?php echo escape($product['short_description']); ?></p>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn-view-product">Подробнее</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="shop.php" class="btn-submit" style="display: inline-block; padding: 1rem 2rem; text-decoration: none;">Смотреть все товары</a>
        </div>
    </section>

    <!-- Преимущества -->
    <section class="section">
        <h2 class="section-title">Почему выбирают нас</h2>
        <div class="product-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h3 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-shield-alt" style="font-size: 3rem; color: var(--primary-color); display: block; margin-bottom: 1rem;"></i>
                        Гарантия качества
                    </h3>
                    <p style="text-align: center;">Официальная гарантия на всю продукцию от производителя</p>
                </div>
            </div>
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h3 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-truck" style="font-size: 3rem; color: var(--primary-color); display: block; margin-bottom: 1rem;"></i>
                        Быстрая доставка
                    </h3>
                    <p style="text-align: center;">Доставка по всей России в кратчайшие сроки</p>
                </div>
            </div>
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h3 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-headset" style="font-size: 3rem; color: var(--primary-color); display: block; margin-bottom: 1rem;"></i>
                        Поддержка 24/7
                    </h3>
                    <p style="text-align: center;">Наша служба поддержки всегда готова помочь</p>
                </div>
            </div>
            <div class="product-card" style="cursor: default;">
                <div class="product-info">
                    <h3 style="text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-ruble-sign" style="font-size: 3rem; color: var(--primary-color); display: block; margin-bottom: 1rem;"></i>
                        Лучшие цены
                    </h3>
                    <p style="text-align: center;">Конкурентные цены и регулярные акции</p>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'footer.php'; ?>

