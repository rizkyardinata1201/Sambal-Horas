<?php session_start();
include "koneksi.php";
if (!isset($_SESSION['admin'])) {
    header('Location: login-admin.php');
    exit;
}
mysqli_query($koneksi, "UPDATE produk SET stok=10");
header('Location: admin.php');
exit;
