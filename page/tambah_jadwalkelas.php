<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Jadwal Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
// kode otomatis (ID angka)
$carikode = mysqli_query($koneksi,"SELECT MAX(id_jadwal) FROM jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if($datakode && $datakode[0] != null){
    $hasilkode = (int)$datakode[0] + 1;
} else {
    $hasilkode = 1;
}

if(isset($_POST['tambah'])){
    $id_jadwal = $_POST['id_jadwal'];
    $id_kelas = $_POST['id_kelas'];
    $thn_ajaran= $_POST['thn_ajaran'];

    $insert = mysqli_query($koneksi,"INSERT INTO jadwal_kelas 
    (id_jadwal, id_kelas, thn_ajaran) 
    VALUES ('$id_jadwal','$id_kelas','$thn_ajaran')");

    if ($insert){
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h5>Berhasil Disimpan</h5></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwalkelas">';
    }else{
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h5>Gagal Disimpan</h5></div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="">
          
          <div class="form-group">
            <label>ID Jadwal</label>
            <input type="text" name="id_jadwal" value="<?= $hasilkode; ?>" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Id Kelas</label>
            <input type="text" name="id_kelas" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" class="form-control" required>
          </div>

          <div class="card-footer">
            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
          </div>

        </form>
      </div>
    </div>
  </div>
</section>