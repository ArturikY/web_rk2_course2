<?php
require_once 'config.php';

// Функция для безопасного вывода
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Получение всех продуктов
function getAllProducts() {
    $conn = getDBConnection();
    $sql = "SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            ORDER BY p.created_at DESC";
    $result = $conn->query($sql);
    $products = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    $conn->close();
    return $products;
}

// Получение продукта по ID
function getProductById($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT p.*, c.name as category_name 
                            FROM products p 
                            LEFT JOIN categories c ON p.category_id = c.id 
                            WHERE p.id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    
    return $product;
}

// Получение корзины пользователя
function getCartItems($userId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT c.*, p.name, p.price, p.image, p.stock_quantity 
                            FROM cart c 
                            JOIN products p ON c.product_id = p.id 
                            WHERE c.user_id = ? 
                            ORDER BY c.added_at DESC");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    
    $stmt->close();
    $conn->close();
    return $items;
}

// Добавление в корзину
function addToCart($userId, $productId, $quantity = 1) {
    $conn = getDBConnection();
    
    // Проверяем, есть ли уже товар в корзине
    $stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Обновляем количество
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + $quantity;
        $stmt->close();
        
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->bind_param("ii", $newQuantity, $row['id']);
        $success = $stmt->execute();
    } else {
        // Добавляем новый товар
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $userId, $productId, $quantity);
        $success = $stmt->execute();
    }
    
    $stmt->close();
    $conn->close();
    return $success;
}

// Удаление из корзины
function removeFromCart($userId, $productId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Получение количества товара в корзине
function getCartItemQuantity($userId, $productId) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $quantity = 0;
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantity = $row['quantity'];
    }
    
    $stmt->close();
    $conn->close();
    return $quantity;
}

// Обновление количества товара в корзине
function updateCartQuantity($userId, $productId, $quantity) {
    if ($quantity <= 0) {
        return removeFromCart($userId, $productId);
    }
    
    $conn = getDBConnection();
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("iii", $quantity, $userId, $productId);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Сохранение обратной связи
function saveFeedback($userId, $name, $email, $message) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $userId, $name, $email, $message);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}
?>

