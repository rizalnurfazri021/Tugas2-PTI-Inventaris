<?php
require_once 'db.php'; 

$username = 'admin';
$password = 'admin123'; 

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo->exec("DELETE FROM users WHERE username = 'admin'");
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashed_password]);
    
    echo "<h1>BERHASIL!</h1>";
    echo "Silakan <a href='login.php'>Login di sini</a> dengan Username: <b>admin</b> dan Password: <b>admin123</b>";
} catch (PDOException $e) {
    echo "Gagal membuat user: " . $e->getMessage();
}
?>