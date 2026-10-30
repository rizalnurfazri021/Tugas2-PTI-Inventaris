<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'id'; 
}
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$lang = [
    'id' => [
        'title' => 'Sistem Inventaris Barang',
        'login' => 'Login',
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Kirim',
        'logout' => 'Logout',
        'add_item' => 'Tambah Barang',
        'edit' => 'Edit',
        'delete' => 'Hapus',
        'code' => 'Kode Barang',
        'name' => 'Nama Barang',
        'qty' => 'Jumlah',
        'price' => 'Harga',
        'action' => 'Aksi',
        'save' => 'Simpan',
        'cancel' => 'Batal',
        'welcome' => 'Selamat datang',
        'error_empty' => 'Semua field harus diisi!',
        'success_add' => 'Data berhasil ditambahkan!',
        'success_edit' => 'Data berhasil diubah!',
        'success_delete' => 'Data berhasil dihapus!',
        'confirm_delete' => 'Apakah Anda yakin ingin menghapus data ini?'
    ],
    'en' => [
        'title' => 'Item Inventory System',
        'login' => 'Login',
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Submit',
        'logout' => 'Logout',
        'add_item' => 'Add Item',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'code' => 'Item Code',
        'name' => 'Item Name',
        'qty' => 'Quantity',
        'price' => 'Price',
        'action' => 'Action',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'welcome' => 'Welcome',
        'error_empty' => 'All fields are required!',
        'success_add' => 'Data added successfully!',
        'success_edit' => 'Data updated successfully!',
        'success_delete' => 'Data deleted successfully!',
        'confirm_delete' => 'Are you sure you want to delete this data?'
    ]
];

function __($key) {
    global $lang;
    return $lang[$_SESSION['lang']][$key] ?? $key;
}
?>