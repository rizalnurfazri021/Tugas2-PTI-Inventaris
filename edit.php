<?php
require_once 'auth.php';
require_once 'db.php';

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if (!$id) { header("Location: index.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) { header("Location: index.php"); exit; }

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode = htmlspecialchars(trim($_POST['kode_barang']));
    $nama = htmlspecialchars(trim($_POST['nama_barang']));
    $jumlah = filter_var($_POST['jumlah'], FILTER_VALIDATE_INT);
    $harga = filter_var($_POST['harga'], FILTER_VALIDATE_FLOAT);

    if (empty($kode) || empty($nama) || $jumlah === false || $harga === false) {
        $error = __('error_empty');
    } else {
        $stmt = $pdo->prepare("UPDATE barang SET kode_barang=?, nama_barang=?, jumlah=?, harga=? WHERE id=?");
        $stmt->execute([$kode, $nama, $jumlah, $harga, $id]);
        $_SESSION['msg'] = __('success_edit');
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title><?= __('edit') ?></title></head>
<body>
    <h2><?= __('edit') ?></h2>
    <?php if($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    
    <form method="POST">
        <label><?= __('code') ?></label><br>
        <input type="text" name="kode_barang" value="<?= htmlspecialchars($data['kode_barang']) ?>" required><br><br>
        
        <label><?= __('name') ?></label><br>
        <input type="text" name="nama_barang" value="<?= htmlspecialchars($data['nama_barang']) ?>" required><br><br>
        
        <label><?= __('qty') ?></label><br>
        <input type="number" name="jumlah" value="<?= htmlspecialchars($data['jumlah']) ?>" required><br><br>
        
        <label><?= __('price') ?></label><br>
        <input type="number" step="0.01" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" required><br><br>
        
        <button type="submit"><?= __('save') ?></button>
        <a href="index.php"><?= __('cancel') ?></a>
    </form>
</body>
</html>