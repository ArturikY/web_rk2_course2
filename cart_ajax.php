<?php
require_once 'config.php';
require_once 'functions.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Необходима авторизация']);
    exit;
}

$action = $_POST['action'] ?? '';
$productId = intval($_POST['product_id'] ?? 0);
$userId = $_SESSION['user_id'];

if ($action === 'add') {
    if ($productId > 0) {
        if (addToCart($userId, $productId, 1)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ошибка при добавлении']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный ID товара']);
    }
} elseif ($action === 'remove') {
    if ($productId > 0) {
        if (removeFromCart($userId, $productId)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ошибка при удалении']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный ID товара']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неизвестное действие']);
}
?>

