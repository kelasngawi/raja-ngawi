<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit jadwal kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
$id_lama = $_GET['id'] ?? '';

if ($id_lama == '') {
    echo "ID tidak ditemukan";
    exit;
}

$query = mysqli_query($koneksi,"SELECT * FROM jadwal_kelas WHERE id_jadwal='$id_lama'");
$edit = mysqli_fetch_array($query);

if (!$edit) {
    echo "Data tidak ditemukan";
    exit;
}

if(isset($_POST['update'])){
    $id_jadwal = $_POST['id_jadwal'] ?? '';
    $id_kelas = $_POST['id_kelas'] ?? '';
    $thn_ajaran = $_POST['thn_ajaran'] ?? '';

    $update = mysqli_query($koneksi,"
        UPDATE jadwal_kelas 
        SET id_kelas='$id_kelas', thn_ajaran='$thn_ajaran' 
        WHERE id_jadwal='$id_lama'
    ");

    if ($update){
        echo '<div class="alert alert-success">Berhasil Diupdate</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwalkelas">';
    }else{
        echo '<div class="alert alert-danger">Gagal Update</div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form method="POST">

          <div class="form-group">
            <label>id jadwal</label>
            <input type="text" name="id_jadwal" value="<?= $edit['id_jadwal']; ?>" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Id Kelas</label>
            <input type="text" name="id_kelas" value="<?= $edit['id_kelas']; ?>" class="form-control">
          </div>

          <div class="form-group">
            <label>Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" value="<?= $edit['thn_ajaran']; ?>" class="form-control">
          </div>

          <button type="submit" name="update" class="btn btn-primary">
            Update
          </button>

        </form>
      </div>
    </div>
  </div>
</section>