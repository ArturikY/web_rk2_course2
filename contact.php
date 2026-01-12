<?php
$pageTitle = 'Обратная связь';
require_once 'header.php';
require_once 'functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';
$currentUser = getCurrentUser();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Заполните все поля';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Некорректный email';
    } else {
        if (saveFeedback($currentUser['id'], $name, $email, $message)) {
            $success = 'Ваше сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.';
            $_POST = [];
        } else {
            $error = 'Ошибка при отправке сообщения. Попробуйте позже.';
        }
    }
}
?>

<div class="container">
    <div class="form-container">
        <h2 style="text-align: center; margin-bottom: 2rem;">Форма обратной связи</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Ваше имя:</label>
                <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? $currentUser['username']); ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Ваш Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? $currentUser['email']); ?>">
            </div>
            
            <div class="form-group">
                <label for="message">Сообщение:</label>
                <textarea id="message" name="message" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Отправить</button>
        </form>
        
        <div style="margin-top: 2rem; padding: 1.5rem; background-color: var(--bg-light); border-radius: 5px;">
            <h3 style="margin-bottom: 1rem;">Контактная информация</h3>
            <ul class="contact-list" style="list-style: none; padding: 0;">
                <li><i class="fas fa-phone"></i> <strong>Телефон:</strong> +7 (495) 123-45-67</li>
                <li><i class="fas fa-envelope"></i> <strong>Email:</strong> info@techshop.ru</li>
                <li><i class="fas fa-map-marker-alt"></i> <strong>Адрес:</strong> г. Москва, ул. Техническая, д. 1</li>
                <li><i class="fas fa-clock"></i> <strong>Режим работы:</strong> Пн-Пт: 9:00 - 20:00, Сб-Вс: 10:00 - 18:00</li>
            </ul>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

