<?php
require_once 'auth.php';
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitasi Input
    $kode = htmlspecialchars(trim($_POST['kode_barang']));
    $nama = htmlspecialchars(trim($_POST['nama_barang']));
    $jumlah = filter_var($_POST['jumlah'], FILTER_VALIDATE_INT);
    $harga = filter_var($_POST['harga'], FILTER_VALIDATE_FLOAT);

    // Validasi Kelengkapan Data
    if (empty($kode) || empty($nama) || $jumlah === false || $harga === false) {
        $error = __('error_empty');
    } else {
        $stmt = $pdo->prepare("INSERT INTO barang (kode_barang, nama_barang, jumlah, harga) VALUES (?, ?, ?, ?)");
        $stmt->execute([$kode, $nama, $jumlah, $harga]);
        $_SESSION['msg'] = __('success_add');
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title><?= __('add_item') ?></title></head>
<body>
    <h2><?= __('add_item') ?></h2>
    <?php if($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    
    <form method="POST">
        <label><?= __('code') ?></label><br>
        <input type="text" name="kode_barang" required><br><br>
        
        <label><?= __('name') ?></label><br>
        <input type="text" name="nama_barang" required><br><br>
        
        <label><?= __('qty') ?></label><br>
        <input type="number" name="jumlah" required><br><br>
        
        <label><?= __('price') ?></label><br>
        <input type="number" step="0.01" name="harga" required><br><br>
        
        <button type="submit"><?= __('save') ?></button>
        <a href="index.php"><?= __('cancel') ?></a>
    </form>
</body>
</html>