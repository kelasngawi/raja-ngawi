<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
  $data = mysqli_fetch_assoc($query);

  if (!$data) {
    echo "<div class='alert alert-danger text-center'>Username tidak ditemukan</div>";
    exit;
  }

  if ($password != $data['password']) {
    echo "<div class='alert alert-danger text-center'>Password salah</div>";
    exit;
  }

  // 🔥 WAJIB GANTI PASSWORD (1234)
  if ($data['password'] == "1234") {

    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    header("location:index.php?page=ganti_password");
    exit;
  }

  // LOGIN NORMAL
  $_SESSION['username'] = $data['username'];
  $_SESSION['role'] = $data['role'];

  if ($data['role'] == "guru") {
    header("location:index.php?page=guru");
  } elseif ($data['role'] == "siswa") {
    header("location:index.php?page=siswa");
  } else {
    header("location:index.php?page=dashboard");
  }

  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <b>Login</b>
  </div>

  <div class="card">
    <div class="card-body login-card-body">

      <?php if (isset($_GET['role']) && $_GET['role'] == 'guru') { ?>
        <p class="login-box-msg"><b>Login Guru</b></p>
      <?php } else { ?>
        <p class="login-box-msg">Login siswa</p>
      <?php } ?>

      <form method="post">

        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>

        <button type="submit" name="login" class="btn btn-primary btn-block">
          Login
        </button>

      </form>

    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>