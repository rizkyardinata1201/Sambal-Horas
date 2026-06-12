<?php include "koneksi.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$q = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id=$id");
$p = mysqli_fetch_assoc($q);
if (!$p) {
    echo "<script>alert('Data struk tidak ditemukan!');window.location='pesan.php';</script>";
    exit;
}
$s = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT stok FROM produk WHERE id=" . intval($p['produk_id'])));
$sisa = $s ? $s['stok'] : 0; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="struk-page">
        <div class="struk-box"><img src="img/logo1.png">
            <h2>STRUK PEMESANAN</h2>
            <hr>
            <p>Nama: <span><?php echo $p['nama_pembeli']; ?></span></p>
            <p>No HP: <span><?php echo $p['hp']; ?></span></p>
            <p>Alamat: <span><?php echo $p['alamat']; ?></span></p>
            <p>Produk: <span><?php echo $p['nama_produk']; ?></span></p>
            <p>Jumlah: <span><?php echo $p['jumlah']; ?></span></p>
            <p>Pembayaran: <span><?php echo $p['pembayaran']; ?></span></p>
            <p>Sisa Stok: <span><?php echo $sisa; ?></span></p>
            <p>Tanggal: <span><?php echo $p['tanggal']; ?></span></p>
            <hr>
            <h3>Total: Rp <?php echo number_format($p['total'], 0, ',', '.'); ?></h3><button onclick="window.print()">PRINT STRUK</button><a href="pesan.php" class="btn-kembali">Pesan Lagi</a><a href="index.php" class="btn-kembali">Beranda</a>
        </div>
    </section>
</body>

</html>