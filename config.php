<?php
// Конфигурация базы данных
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'shop_db');

// Подключение к базе данных
function getDBConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->set_charset("utf8mb4");
        
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }
        
        return $conn;
    } catch (Exception $e) {
        die("Ошибка подключения к БД: " . $e->getMessage());
    }
}

// Старт сессии
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Проверка авторизации
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Получение информации о пользователе
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    
    return $user;
}
?>

