<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Skripsi</h1>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM skripsi_nimanda WHERE id_skripsi078='$id'");
        if ($query){
        echo '
        <div class="alert alert-warning alert-dismissible">
              berhasil di hapus </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi_nimanda">';
    }
}
}
?>
<div class="content">
    <div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_skripsinimanda" class="btn btn-primary btn-sm">
        Tambah Skripsi</a>
      <table class="table table-striped">
        <tread>
          <tr>
            <th>NO</th>
            <th>Id Skripsi078</th>
            <th>Judul Skripsi078</th>
            <th>Topik078</th>
            <th>Semester078</th>
            <th>Thn Ajaran078</th>
            <th>Aksi</th>
          </tr>
        </tread>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi,"SELECT * FROM skripsi_nimanda");
        while ($result = mysqli_fetch_array($query) ) {
          $no++;
        ?>
        <tbody>
          <tr>
            <td><?= $no;?></td>
            <td><?= $result['id_skripsi078']; ?></td>
            <td><?= $result['judul_skripsi078']; ?></td>
            <td><?= $result['topik078']; ?></td>
            <td><?= $result['semester078']; ?></td>
            <td><?= $result['thn_ajaran078']; ?></td>
            <td>
              <a href="index.php?page=skripsi_nimanda&action=hapus&id=<?= $result['id_skripsi078'] ?>"
                title="">
                <span class="badge badge-danger">Hapus</span></a>
              <a href="index.php?page=edit_skripsinimanda&id=<?= $result['id_skripsi078'] ?>" title="">
                <span class="badge badge-warning">Edit</span></a>
            </td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
    </div>
  </div>
</div>