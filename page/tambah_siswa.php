<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data siswa</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_POST['tambah'])){
    $nis = $_POST['nis'];
    $id_user = $_POST['id_user'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];

    // CEK NIS KOSONG
    if($nis == ""){
        echo "<div class='alert alert-danger'>NIS tidak boleh kosong</div>";
    } else {

        // CEK DUPLIKAT NIS
        $cek = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
        if(mysqli_num_rows($cek) > 0){
            echo "<div class='alert alert-danger'>NIS sudah digunakan</div>";
        } else {

            $insert = mysqli_query($koneksi,"INSERT INTO siswa VALUES ('$nis','$id_user','$nm_siswa','$jenkel','$hp','$id_kelas')");

            if ($insert){
                echo '<div class="alert alert-info-dismissible">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <h5><i class="icon fas fa-info"></i> Info </h5>
                <h4>Berhasil Disimpan</h4></div>';
                echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
            }else{
                echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <h5><i class="icon fas fa-info"></i> Info </h5>
                <h4>Gagal Disimpan</h4></div>';
            }

        }
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
              <label for="nis">NIS</label>
              <input type="text" name="nis" placeholder="Masukkan NIS" class="form-control">
            </div>

            <div class="form-group">
              <label for="id_user">id user</label>
              <input type="text" name="id_user" id="id_user" class="form-control">
            </div>

            <div class="form-group">
              <label for="nm_siswa">Nama Siswa</label>
              <input type="text" name="nm_siswa" id="nm_siswa" class="form-control">
            </div>

            <div class="form-group">
              <label for="jenkel">Jenis Kelamin</label>
              <select name="jenkel" id="jenkel" class="form-control">
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div class="form-group">
              <label for="hp">No HP</label>
              <input type="text" name="hp" id="hp" class="form-control">
            </div>

            <div class="form-group">
              <label for="id_kelas">Id Kelas</label>
              <input type="text" name="id_kelas" id="id_kelas" class="form-control">
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