<?php
require 'dbkoneksi.php';

$kode         = $_POST['kode'] ?? null;
$nama         = $_POST['nama'] ?? null;
$tmp_lahir    = $_POST['tmp_lahir'] ?? null;
$tgl_lahir    = $_POST['tgl_lahir'] ?? null;
$gender       = $_POST['gender'] ?? null;
$kelurahan_id = $_POST['kelurahan_id'] ?? null;
$email        = $_POST['email'] ?? null;
$alamat       = $_POST['alamat'] ?? null;

$_proses = $_POST['proses'] ?? $_GET['proses'] ?? null;

if ($_proses == 'simpan') {
    $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, kelurahan_id, email, alamat)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $kelurahan_id, $email, $alamat]);

} elseif ($_proses == 'ubah') {
    $id = $_POST['id'] ?? null;
    if ($id) {
        $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, kelurahan_id=?, email=?, alamat=?
                WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $kelurahan_id, $email, $alamat, $id]);
    }

} elseif ($_proses == 'hapus') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $sql = "DELETE FROM pasien WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);
    }
}

header("Location: data_pasien.php");
exit;
