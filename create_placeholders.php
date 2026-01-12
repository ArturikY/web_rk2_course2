<?php
/**
 * Скрипт для создания placeholder изображений
 * Запустите этот файл один раз для создания изображений-заглушек
 */

// Список товаров и их изображений
$products = [
    ['name' => 'iphone15', 'title' => 'iPhone 15 Pro'],
    ['name' => 'galaxy-s24', 'title' => 'Samsung Galaxy S24 Ultra'],
    ['name' => 'macbook-pro', 'title' => 'MacBook Pro 16"'],
    ['name' => 'thinkpad', 'title' => 'Lenovo ThinkPad X1 Carbon'],
    ['name' => 'airpods-pro', 'title' => 'AirPods Pro 2'],
    ['name' => 'sony-wh1000xm5', 'title' => 'Sony WH-1000XM5'],
    ['name' => 'magsafe', 'title' => 'Зарядное устройство MagSafe'],
    ['name' => 'macbook-case', 'title' => 'Чехол для MacBook Pro'],
];

// Создаем папку images если её нет
if (!file_exists('images')) {
    mkdir('images', 0777, true);
}

// Иконки для разных категорий товаров
$icons = [
    'iphone15' => '📱',
    'galaxy-s24' => '📱',
    'macbook-pro' => '💻',
    'thinkpad' => '💻',
    'airpods-pro' => '🎧',
    'sony-wh1000xm5' => '🎧',
    'magsafe' => '🔌',
    'macbook-case' => '💼',
];

echo "Создание placeholder изображений...\n\n";

foreach ($products as $product) {
    $filename = $product['name'] . '.jpg';
    $filepath = 'images/' . $filename;
    $title = $product['title'];
    $icon = $icons[$product['name']] ?? '📦';
    
    // Создаем SVG изображение
    $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="800" height="600" xmlns="http://www.w3.org/2000/svg">
    <defs>
        <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#2563eb;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#1e40af;stop-opacity:1" />
        </linearGradient>
    </defs>
    <rect width="800" height="600" fill="url(#grad)"/>
    <text x="400" y="280" font-family="Arial, sans-serif" font-size="120" fill="white" text-anchor="middle" dominant-baseline="middle">' . htmlspecialchars($icon) . '</text>
    <text x="400" y="380" font-family="Arial, sans-serif" font-size="32" fill="white" text-anchor="middle" dominant-baseline="middle" font-weight="bold">' . htmlspecialchars($title) . '</text>
    <text x="400" y="420" font-family="Arial, sans-serif" font-size="20" fill="rgba(255,255,255,0.8)" text-anchor="middle" dominant-baseline="middle">TechShop</text>
</svg>';
    
    // Сохраняем как SVG
    $svgPath = 'images/' . $product['name'] . '.svg';
    file_put_contents($svgPath, $svg);
    
    echo "✓ Создано: $svgPath\n";
}

echo "\nГотово! Изображения-заглушки созданы.\n";
echo "Примечание: SVG файлы созданы, но в базе данных указаны .jpg файлы.\n";
echo "Вы можете:\n";
echo "1. Заменить SVG на реальные JPG изображения\n";
echo "2. Или обновить пути в базе данных на .svg\n";
echo "3. Или использовать placeholder сервисы (см. README_IMAGES.md)\n";
?>

