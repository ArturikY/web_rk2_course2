<?php
/**
 * Скрипт установки базы данных
 * Запустите этот файл один раз для настройки базы данных
 */

require_once 'config.php';

echo "<h2>Установка базы данных TechShop</h2>";

// Читаем SQL файл
$sqlFile = file_get_contents('database.sql');

// Разбиваем на отдельные запросы
$queries = array_filter(
    array_map('trim', explode(';', $sqlFile)),
    function($query) {
        return !empty($query) && !preg_match('/^--/', $query);
    }
);

$conn = getDBConnection();

$successCount = 0;
$errorCount = 0;

foreach ($queries as $query) {
    if (empty(trim($query))) continue;
    
    // Пропускаем CREATE DATABASE и USE, так как они уже должны быть выполнены
    if (stripos($query, 'CREATE DATABASE') !== false || stripos($query, 'USE ') !== false) {
        continue;
    }
    
    if ($conn->query($query)) {
        $successCount++;
    } else {
        $errorCount++;
        echo "<p style='color: red;'>Ошибка: " . $conn->error . "</p>";
        echo "<p style='color: gray; font-size: 0.9em;'>Запрос: " . htmlspecialchars(substr($query, 0, 100)) . "...</p>";
    }
}

// Создаем тестового пользователя с правильным хешем пароля
$adminPassword = 'admin123';
$hashedPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT id FROM users WHERE username = 'admin'");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $adminUsername, $adminEmail, $hashedPassword);
    $adminUsername = 'admin';
    $adminEmail = 'admin@shop.ru';
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>✓ Тестовый пользователь создан:</p>";
        echo "<ul>";
        echo "<li><strong>Логин:</strong> admin</li>";
        echo "<li><strong>Пароль:</strong> admin123</li>";
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>Ошибка при создании пользователя: " . $conn->error . "</p>";
    }
    $stmt->close();
} else {
    echo "<p style='color: orange;'>Пользователь admin уже существует</p>";
}

$conn->close();

echo "<hr>";
echo "<h3>Результат установки:</h3>";
echo "<p>Успешно выполнено запросов: <strong>$successCount</strong></p>";
echo "<p>Ошибок: <strong>$errorCount</strong></p>";

if ($errorCount == 0) {
    echo "<p style='color: green; font-weight: bold;'>✓ Установка завершена успешно!</p>";
    echo "<p><a href='index.php'>Перейти на главную страницу</a></p>";
} else {
    echo "<p style='color: red;'>Обнаружены ошибки при установке. Проверьте настройки базы данных в config.php</p>";
}
?>

