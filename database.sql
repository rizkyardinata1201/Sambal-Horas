CREATE DATABASE IF NOT EXISTS sambal_horas;
USE sambal_horas;

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password)
VALUES ('admin', MD5('horas123'))
ON DUPLICATE KEY UPDATE username = username;

CREATE TABLE IF NOT EXISTS produk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  harga INT NOT NULL,
  stok INT NOT NULL DEFAULT 0,
  gambar VARCHAR(100) DEFAULT NULL
);

INSERT INTO produk (id, nama, harga, stok, gambar) VALUES
(1, 'Sambal Original', 18000, 10, 'kacepeh.jpeg'),
(2, 'Sambal Teri', 20000, 10, 'teri.jpeg'),
(3, 'Sambal Cumi', 25000, 10, 'cumi.jpeg'),
(4, 'Sambal Andaliman', 32000, 10, 'andaliman.jpeg')
ON DUPLICATE KEY UPDATE nama=VALUES(nama), harga=VALUES(harga), gambar=VALUES(gambar);

CREATE TABLE IF NOT EXISTS pesanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_pembeli VARCHAR(100) NOT NULL,
  hp VARCHAR(30) NOT NULL,
  alamat TEXT NOT NULL,
  produk_id INT NOT NULL,
  nama_produk VARCHAR(100) NOT NULL,
  harga INT NOT NULL,
  jumlah INT NOT NULL,
  pembayaran VARCHAR(50) NOT NULL,
  total INT NOT NULL,
  tanggal DATETIME DEFAULT CURRENT_TIMESTAMP
);
