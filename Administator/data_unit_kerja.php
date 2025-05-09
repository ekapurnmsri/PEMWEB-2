<?php
require_once 'dbkoneksi.php';

// Ambil data paramedik beserta nama unit kerjanya
$sql = "SELECT p.*, u.nama AS nama_unit FROM paramedik p
        LEFT JOIN unit_kerja u ON p.unit_kerja_id = u.id";
$paramediks = $dbh->query($sql)->fetchAll();
include_once './layouts/top.php';
include_once './layouts/navbar.php';
include_once './layouts/sidebar.php';
?>
            <style>
  body {
    background-image: url('<?php echo "dist/img/rumah_sakit.jpg"; ?>');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
  }

  .content-wrapper {
    background-color: rgba(0, 0, 0, 0.13); /* Supaya konten tetap terbaca */
    padding: 20px;
    border-radius: 10px;

  }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"><div class="col-sm-6"><h1>Data Paramedik</h1></div></div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="form_paramedik.php" class="btn btn-success">+ Tambah Paramedik</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tmp Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Kategori</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Unit Kerja</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paramediks as $key => $row): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['tmp_lahir'] ?></td>
                            <td><?= $row['tgl_lahir'] ?></td>
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['telepon'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['nama_unit'] ?></td>
                            <td>
                                <a href="form_paramedik.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="proses_unit_kerja.php?id=<?= $row['id'] ?>&proses=hapus"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
