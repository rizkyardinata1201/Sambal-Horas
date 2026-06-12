<?php include "koneksi.php";
$produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC"); ?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sambal Horas Pedas</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <header class="navbar">
        <div class="logo" id="hiddenAdmin"><img src="img/logo1.png"></div>
        <nav><a href="#" class="active">BERANDA</a><a href="#produk">PRODUK</a><a href="#level">LEVEL PEDAS</a><a href="#tentang">TENTANG KAMI</a><a href="#kontak">KONTAK</a></nav><a href="pesan.php" class="btn-order">🛒 ORDER SEKARANG</a>
    </header>
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content"><img src="img/logo1.png" class="hero-logo">
            <h2>SAMBAL</h2>
            <h1>HORAS</h1>
            <h3>PEDAS</h3>
            <div class="tagline">PEDASNYA BIKIN HORAS!</div>
        </div>
    </section>
    <section class="content produk-section" id="produk">
        <h2>PRODUK KAMI</h2>
        <div class="produk-grid">
            <?php while ($p = mysqli_fetch_assoc($produk)) { ?>
                <div class="produk-card <?php echo $p['stok'] <= 0 ? 'habis-card' : ''; ?>"><img src="img/<?php echo $p['gambar']; ?>">
                    <h3><?php echo strtoupper($p['nama']); ?></h3>
                    <p>Pedas gurih khas Sambal Horas Pedas, cocok untuk teman makan kamu.</p><?php if ($p['stok'] <= 0) { ?><small class="stok-info stok-habis">STOK HABIS</small><a href="#" class="harga-link habis-btn">STOK HABIS</a><?php } else { ?><small class="stok-info">Stok: <b><?php echo $p['stok']; ?></b></small><a href="pesan.php?produk_id=<?php echo $p['id']; ?>" class="harga-link">Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?></a><?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="content level-section" id="level">
        <h2>LEVEL PEDAS</h2>
        <div class="level-grid">
            <div class="level-card hijau">
                <div class="level-icon">😋</div>
                <h3>KECEPEH CUPU</h3>
                <p>Pedas ringan, cocok untuk pemula.</p><b>🌶️</b>
            </div>
            <div class="level-card kuning">
                <div class="level-icon">😎</div>
                <h3>KECEPEH PRO</h3>
                <p>Pedas sedang, rasa pas dan nagih.</p><b>🌶️🌶️</b>
            </div>
            <div class="level-card merah">
                <div class="level-icon">🔥</div>
                <h3>KECEPEH SUHU</h3>
                <p>Pedas nampol untuk pecinta sambal sejati.</p><b>🌶️🌶️🌶️</b>
            </div>
        </div>
    </section>
    <section class="content tentang-section" id="tentang">
        <div>
            <h2>TENTANG KAMI</h2>
            <p>Sambal Horas Pedas hadir dengan rasa autentik khas Nusantara. Dibuat menggunakan bahan berkualitas dan resep tradisional untuk menghasilkan sambal pedas yang bikin HORAS!</p>
        </div><img src="img/logo1.png">
    </section>
    <footer class="kontak-section" id="kontak">
        <div>
            <h3>WHATSAPP</h3>
            <p>0882 0182 06234</p>
        </div>
        <div>
            <h3>INSTAGRAM</h3>
            <p>@sambalhoraspedas</p>
        </div>
        <div>
            <h3>PENGIRIMAN</h3>
            <p>Medan & Seluruh Indonesia</p>
        </div>
    </footer>
    <script>
        let klikLogo = 0;

        document.getElementById("hiddenAdmin").addEventListener("click", function() {
            klikLogo++;

            if (klikLogo >= 1) {
                window.location.href = "login-admin.php";
            }

            setTimeout(() => {
                klikLogo = 0;
            }, 3000);
        });
    </script>
</body>

</html>