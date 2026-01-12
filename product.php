<?php
require_once 'header.php';
require_once 'functions.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: shop.php');
    exit;
}

$productId = intval($_GET['id']);
$product = getProductById($productId);

if (!$product) {
    header('Location: shop.php');
    exit;
}

$pageTitle = $product['name'];
$characteristics = json_decode($product['characteristics'], true) ?? [];
$cartQuantity = 0;
if (isLoggedIn()) {
    $cartQuantity = getCartItemQuantity($_SESSION['user_id'], $productId);
}
?>

<div class="container">
    <div class="product-detail">
        <div class="product-detail-content">
            <div>
                <div class="product-detail-image">
                    <?php if ($product['image']): ?>
                        <img src="<?php echo escape($product['image']); ?>" alt="<?php echo escape($product['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-image\'></i>';">
                    <?php else: ?>
                        <i class="fas fa-image"></i>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="product-detail-info">
                <h1><?php echo escape($product['name']); ?></h1>
                
                <?php if ($product['category_name']): ?>
                    <div style="color: var(--text-light); margin-bottom: 1rem;">
                        Категория: <?php echo escape($product['category_name']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="product-detail-price"><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</div>
                
                <div class="product-detail-stock <?php 
                    echo $product['stock_quantity'] > 10 ? 'stock-available' : 
                        ($product['stock_quantity'] > 0 ? 'stock-low' : 'stock-out'); 
                ?>">
                    <?php if ($product['stock_quantity'] > 10): ?>
                        <i class="fas fa-check-circle"></i> В наличии (<?php echo $product['stock_quantity']; ?> шт.)
                    <?php elseif ($product['stock_quantity'] > 0): ?>
                        <i class="fas fa-exclamation-circle"></i> Осталось мало (<?php echo $product['stock_quantity']; ?> шт.)
                    <?php else: ?>
                        <i class="fas fa-times-circle"></i> Нет в наличии
                    <?php endif; ?>
                </div>
                
                <div class="product-detail-description">
                    <h3>Описание</h3>
                    <p><?php echo nl2br(escape($product['full_description'] ?: $product['short_description'])); ?></p>
                </div>
                
                <?php if (!empty($characteristics)): ?>
                    <div class="characteristics">
                        <h3>Характеристики</h3>
                        <table class="characteristics-table">
                            <?php foreach ($characteristics as $key => $value): ?>
                                <tr>
                                    <td><?php echo escape($key); ?></td>
                                    <td><?php echo escape($value); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
                
                <?php if (isLoggedIn()): ?>
                    <div id="cart-controls-<?php echo $product['id']; ?>" class="cart-controls">
                        <?php if ($cartQuantity == 0): ?>
                            <button class="btn-add-to-cart" 
                                    onclick="addToCart(<?php echo $product['id']; ?>)"
                                    <?php echo $product['stock_quantity'] == 0 ? 'disabled' : ''; ?>>
                                <i class="fas fa-shopping-cart"></i> Добавить в корзину
                            </button>
                        <?php else: ?>
                            <div class="cart-quantity-controls">
                                <button class="btn-quantity" onclick="changeQuantity(<?php echo $product['id']; ?>, -1)" <?php echo $product['stock_quantity'] == 0 ? 'disabled' : ''; ?>>
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="cart-quantity-display" id="quantity-<?php echo $product['id']; ?>"><?php echo $cartQuantity; ?></span>
                                <button class="btn-quantity" onclick="changeQuantity(<?php echo $product['id']; ?>, 1)" <?php echo ($product['stock_quantity'] == 0 || $cartQuantity >= $product['stock_quantity']) ? 'disabled' : ''; ?>>
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div style="padding: 1rem; background-color: var(--bg-light); border-radius: 5px; text-align: center;">
                        <p>Для добавления товаров в корзину необходимо <a href="login.php">войти</a> или <a href="register.php">зарегистрироваться</a></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div style="text-align: center; margin-bottom: 2rem;">
        <a href="shop.php" class="btn-submit" style="display: inline-block; padding: 1rem 2rem; text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Вернуться к каталогу
        </a>
    </div>
</div>

<?php require_once 'footer.php'; ?>

