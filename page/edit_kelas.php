<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit kelas</h1>
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

$query = mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_kelas='$id_lama'");
$edit = mysqli_fetch_array($query);

if (!$edit) {
    echo "Data tidak ditemukan";
    exit;
}

if(isset($_POST['update'])){
    $id_kelas = $_POST['id_kelas'] ?? '';
    $nm_guru = $_POST['nm_guru'] ?? '';

    $update = mysqli_query($koneksi,"
        UPDATE kelas 
        SET id_kelas='$id_kelas', nm_guru='$nm_guru' 
        WHERE id_kelas='$id_lama'
    ");

    if ($update){
        echo '<div class="alert alert-success">Berhasil Diupdate</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
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
            <label>ID Kelas</label>
            <!-- SEKARANG BISA DIEDIT -->
            <input type="text" name="id_kelas" value="<?= $edit['id_kelas']; ?>" class="form-control">
          </div>

          <div class="form-group">
            <label>Nama Guru</label>
            <input type="text" name="nm_guru" value="<?= $edit['nm_guru']; ?>" class="form-control">
          </div>

          <button type="submit" name="update" class="btn btn-primary">
            Update
          </button>

        </form>
      </div>
    </div>
  </div>
</section>