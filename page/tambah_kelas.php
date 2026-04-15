<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(id_kelas) as kode FROM kelas");
$data = mysqli_fetch_assoc($carikode);
$kode = $data['kode'] ?? 0; 
$kode++; 
$hasilkode = $kode;

if(isset($_POST['tambah'])){
    $id_kelas = $_POST['id_kelas'] ?? '';
    $nm_guru = $_POST['nm_guru'] ?? '';

    $insert = mysqli_query($koneksi, "INSERT INTO kelas (id_kelas, nm_guru) VALUES ('$id_kelas','$nm_guru')");

    if ($insert){
        echo '<div class="alert alert-success alert-dismissible fade show">
                Berhasil Disimpan
              </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }else{
        echo '<div class="alert alert-danger alert-dismissible fade show">
                Gagal Disimpan
              </div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form method="POST">

          <div class="form-group">
            <label>ID Kelas</label>
            <input type="text" name="id_kelas" value="<?= $hasilkode; ?>" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Nama Guru</label>
            <input type="text" name="nm_guru" placeholder="Nama Guru" class="form-control" required>
          </div>

          <button type="submit" name="tambah" class="btn btn-primary">
            Simpan
          </button>

        </form>
      </div>
    </div>
  </div>
</section>