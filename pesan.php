<?php
include "koneksi.php";

$produk_id = isset($_GET['produk_id']) ? intval($_GET['produk_id']) : 0;
$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC");
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Sambal</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<section class="pesan-page">
  <div class="pesan-kiri">
    <img src="img/logo1.png">
    <h1>Pemesanan Sambal</h1>
    <p>Isi data pesanan kamu lalu klik cetak struk.</p>
    <a href="index.php">Beranda</a>
  </div>

  <div class="pesan-kanan">
    <h2>Form Pemesanan</h2>

    <form action="simpan-pesanan.php" method="POST">
      <label>Nama Pembeli</label>
      <input type="text" name="nama" required>

      <label>No WhatsApp</label>
      <input type="text" name="hp" required>

      <label>Alamat</label>
      <textarea name="alamat" required></textarea>

      <label>Pilih Produk</label>
      <select name="produk_id" id="produk" required>
        <option value="">-- Pilih Produk --</option>

        <?php while ($p = mysqli_fetch_assoc($produk)) { ?>
          <option
            value="<?php echo $p['id']; ?>"
            data-stok="<?php echo $p['stok']; ?>"
            <?php echo $produk_id == $p['id'] ? 'selected' : ''; ?>
            <?php echo $p['stok'] <= 0 ? 'disabled' : ''; ?>
          >
            <?php echo $p['nama']; ?> -
            Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?>
            <?php echo $p['stok'] <= 0 ? '(STOK HABIS)' : '- Stok: ' . $p['stok']; ?>
          </option>
        <?php } ?>
      </select>

      <p id="infoStok" class="info-stok-form">
        Pilih produk untuk melihat stok.
      </p>

      <label>Level Pedas</label>
      <select name="level_pedas" required>
        <option value="">-- Pilih Level Pedas --</option>
        <option value="KECEPEH CUPU 🌶️">KECEPEH CUPU 🌶️</option>
        <option value="KECEPEH PRO 🌶️🌶️">KECEPEH PRO 🌶️🌶️</option>
        <option value="KECEPEH SUHU 🌶️🌶️🌶️">KECEPEH SUHU 🌶️🌶️🌶️</option>
      </select>

      <label>Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" value="1" min="1" required>

      <label>Pembayaran</label>
      <select name="bayar" required>
        <option>COD</option>
        <option>Transfer Bank</option>
        <option>DANA / OVO / GOPAY</option>
      </select>

      <button type="submit">CETAK STRUK</button>
    </form>
  </div>
</section>

<script>
  const produk = document.getElementById('produk');
  const infoStok = document.getElementById('infoStok');
  const jumlah = document.getElementById('jumlah');

  function updateStokInfo() {
    const o = produk.options[produk.selectedIndex];

    if (!produk.value) {
      infoStok.innerText = 'Pilih produk untuk melihat stok.';
      infoStok.style.color = '#ffcc00';
      return;
    }

    const s = parseInt(o.getAttribute('data-stok'));

    if (s <= 0) {
      infoStok.innerText = '❌ STOK HABIS';
      infoStok.style.color = 'red';
      jumlah.value = 0;
      jumlah.max = 0;
    } else {
      infoStok.innerText = '✅ Stok tersedia: ' + s;
      infoStok.style.color = '#ffcc00';
      jumlah.max = s;

      if (parseInt(jumlah.value) < 1) {
        jumlah.value = 1;
      }
    }
  }

  produk.addEventListener('change', updateStokInfo);
  updateStokInfo();
</script>

</body>
</html>