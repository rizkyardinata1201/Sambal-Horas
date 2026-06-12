<?php
include "koneksi.php";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: pesan.php');
    exit;
}
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$produk_id = intval($_POST['produk_id']);
$jumlah = intval($_POST['jumlah']);
$bayar = mysqli_real_escape_string($koneksi, $_POST['bayar']);
$q = mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$produk_id");
$p = mysqli_fetch_assoc($q);
if (!$p) {
    echo "<script>alert('Produk tidak ditemukan!');window.location='pesan.php';</script>";
    exit;
}
if ($p['stok'] <= 0) {
    echo "<script>alert('Maaf, stok " . $p['nama'] . " sudah habis!');window.location='pesan.php';</script>";
    exit;
}
if ($jumlah <= 0) {
    echo "<script>alert('Jumlah pesanan minimal 1!');window.location='pesan.php';</script>";
    exit;
}
if ($jumlah > $p['stok']) {
    echo "<script>alert('Stok tidak cukup! Sisa stok " . $p['nama'] . " tinggal " . $p['stok'] . "');window.location='pesan.php';</script>";
    exit;
}
$nama_produk = mysqli_real_escape_string($koneksi, $p['nama']);
$harga = intval($p['harga']);
$total = $harga * $jumlah;
$sisa = $p['stok'] - $jumlah;
mysqli_query($koneksi, "UPDATE produk SET stok=$sisa WHERE id=$produk_id");
$simpan = mysqli_query($koneksi, "INSERT INTO pesanan(nama_pembeli,hp,alamat,produk_id,nama_produk,harga,jumlah,pembayaran,total) VALUES('$nama','$hp','$alamat',$produk_id,'$nama_produk',$harga,$jumlah,'$bayar',$total)");
if ($simpan) {
    $id = mysqli_insert_id($koneksi);
    header("Location: struk.php?id=$id");
    exit;
} else {
    echo 'Gagal menyimpan pesanan: ' . mysqli_error($koneksi);
}
