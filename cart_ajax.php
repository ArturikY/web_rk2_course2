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
$quantity = intval($_POST['quantity'] ?? 1);
$userId = $_SESSION['user_id'];

if ($action === 'add') {
    if ($productId > 0) {
        if (addToCart($userId, $productId, 1)) {
            $newQuantity = getCartItemQuantity($userId, $productId);
            echo json_encode(['success' => true, 'quantity' => $newQuantity]);
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
} elseif ($action === 'update') {
    if ($productId > 0 && $quantity > 0) {
        if (updateCartQuantity($userId, $productId, $quantity)) {
            echo json_encode(['success' => true, 'quantity' => $quantity]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Ошибка при обновлении']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверные параметры']);
    }
} elseif ($action === 'get_quantity') {
    if ($productId > 0) {
        $quantity = getCartItemQuantity($userId, $productId);
        echo json_encode(['success' => true, 'quantity' => $quantity]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Неверный ID товара']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неизвестное действие']);
}
?>

