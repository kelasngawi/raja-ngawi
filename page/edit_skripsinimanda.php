<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit skripsi</h1>
      </div>
    </div>
  </div>
</div>

<?php
$id = $_GET['id'];
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM skripsi_nimanda WHERE id_skripsi078='$id'"));

if(isset($_POST['tambah'])){
    $id_skripsi078 = $_POST['id_skripsi078'];
    $judul_skripsi078 = $_POST['judul_skripsi078'];
    $topik078 = $_POST['topik078'];
    $semester078 = $_POST['semester078'];
    $thn_ajaran078 = $_POST['thn_ajaran078'];

    $insert = mysqli_query($koneksi,"UPDATE skripsi_nimanda SET judul_skripsi078='$judul_skripsi078', topik078='$topik078', semester078='$semester078', thn_ajaran078='$thn_ajaran078' WHERE id_skripsi078='$id_skripsi078'");

    if ($insert){
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_nimanda">';
    }else{
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="card-body p-2">
          <form method="POST" action="">
                        <div class="form-group">
              <label for="id_skripsi078">id Skripsi</label>
              <input type="text" name="id_skripsi078" value="<?= $edit['id_skripsi078']; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="judul_skripsi078">Judul Skripsi</label>
              <input type="text" name="judul_skripsi078" value="<?= $edit['judul_skripsi078']; ?>" id="judul_skripsi078" placeholder="Judul Skripsi" class="form-control">
            </div>
            <div class="form-group">
              <label for="topik078">Topik</label>
              <input type="text" name="topik078" value="<?= $edit['topik078']; ?>" id="topik078" placeholder="Topik" class="form-control">
            </div>
         <div class="form-group">
             <label for="semester078">Semester</label>
              <select name="semester078" id="semester078" class="form-control">
                <option value="">Pilih Semester</option>
                <option value="genap">genap</option>
                <option value="ganjil">ganjil</option>
              </select>
            </div>
            <div class="form-group">
              <label for="thn_ajaran078">Tahun Ajaran</label>
             <select name="thn_ajaran078" id="thn_ajaran078" class="form-control">
                <option value="">Pilih Tahun Ajaran</option>
                <option value="2020/2021">2020/2021</option>
                <option value="2021/2022">2021/2022</option>
                <option value="2022/2023">2022/2023</option>
                <option value="2023/2024">2023/2024</option>
                <option value="2024/2025">2024/2025</option>
                <option value="2025/2026">2025/2026</option>
              </select>
            </div>
            <div class="card-footer">
              <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>