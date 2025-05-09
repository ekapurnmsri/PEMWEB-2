<?php
require_once 'dbkoneksi.php';

$data_kelurahan = $dbh->query("SELECT * FROM kelurahan ORDER BY nama ASC");

$pasien_id = $_GET['id'] ?? 0;
if ($pasien_id) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->execute([$pasien_id]);
    $pasien = $stmt->fetch();
    $proses = "ubah";
} else {
    $proses = "simpan";
}

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
      <h1><?= $proses == 'ubah' ? 'Edit' : 'Tambah' ?> Pasien</h1>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="proses_pasien.php">
          <input type="hidden" name="proses" value="<?= $proses ?>">
          <?php if ($proses == 'ubah'): ?>
            <input type="hidden" name="id" value="<?= $pasien['id'] ?>">
          <?php endif; ?>

          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="<?= $pasien['kode'] ?? '' ?>" required>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $pasien['nama'] ?? '' ?>" required>
          </div>
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lahir" class="form-control" value="<?= $pasien['tmp_lahir'] ?? '' ?>" required>
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="<?= $pasien['tgl_lahir'] ?? '' ?>" required>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label><br>
            <label><input type="radio" name="gender" value="L" <?= ($pasien['gender'] ?? '') == 'L' ? 'checked' : '' ?>> Laki-laki</label>
            <label><input type="radio" name="gender" value="P" <?= ($pasien['gender'] ?? '') == 'P' ? 'checked' : '' ?>> Perempuan</label>
          </div>
          <div class="form-group">
            <label>Kelurahan</label>
            <select name="kelurahan_id" class="form-control" required>
              <option value="">-- Pilih Kelurahan --</option>
              <?php foreach ($data_kelurahan as $kelurahan): ?>
                <option value="<?= $kelurahan['id'] ?>" <?= ($pasien['kelurahan_id'] ?? '') == $kelurahan['id'] ? 'selected' : '' ?>>
                  <?= $kelurahan['nama'] ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $pasien['email'] ?? '' ?>" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $pasien['alamat'] ?? '' ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary"><?= ucfirst($proses) ?></button>
        </form>
      </div>
    </div>
  </section>
</div>

<?php include_once './layouts/bottom.php'; ?>
