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
$kd = $_GET['id'];
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM jadwal_kelas WHERE kd_jadwal='$kd'"));

if (isset($_POST['update'])) {

    $kd_jadwal = $_POST['kd_jadwal'];
    $id_kelas = $_POST['id_kelas'];
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];

    $kd_mapel = $_POST['kd_mapel'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $kelas = $_POST['kelas'];

    // Update tabel jadwal
    $updatejadwal = mysqli_query($koneksi, "UPDATE jadwal_kelas SET id_kelas='$id_kelas', semester='$semester', thn_ajaran='$thn_ajaran' WHERE kd_jadwal='$kd_jadwal'");

    if (!$updatejadwal) {
        echo "Gagal update tabel jadwal: " . mysqli_error($koneksi);
        die;
    }

    // Update detailjadwal
    $allSuccess = true;
    for ($i = 0; $i < count($kd_mapel); $i++) {
        $update = mysqli_query($koneksi, "UPDATE detailjadwal SET kd_mapel='{$kd_mapel[$i]}', Hari='{$hari[$i]}', Jam='{$jam[$i]}', Kelas='{$kelas[$i]}' WHERE kd_jadwal='$kd_jadwal' AND kd_mapel='{$kd_mapel[$i]}'");

        if (!$update) {
            $allSuccess = false;
            echo "Gagal update detail ke-{$i}: " . mysqli_error($koneksi);
        }
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwalkelas">';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Gagal menyimpan sebagian atau seluruh data detail.</h4></div>';
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h3>edit Jadwal</h3>

                <form method="POST" action="">
                    <div class="form-group">
                        <label>Kode Jadwal</label>
                        <input type="text" name="kd_jadwal" value="<?= $edit['kd_jadwal'] ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="id_kelas" class="form-control">
                            <?php
                            $guru = mysqli_query($koneksi, "SELECT * FROM guru");
                            while ($g = mysqli_fetch_assoc($guru)) {
                                echo "<option value='{$g['kd_guru']}'>{$g['nm_guru']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option selected disabled>--Pilih semester--</option>
                            <option>Ganjil</option>
                            <option>Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control" required>
                            <option selected disabled>--Pilih Tahun Ajaran--</option>
                            <option>2024-2025</option>
                            <option>2025-2026</option>
                        </select>
                    </div>

                    <hr>

                    <h5>Detail Jadwal</h5>

                    <div id="detail-jadwal">
                        <div class="row mb-2">

                            <div class="col-md-3">
                                <select name="kd_mapel[]" class="form-control">
                                    <option selected disabled>--Pilih Mapel--</option>
                                    <?php
                                    $mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                                    while ($m = mysqli_fetch_assoc($mapel)) {
                                        echo "<option value='{$m['kd_mapel']}'>{$m['nm_mapel']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="hari[]" class="form-control" required>
                                    <option selected disabled>--Pilih Hari--</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="jam[]" class="form-control" required>
                                    <option selected disabled>--Pilih Jam--</option>
                                    <option>08.00-10.00</option>
                                    <option>08.00-09.30</option>
                                    <option>10.30-12.00</option>
                                    <option>12.30-14.00</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="kelas[]" class="form-control" required>
                                    <option selected disabled>--Pilih Kelas--</option>
                                    <option>gb1</option>
                                    <option>gb2</option>
                                    <option>gb3</option>
                                    <option>gb4</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="kelas[]" class="form-control" placeholder="Kelas" required>
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-info" onclick="tambahBaris()">+ Tambah Mapel</button>

                    <input type="submit" class="btn btn-primary" name="update" value="update">
                </form>

                <script>
                function tambahBaris() {
                    let row = document.getElementById('detail-jadwal');
                    let rowClone = row.firstElementChild.cloneNode(true);
                    rowClone.querySelectorAll('input').forEach(input => input.value = '');
                    row.appendChild(rowClone);
                }
                </script>

            </div>
        </div>
    </div>
</div>