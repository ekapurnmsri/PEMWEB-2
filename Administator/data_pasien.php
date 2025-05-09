<?php
require_once 'dbkoneksi.php';

$sql = 'SELECT pasien.*, kelurahan.nama AS nama_kelurahan 
        FROM pasien 
        LEFT JOIN kelurahan ON pasien.kelurahan_id = kelurahan.id';
$getPasien = $dbh->query($sql);

include_once './layouts/top.php';
include_once './layouts/navbar.php';
include_once './layouts/sidebar.php';
?>

<style>
  body {
    background-image: url('dist/img/rumah_sakit.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
  }
  .content-wrapper {
    background-color: rgba(0, 0, 0, 0.13);
    padding: 20px;
    border-radius: 10px;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1>Data Pasien</h1></div>
        <div class="col-sm-6 text-right">
          <a href="form_pasien.php" class="btn btn-success">+ Tambah Pasien</a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-header"><h3 class="card-title">Daftar Pasien</h3></div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Kelurahan</th>
              <th>Alamat</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($getPasien as $key => $pasien): ?>
            <tr>
              <td><?= ++$key ?></td>
              <td><?= $pasien['kode'] ?></td>
              <td><?= $pasien['nama'] ?></td>
              <td><?= $pasien['tmp_lahir'] ?></td>
              <td><?= $pasien['tgl_lahir'] ?></td>
              <td><?= $pasien['gender'] ?></td>
              <td><?= $pasien['nama_kelurahan'] ?></td>
              <td><?= $pasien['alamat'] ?></td>
              <td><?= $pasien['email'] ?></td>
              <td>
                <a href="form_pasien.php?id=<?= $pasien['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                <a href="proses_pasien.php?id=<?= $pasien['id'] ?>&proses=hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<?php include_once './layouts/bottom.php'; ?>
