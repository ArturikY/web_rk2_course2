<?php
$pageTitle = 'Магазин';
require_once 'header.php';
require_once 'functions.php';

$products = getAllProducts();
?>

<div class="container">
    <h1 class="section-title">Каталог товаров</h1>
    
    <div class="product-table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Наименование</th>
                    <th>Описание</th>
                    <th>Цена</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem;">
                            Товары отсутствуют
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr class="product-row-clickable" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'" style="cursor: pointer;">
                            <td>
                                <div class="table-product-image">
                                    <?php if ($product['image'] && file_exists($product['image'])): ?>
                                        <img src="<?php echo escape($product['image']); ?>" alt="<?php echo escape($product['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                    <?php else: ?>
                                        <i class="fas fa-image"></i>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="table-product-name"><?php echo escape($product['name']); ?></div>
                                <?php if ($product['category_name']): ?>
                                    <div style="color: var(--text-light); font-size: 0.9rem;"><?php echo escape($product['category_name']); ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="color: var(--text-light); max-width: 400px;">
                                    <?php echo escape($product['short_description']); ?>
                                </div>
                            </td>
                            <td>
                                <div class="table-product-price"><?php echo number_format($product['price'], 0, ',', ' '); ?> ₽</div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'footer.php'; ?>

