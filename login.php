<?php
require_once 'db.php';
require_once 'lang.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = __('error_empty');
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Username / Password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= __('title') ?> - Login</title>
</head>
<body>
    <h2><?= __('login') ?></h2>
    <p><a href="?lang=id">ID</a> | <a href="?lang=en">EN</a></p>
    <?php if($error): ?><p style="color:red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
    <form method="POST">
        <label><?= __('username') ?></label><br>
        <input type="text" name="username" required><br><br>
        <label><?= __('password') ?></label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit"><?= __('login') ?></button>
    </form>
</body>
</html>