<?php
require_once 'dbkoneksi.php';

// Ambil data unit kerja
$data_unit_kerja = $dbh->query("SELECT * FROM unit_kerja ORDER BY nama ASC");

// Cek apakah ada id paramedik yang ingin diubah
$paramedik_id = $_GET['id'] ?? 0;
if ($paramedik_id) {
    $sql = "SELECT * FROM paramedik WHERE id = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$paramedik_id]);
    if ($stmt->rowCount()) {
        $paramedik = $stmt->fetch();
        $tombol = "ubah";
    } else {
        header('Location: data_paramedik.php');
        exit;
    }
} else {
    $tombol = "simpan";
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
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Form Paramedik</h1></div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Form Paramedik</h3></div>
            <div class="card-body">
                <form method="POST" action="proses_paramedik.php">
                    <?php if ($paramedik_id): ?>
                        <input type="hidden" name="id" value="<?= $paramedik['id'] ?>">
                    <?php endif; ?>

                    <div class="form-group row">
                        <label for="nama" class="col-4 col-form-label">Nama Lengkap</label>
                        <div class="col-8">
                            <input id="nama" name="nama" type="text" class="form-control" value="<?= $paramedik['nama'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-4">Jenis Kelamin</label>
                        <div class="col-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="gender" id="gender_0" type="radio" class="custom-control-input" value="L" <?= ($paramedik['gender'] ?? '') == 'L' ? 'checked' : '' ?> required>
                                <label for="gender_0" class="custom-control-label">Laki - Laki</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="gender" id="gender_1" type="radio" class="custom-control-input" value="P" <?= ($paramedik['gender'] ?? '') == 'P' ? 'checked' : '' ?>>
                                <label for="gender_1" class="custom-control-label">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tmp_lahir" class="col-4 col-form-label">Tempat Lahir</label>
                        <div class="col-8">
                            <input id="tmp_lahir" name="tmp_lahir" type="text" class="form-control" value="<?= $paramedik['tmp_lahir'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-8">
                            <input id="tgl_lahir" name="tgl_lahir" type="date" class="form-control" value="<?= $paramedik['tgl_lahir'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="kategori" class="col-4 col-form-label">Kategori</label>
                        <div class="col-8">
                            <select id="kategori" name="kategori" class="custom-select" required>
                                <option value="" disabled <?= empty($paramedik['kategori']) ? 'selected' : '' ?>>-- Pilih Kategori --</option>
                                <option value="Dokter" <?= ($paramedik['kategori'] ?? '') == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                <option value="Perawat" <?= ($paramedik['kategori'] ?? '') == 'Perawat' ? 'selected' : '' ?>>Perawat</option>
                                <option value="Asisten" <?= ($paramedik['kategori'] ?? '') == 'Asisten' ? 'selected' : '' ?>>Asisten</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telpon" class="col-4 col-form-label">Telepon</label>
                        <div class="col-8">
                            <input id="telpon" name="telpon" type="text" class="form-control" value="<?= $paramedik['telepon'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-4 col-form-label">Alamat</label>
                        <div class="col-8">
                            <textarea id="alamat" name="alamat" cols="40" rows="3" class="form-control"><?= $paramedik['alamat'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unit_kerja_id" class="col-4 col-form-label">Unit Kerja</label>
                        <div class="col-8">
                            <select id="unit_kerja_id" name="unit_kerja_id" class="custom-select" required>
                                <option value="" disabled <?= empty($paramedik['unit_kerja_id']) ? 'selected' : '' ?>>-- Pilih Unit Kerja --</option>
                                <?php foreach ($data_unit_kerja as $unit_kerja): ?>
                                    <option value="<?= $unit_kerja['id'] ?>" <?= ($paramedik['unit_kerja_id'] ?? '') == $unit_kerja['id'] ? 'selected' : '' ?>>
                                        <?= $unit_kerja['nama'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <input type="submit" name="proses" class="btn btn-primary" value="<?= $tombol ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include_once './layouts/bottom.php'; ?>
