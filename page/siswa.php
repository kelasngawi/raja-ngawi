<?php
include "koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'siswa') {
  echo "<script>window.location='login.php?role=siswa';</script>";
  exit;
}

// ambil data user
$user = $_SESSION['username'];
$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$user'");
$data = mysqli_fetch_assoc($cek);

// 🔥 WAJIB GANTI PASSWORD
if ($data['password'] == "1234") {
  echo "<script>window.location='index.php?page=ganti_password';</script>";
  exit;
}
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Siswa</h1>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_GET['action']) && $_GET['action'] == "hapus") {
    $nis = $_GET['nis'];
    $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");

    if ($query) {
      echo '<div class="alert alert-warning">Berhasil dihapus</div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    }
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">

        <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm">
          Tambah Siswa
        </a>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>ID User</th>
              <th>Nama Siswa</th>
              <th>Jenis Kelamin</th>
              <th>HP</th>
              <th>Kelas</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $no = 0;
          $query = mysqli_query($koneksi,
          "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas");

          while ($result = mysqli_fetch_array($query)) {
            $no++;
          ?>
            <tr>
              <td><?= $no; ?></td>
              <td><?= $result['nis']; ?></td>
              <td><?= $result['id_user']; ?></td>
              <td><?= $result['nm_siswa']; ?></td>
              <td><?= $result['jenkel']; ?></td>
              <td><?= $result['hp']; ?></td>
              <td><?= $result['nm_kelas']; ?></td>
              <td>
                <a href="index.php?page=siswa&action=hapus&nis=<?= $result['nis'] ?>">
                  <span class="badge badge-danger">Hapus</span>
                </a>

                <a href="index.php?page=edit_siswa&nis=<?= $result['nis'] ?>">
                  <span class="badge badge-warning">Edit</span>
                </a>
              </td>
            </tr>
          <?php } ?>
          </tbody>

        </table>

      </div>
    </div>
  </div>
</div>