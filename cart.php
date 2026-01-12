<?php
$pageTitle = 'Корзина';
require_once 'header.php';
require_once 'functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$cartItems = getCartItems($_SESSION['user_id']);
$total = 0;
?>

<div class="container">
    <h1 class="section-title">Корзина покупок</h1>
    
    <?php if (empty($cartItems)): ?>
        <div class="cart-empty">
            <i class="fas fa-shopping-cart" style="font-size: 5rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h2>Ваша корзина пуста</h2>
            <p>Добавьте товары из <a href="shop.php">каталога</a></p>
        </div>
    <?php else: ?>
        <div class="cart-container">
            <?php foreach ($cartItems as $item): 
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
            ?>
                <div class="cart-item">
                    <div class="cart-item-image">
                        <?php if ($item['image']): ?>
                            <img src="<?php echo escape($item['image']); ?>" alt="<?php echo escape($item['name']); ?>" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fas fa-image\' style=\'font-size: 3rem; color: var(--text-light);\'></i>';">
                        <?php else: ?>
                            <i class="fas fa-image" style="font-size: 3rem; color: var(--text-light);"></i>
                        <?php endif; ?>
                    </div>
                    
                    <div class="cart-item-info">
                        <h3><?php echo escape($item['name']); ?></h3>
                        <div class="cart-item-price"><?php echo number_format($item['price'], 0, ',', ' '); ?> ₽ за шт.</div>
                    </div>
                    
                    <div class="cart-item-quantity-controls">
                        <button class="btn-quantity-small" onclick="updateCartQuantity(<?php echo $item['product_id']; ?>, <?php echo $item['quantity'] - 1; ?>)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="cart-quantity-display-small" id="cart-quantity-<?php echo $item['product_id']; ?>"><?php echo $item['quantity']; ?></span>
                        <button class="btn-quantity-small" onclick="updateCartQuantity(<?php echo $item['product_id']; ?>, <?php echo $item['quantity'] + 1; ?>)" <?php echo $item['quantity'] >= $item['stock_quantity'] ? 'disabled' : ''; ?>>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                    <div class="cart-item-price">
                        <?php echo number_format($itemTotal, 0, ',', ' '); ?> ₽
                    </div>
                    
                    <button class="btn-remove" onclick="removeFromCart(<?php echo $item['product_id']; ?>)">
                        <i class="fas fa-trash"></i> Удалить
                    </button>
                </div>
            <?php endforeach; ?>
            
            <div class="cart-total">
                <h2>Итого: <?php echo number_format($total, 0, ',', ' '); ?> ₽</h2>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>

