<?php session_start();
include "koneksi.php";
if (!isset($_SESSION['admin'])) {
    header('Location: login-admin.php');
    exit;
}
$id = intval($_POST['id']);
$stok = intval($_POST['stok']);
if ($stok < 0) $stok = 0;
mysqli_query($koneksi, "UPDATE produk SET stok=$stok WHERE id=$id");
header('Location: admin.php');
exit;
