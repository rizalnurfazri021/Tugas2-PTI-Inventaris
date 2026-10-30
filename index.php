<?php
require_once 'auth.php';
require_once 'db.php';

// Proses Delete
if (isset($_GET['delete'])) {
    $id = filter_var($_GET['delete'], FILTER_VALIDATE_INT);
    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);
        $_SESSION['msg'] = __('success_delete');
        header("Location: index.php");
        exit;
    }
}

// Proses Read
$stmt = $pdo->query("SELECT * FROM barang ORDER BY id DESC");
$barang = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= __('title') ?></title>
</head>
<body>
    <h2><?= __('title') ?></h2>
    <p>
        <?= __('welcome') ?>, <b><?= htmlspecialchars($_SESSION['username']) ?></b> | 
        <a href="?lang=id">ID</a> | <a href="?lang=en">EN</a> | 
        <a href="logout.php"><?= __('logout') ?></a>
    </p>

    <?php if(isset($_SESSION['msg'])): ?>
        <p style="color:green;"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></p>
    <?php endif; ?>

    <a href="create.php"><button><?= __('add_item') ?></button></a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th><?= __('code') ?></th>
            <th><?= __('name') ?></th>
            <th><?= __('qty') ?></th>
            <th><?= __('price') ?></th>
            <th><?= __('action') ?></th>
        </tr>
        <?php foreach($barang as $index => $row): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($row['kode_barang']) ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td><?= htmlspecialchars($row['jumlah']) ?></td>
            <td><?= htmlspecialchars($row['harga']) ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>"><?= __('edit') ?></a> | 
                <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('<?= __('confirm_delete') ?>')"><?= __('delete') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>