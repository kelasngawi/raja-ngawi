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
// 🔥 ambil angka terakhir dengan cara BENAR (bukan MAX string)
$carikode = mysqli_query($koneksi,"
SELECT MAX(CAST(SUBSTRING(nis,3) AS UNSIGNED)) as kode FROM siswa
") or die(mysqli_error($koneksi));

$datakode = mysqli_fetch_array($carikode);

if($datakode['kode'] != null){
    $kode = $datakode['kode'] + 1;
}else{
    $kode = 1;
}

$hasilkode = "M-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
$nis = $hasilkode;

// 🔥 proses simpan
if(isset($_POST['tambah'])){
    $nis = $hasilkode;
    $id_user = $_POST['id_user'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];
{

{


    $insert = mysqli_query($koneksi, "INSERT INTO siswa (nis,id_user,nm_siswa,jenkel,hp,id_kelas) VALUES ('$nis','$id_user','$nm_siswa','$jenkel','$hp','$id_kelas')");
    $insertUsers = mysqli_query($koneksi,"INSERT INTO users (username,password,role) VALUES ('$nis','1234','siswa')");

    if ($insert && $insertUsers){
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
              <input type="text" name="nis" value="<?= isset($nis) ? $nis : '' ?>" class="form-control" readonly>
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
              <input type="number" name="hp" id="hp" class="form-control">
            </div>

            <div class="form-group">
              <label for="id_kelas">Id Kelas</label>
               <div class="form-group">
            <select class="form-control" name="id_kelas" required>
              <option value="" disabled selected>-- Pilih Kelas --</option>

              <?php
              // ambil data dari tabel kelas
              $getkelas = mysqli_query($koneksi, "SELECT * FROM kelas");

              // looping data
              while ($returnkelas = mysqli_fetch_array($getkelas)) {
              ?>
                <option value="<?= $returnkelas['id_kelas']; ?>">
                  <?= $returnkelas['nm_kelas']; ?>
                </option>
              <?php } ?>

            </select>
          </div>
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