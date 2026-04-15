<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Guru</h1>
      </div>
    </div>
  </div>
</div>
<?php
// kode otomatis
$carikode = mysqli_query($koneksi,"SELECT MAX(kd_guru) as kode FROM guru") or die(mysqli_error($koneksi));
$data = mysqli_fetch_assoc($carikode);

$kode = 0;

if ($data && $data['kode'] != NULL) {
    $nilaikode = substr($data['kode'], 2); // ambil angka setelah "G-"
    $kode = (int) $nilaikode;
}

$kode++;
$hasilkode = "G-" . str_pad($kode, 3, "0", STR_PAD_LEFT);

$_SESSION['KODE'] = $hasilkode;


if(isset($_POST['tambah'])){
    $kd_guru = $_POST['kd_guru'];
    $id_user = $_POST['id_user'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($koneksi,"INSERT INTO guru values ('$kd_guru','$id_user','$nm_guru','$jenkel','$pend_terakhir','$hp','$alamat')");
    if ($insert){
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"
        aria-hidden="true">x</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
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
              <label for="kd_guru">Kode guru</label>
              <input type="text" name="kd_guru" value="<?= $hasilkode; ?>" placeholder="Id Kat" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label for="id_user">id user</label>
              <input type="text" name="id_user" id="id_user" placeholder="Id User" class="form-control">
            <div class="form-group">
              <label for="nm_guru">Nama Guru</label>
              <input type="text" name="nm_guru" id="nm_guru" placeholder="Nama Guru" class="form-control">
            </div>
            <div class="form-group">
              <label for="jenkel">Jenis Kelamin</label>
              <select name="jenkel" id="jenkel" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="pend_terakhir">Pendidikan Terakhir</label>
              <input type="text" name="pend_terakhir" id="pend_terakhir" placeholder="Pendidikan Terakhir" class="form-control">
            </div>
            <div class="form-group">
              <label for="hp">No HP</label>
              <input type="text" name="hp" id="hp" placeholder="No HP" class="form-control">
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control"></textarea>
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