<?php
require 'dbkoneksi.php';

// Tangkap data dari form
$nama = $_POST['nama'] ?? null;
$gender = $_POST['gender'] ?? null;
$tmp_lahir = $_POST['tmp_lahir'] ?? null;
$tgl_lahir = $_POST['tgl_lahir'] ?? null;
$kategori = $_POST['kategori'] ?? null;
$telepon = $_POST['telpon'] ?? null;
$alamat = $_POST['alamat'] ?? null;
$unit_kerja_id = $_POST['unit_kerja_id'] ?? null;
$id = $_POST['id'] ?? $_GET['id'] ?? null;
$proses = $_POST['proses'] ?? $_GET['proses'] ?? null;

try {
    if ($proses == 'simpan') {
        // Menyimpan data paramedik baru
        $sql = "INSERT INTO paramedik (nama, gender, tmp_lahir, tgl_lahir, kategori, telepon, alamat, unit_kerja_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$nama, $gender, $tmp_lahir, $tgl_lahir, $kategori, $telepon, $alamat, $unit_kerja_id]);

    } elseif ($proses == 'ubah') {
        // Mengubah data paramedik
        $sql = "UPDATE paramedik SET nama = ?, gender = ?, tmp_lahir = ?, tgl_lahir = ?, kategori = ?, telepon = ?, alamat = ?, unit_kerja_id = ? WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$nama, $gender, $tmp_lahir, $tgl_lahir, $kategori, $telepon, $alamat, $unit_kerja_id, $id]);

    } elseif ($proses == 'hapus' && $id) {
        // Menghapus data paramedik
        $sql = "DELETE FROM paramedik WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$id]);
    }

    // Redirect ke halaman data paramedik setelah berhasil
    header("Location: data_unit_kerja.php");

    exit;

} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
