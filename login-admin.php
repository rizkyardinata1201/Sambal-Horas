<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['admin'])) {
  header("Location: admin.php");
  exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = mysqli_real_escape_string($koneksi, $_POST["username"]);
  $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

  $password_md5 = md5($password);

  $query = mysqli_query(
    $koneksi,
    "SELECT * FROM admin 
     WHERE username='$username' 
     AND password='$password_md5'"
  );

  if (mysqli_num_rows($query) > 0) {
    $_SESSION["admin"] = $username;
    header("Location: admin.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section class="login-page">
    <div class="login-box">
      <img src="img/logo1.png" alt="Logo">

      <h1>LOGIN ADMIN</h1>

      <?php if ($error != "") { ?>
        <p class="error-login">
          <?php echo $error; ?>
        </p>
      <?php } ?>

      <form method="POST">
        <label>Username</label>
        <input 
          type="text" 
          name="username" 
          placeholder="Masukkan username" 
          required
        >

        <label>Password</label>
        <input 
          type="password" 
          name="password" 
          placeholder="Masukkan password" 
          required
        >

        <button type="submit">MASUK</button>
      </form>

      <a href="index.php" class="back">
        ← Kembali ke Beranda
      </a>
    </div>
  </section>
</body>
</html>