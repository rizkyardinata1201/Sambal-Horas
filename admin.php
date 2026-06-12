<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['admin'])) {
    header('Location: login-admin.php');
    exit;
}
$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC");
$pesanan = mysqli_query($koneksi, "SELECT * FROM pesanan ORDER BY id DESC");
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sambal Horas Pedas</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="admin-page">
        <div class="admin-box">
            <h1>ADMIN SAMBAL HORAS PEDAS</h1>
            <p>Kelola stok barang dan lihat riwayat pesanan pembeli.</p>
            <h2 class="admin-title">STOK BARANG</h2>
            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody><?php $no = 1;
                            while ($p = mysqli_fetch_assoc($produk)) { ?><tr>
                                <form action="update-stok.php" method="POST">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $p['nama']; ?></td>
                                    <td>Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?></td>
                                    <td><input type="hidden" name="id" value="<?php echo $p['id']; ?>"><input type="number" name="stok" min="0" value="<?php echo $p['stok']; ?>"></td>
                                    <td><?php if ($p['stok'] <= 0) { ?><span class="status-habis">STOK HABIS</span><?php } else { ?><span class="status-ada">Tersedia</span><?php } ?></td>
                                    <td><button type="submit">Simpan</button></td>
                                </form>
                            </tr><?php } ?></tbody>
                </table>
            </div>
            <div class="admin-actions"><a href="reset-stok.php" onclick="return confirm('Reset semua stok menjadi 10?')">Reset Semua Stok</a><a href="index.php">Lihat Website</a><a href="hapus-riwayat.php" onclick="return confirm('Hapus semua riwayat pesanan?')">Hapus Riwayat</a><a href="logout.php">Logout Admin</a></div>
            <h2 class="admin-title">RIWAYAT PESANAN</h2>
            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody><?php if (mysqli_num_rows($pesanan) == 0) { ?><tr>
                                <td colspan="9">Belum ada pesanan</td>
                            </tr><?php } else {
                                    $no = 1;
                                    while ($r = mysqli_fetch_assoc($pesanan)) { ?><tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $r['tanggal']; ?></td>
                                    <td><?php echo $r['nama_pembeli']; ?></td>
                                    <td><?php echo $r['hp']; ?></td>
                                    <td><?php echo $r['alamat']; ?></td>
                                    <td><?php echo $r['nama_produk']; ?></td>
                                    <td><?php echo $r['jumlah']; ?></td>
                                    <td><?php echo $r['pembayaran']; ?></td>
                                    <td>Rp <?php echo number_format($r['total'], 0, ',', '.'); ?></td>
                                </tr><?php }
                                } ?></tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>