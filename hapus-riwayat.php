<?php session_start();
include "koneksi.php";
if (!isset($_SESSION['admin'])) {
    header('Location: login-admin.php');
    exit;
}
mysqli_query($koneksi, "DELETE FROM pesanan");
header('Location: admin.php');
exit;
