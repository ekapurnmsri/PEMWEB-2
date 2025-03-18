<?php 
require_once 'nilai_mahasiswa.php';

$data_mhs = [];

// Data awal
$data_mhs[] = new NilaiMahasiswa("Hakim", "Pemrograman Web", 85, 25, 30);
$data_mhs[] = new NilaiMahasiswa("Siti", "Pemrograman Web", 23, 32, 54);
$data_mhs[] = new NilaiMahasiswa("Mamas", "Pemrograman Web", 75, 89, 90);

// Proses form jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"] ?? "";
    $matakuliah = $_POST["matakuliah"] ?? "";
    $nilai_uts = $_POST["nilai_uts"] ?? 0;
    $nilai_uas = $_POST["nilai_uas"] ?? 0;
    $nilai_tugas = $_POST["nilai_tugas"] ?? 0;

    // Validasi input sederhana (agar tidak ada data kosong)
    if (!empty($nama) && !empty($matakuliah)) {
        $data_mhs[] = new NilaiMahasiswa($nama, $matakuliah, $nilai_uts, $nilai_uas, $nilai_tugas);
    }
}
?>

<h3>Input Data Mahasiswa</h3>
<form method="POST">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required><br><br>

    <label for="matakuliah">Mata Kuliah:</label>
    <input type="text" name="matakuliah" required><br><br>

    <label for="nilai_uts">Nilai UTS:</label>
    <input type="number" name="nilai_uts" required><br><br>

    <label for="nilai_uas">Nilai UAS:</label>
    <input type="number" name="nilai_uas" required><br><br>

    <label for="nilai_tugas">Nilai Tugas:</label>
    <input type="number" name="nilai_tugas" required><br><br>

    <input type="submit" value="Simpan">
</form>

<h3>Daftar Nilai Mahasiswa</h3>
<table border="1" cellpadding="5" width="100%">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Mata Kuliah</th>
        <th>Nilai UTS</th>
        <th>Nilai UAS</th>
        <th>Nilai Tugas</th>
        <th>Nilai Akhir</th>
        <th>Nilai Kelulusan</th>
    </tr>
</thead>
<tbody>
    <?php
    $nomor = 1;
    foreach($data_mhs as $mhs){
        echo "<tr>";
        echo "<td>$nomor</td>";
        echo "<td>$mhs->nama</td>";
        echo "<td>$mhs->matakuliah</td>";
        echo "<td>$mhs->nilai_uts</td>";
        echo "<td>$mhs->nilai_uas</td>";
        echo "<td>$mhs->nilai_tugas</td>";
        echo "<td>" . number_format($mhs->getNA(), 2) . "</td>";
        echo "<td>" . $mhs->kelulusan() . "</td>";
        echo "</tr>";
        $nomor++;
    }
    ?>
</tbody>
</table>
