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
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal='$id'");
        if ($query){
        echo '
        <div class="alert alert-warning alert-dismissible">
              berhasil di hapus </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwalkelas">';
    }
}
}
?>
<div class="content">
    <div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_jadwalkelas" class="btn btn-primary btn-sm">
        Tambah Jadwal</a>
      <table class="table table-striped">
        <tread>
          <tr>
            <th>NO</th>
            <th>id jadwal</th>
            <th>id kelas</th>
            <th>tahun ajaran</th>
            <th>Aksi</th>
          </tr>
        </tread>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi,"SELECT * FROM jadwal_kelas");
        while ($result = mysqli_fetch_array($query) ) {
          $no++;
        ?>
        <tbody>
          <tr>
            <td><?= $no;?></td>
            <td><?= $result['id_jadwal']; ?></td>
            <td><?= $result['id_kelas']; ?></td>
            <td><?= $result['thn_ajaran']; ?></td>
            <td>
              <a href="index.php?page=jadwalkelas&action=hapus&id=<?= $result['id_jadwal'] ?>"
                title="">
                <span class="badge badge-danger">Hapus</span></a>
              <a href="index.php?page=edit_jadwalkelas&id=<?= $result['id_jadwal'] ?>" title="">
                <span class="badge badge-warning">Edit</span></a>
            </td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
    </div>
  </div>
</div>