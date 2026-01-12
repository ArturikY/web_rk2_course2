<?php
require_once 'config.php';
$currentUser = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - TechShop' : 'TechShop - Интернет-магазин техники'; ?></title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="index.php">
                        <i class="fas fa-laptop"></i>
                        <span>TechShop</span>
                    </a>
                </div>
                
                <nav class="navbar">
                    <ul class="nav-menu">
                        <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Главная</a></li>
                        <li><a href="shop.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">Магазин</a></li>
                        <li><a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">О нас</a></li>
                        <?php if (isLoggedIn()): ?>
                            <li><a href="cart.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'active' : ''; ?>">
                                <i class="fas fa-shopping-cart"></i> Корзина
                            </a></li>
                            <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Контакты</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                
                <div class="auth-section">
                    <?php if (isLoggedIn()): ?>
                        <div class="user-menu">
                            <span class="username">
                                <i class="fas fa-user"></i> <?php echo escape($currentUser['username']); ?>
                            </span>
                            <a href="logout.php" class="btn-logout">Выход</a>
                        </div>
                    <?php else: ?>
                        <div class="auth-buttons">
                            <a href="login.php" class="btn-login">Вход</a>
                            <a href="register.php" class="btn-register">Регистрация</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    
    <main class="main-content">

