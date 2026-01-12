<?php
$pageTitle = 'Регистрация';
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Заполните все поля';
    } elseif ($password !== $password_confirm) {
        $error = 'Пароли не совпадают';
    } elseif (strlen($password) < 6) {
        $error = 'Пароль должен быть не менее 6 символов';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Некорректный email';
    } else {
        $conn = getDBConnection();
        
        // Проверка существования пользователя
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = 'Пользователь с таким логином или email уже существует';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            
            if ($stmt->execute()) {
                $success = 'Регистрация успешна! Теперь вы можете войти.';
                $_POST = [];
            } else {
                $error = 'Ошибка при регистрации. Попробуйте позже.';
            }
        }
        
        $stmt->close();
        $conn->close();
    }
}

require_once 'header.php';
?>

<div class="container">
    <div class="form-container">
        <h2 style="text-align: center; margin-bottom: 2rem;">Регистрация</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Логин:</label>
                <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>
            
            <div class="form-group">
                <label for="password_confirm">Подтверждение пароля:</label>
                <input type="password" id="password_confirm" name="password_confirm" required minlength="6">
            </div>
            
            <button type="submit" class="btn-submit">Зарегистрироваться</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem;">
            Уже есть аккаунт? <a href="login.php">Войдите</a>
        </p>
    </div>
</div>

<?php require_once 'footer.php'; ?>

