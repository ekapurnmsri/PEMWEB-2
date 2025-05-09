<?php
require_once 'dbkoneksi.php';

$sql = "SELECT * FROM periksa";
$data = $dbh->query($sql);

include_once './layouts/top.php';
include_once './layouts/navbar.php';
include_once './layouts/sidebar.php';
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Pemeriksaan</h1></div>
        <div class="col-sm-6 text-right">
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-header"><h3 class="card-title">Data Pemeriksaan</h3></div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tanggal</th>
              <th>Berat</th>
              <th>Tinggi</th>
              <th>Tensi</th>
              <th>Keterangan</th>
              <th>Pasien ID</th>
              <th>Dokter ID</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data as $row): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['tanggal'] ?></td>
              <td><?= $row['berat'] ?></td>
              <td><?= $row['tinggi'] ?></td>
              <td><?= $row['tensi'] ?></td>
              <td><?= $row['keterangan'] ?></td>
              <td><?= $row['pasien_id'] ?></td>
              <td><?= $row['dokter_id'] ?></td>
              <td>
                <a href="form_periksa.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Ubah</a>
                <a href="proses_unit_kerja.php?id=<?= $row['id'] ?>&proses=hapus" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php include_once './layouts/bottom.php'; ?>
