<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">ganti password</h1>
      </div>
    </div>
  </div>
</div>

<?php
include "koneksi.php";

if (!isset($_SESSION['username'])) {
  header("location:login.php");
  exit;
}

if (isset($_POST['simpan'])) {

  $username = $_SESSION['username'];
  $pl = $_POST['pl'];
  $pb = $_POST['pb'];

  // cek password lama
  $cek = mysqli_query($koneksi,
  "SELECT * FROM users WHERE username='$username' AND password='$pl'");

  if (mysqli_num_rows($cek) > 0) {

    // 🔥 UPDATE PASSWORD (SUDAH FIX, TANPA is_default)
    mysqli_query($koneksi,
    "UPDATE users SET password='$pb' WHERE username='$username'");

    echo "<script>alert('Password berhasil diganti');</script>";

    // redirect sesuai role
    if ($_SESSION['role'] == "guru") {
      echo "<script>window.location='index.php?page=guru';</script>";
    } elseif ($_SESSION['role'] == "siswa") {
      echo "<script>window.location='index.php?page=siswa';</script>";
    } else {
      echo "<script>window.location='index.php?page=dashboard';</script>";
    }

    exit;

  } else {
    echo "<div class='alert alert-danger'>Password lama salah</div>";
  }
}
?>

<form method="POST">
  <input type="password" name="pl" placeholder="Password Lama" class="form-control" required><br>
  <input type="password" name="pb" placeholder="Password Baru" class="form-control" required><br>

  <button type="submit" name="simpan" class="btn btn-primary">
    Ganti Password
  </button>
</form>