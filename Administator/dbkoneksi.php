<?php
// Konfigurasi database
$host = 'localhost'; // Ganti jika host berbeda
$database = 'dbpuskesmas'; // Nama database Anda
$user = 'root'; // Username MySQL Anda
$pass = ''; // Password MySQL (kosong jika default XAMPP)
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$database;charset=$charset";

// Opsi koneksi
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Menampilkan error dengan jelas
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Ambil data sebagai array asosiatif
    PDO::ATTR_EMULATE_PREPARES => false, // Nonaktifkan emulasi prepared statement
];

// Membuat koneksi PDO
try {
    $dbh = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Koneksi database gagal: ' . $e->getMessage());
}
?>
