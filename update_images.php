<?php
/**
 * Скрипт для обновления изображений в базе данных
 * Запустите этот файл один раз через браузер: http://localhost/ваша-папка/update_images.php
 */

require_once 'config.php';

$updates = [
    ['iPhone 15 Pro', 'https://via.placeholder.com/800x600/2563eb/ffffff?text=iPhone+15+Pro'],
    ['Samsung Galaxy S24 Ultra', 'https://via.placeholder.com/800x600/1e40af/ffffff?text=Galaxy+S24+Ultra'],
    ['MacBook Pro 16"', 'https://via.placeholder.com/800x600/3b82f6/ffffff?text=MacBook+Pro+16'],
    ['Lenovo ThinkPad X1 Carbon', 'https://via.placeholder.com/800x600/2563eb/ffffff?text=ThinkPad+X1'],
    ['AirPods Pro 2', 'https://via.placeholder.com/800x600/10b981/ffffff?text=AirPods+Pro+2'],
    ['Sony WH-1000XM5', 'https://via.placeholder.com/800x600/1e40af/ffffff?text=Sony+WH-1000XM5'],
    ['Зарядное устройство MagSafe', 'https://via.placeholder.com/800x600/f59e0b/ffffff?text=MagSafe+Charger'],
    ['Чехол для MacBook Pro', 'https://via.placeholder.com/800x600/6b7280/ffffff?text=MacBook+Case'],
];

$conn = getDBConnection();
$updated = 0;
$errors = [];

echo "<h2>Обновление изображений товаров</h2>";
echo "<style>
    body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }
    .success { color: green; padding: 10px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px 0; }
    .error { color: red; padding: 10px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; margin: 10px 0; }
    .info { padding: 10px; background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 5px; margin: 10px 0; }
</style>";

foreach ($updates as $update) {
    $productName = $update[0];
    $imageUrl = $update[1];
    
    $stmt = $conn->prepare("UPDATE products SET image = ? WHERE name = ?");
    $stmt->bind_param("ss", $imageUrl, $productName);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<div class='success'>✓ Обновлено: $productName</div>";
            $updated++;
        } else {
            echo "<div class='info'>○ Товар не найден или уже обновлен: $productName</div>";
        }
    } else {
        $error = "Ошибка при обновлении $productName: " . $conn->error;
        echo "<div class='error'>✗ $error</div>";
        $errors[] = $error;
    }
    
    $stmt->close();
}

$conn->close();

echo "<hr>";
echo "<h3>Результат:</h3>";
echo "<p><strong>Обновлено товаров:</strong> $updated из " . count($updates) . "</p>";

if (empty($errors)) {
    echo "<div class='success'><strong>✓ Все изображения успешно обновлены!</strong></div>";
    echo "<p><a href='index.php'>Перейти на главную страницу</a></p>";
} else {
    echo "<div class='error'><strong>Обнаружены ошибки. Проверьте настройки базы данных.</strong></div>";
}
?>

