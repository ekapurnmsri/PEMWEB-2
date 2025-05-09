-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2025 pada 15.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: db-puskesmas
--

-- --------------------------------------------------------

--
-- Struktur dari tabel kelurahan
--

CREATE TABLE kelurahan (
  id int(11) NOT NULL,
  nama varchar(45) NOT NULL,
  kec_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel kelurahan
--

INSERT INTO kelurahan (id, nama_kelurahan, kec_id) VALUES
(1, 'jagakarsa', 1),
(2, 'bogor', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel paramedik
--

CREATE TABLE paramedik (
  id int(11) NOT NULL,
  nama varchar(45) NOT NULL,
  gender char(1) NOT NULL,
  tmp_lahir varchar(30) NOT NULL,
  tgl_lahir date NOT NULL,
  kategori enum('Perawat','Dokter','Asisten') NOT NULL,
  telepon varchar(20) NOT NULL,
  alamat varchar(100) NOT NULL,
  unit_kerja_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel paramedik
--

INSERT INTO paramedik (id, nama, gender, tmp_lahir, tgl_lahir, kategori, telepon, alamat, unit_kerja_id) VALUES
(1, 'Wahyudan', 'L', 'Bima', '2005-10-01', 'Dokter', '081234567890', 'Jl. Sape No. 1', 1),
(2, 'Walid', 'L', 'Bandung', '2000-04-05', 'Asisten', '085612345678', 'Gg. Sejahtera No. 10', 2);


-- --------------------------------------------------------

--
-- Struktur dari tabel pasien
--

CREATE TABLE pasien (
  id int(11) NOT NULL,
  kode varchar(10) NOT NULL,
  nama varchar(50) NOT NULL,
  tmp_lahir varchar(30) DEFAULT NULL,
  tgl_lahir date NOT NULL,
  gender enum('L','P') NOT NULL,
  email varchar(50) NOT NULL,
  alamat varchar(100) DEFAULT NULL,
  kelurahan_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel pasien
--

INSERT INTO pasien (id, kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES
(1, ' QR001', ' susi', ' jagakarsa', '2024-04-02', 'P', 'susi@gmail.com', 'kampung sawah', 1),
(2, 'QR002', 'Putra', 'Bojonggede', '2015-04-27', 'L', 'putra@gmail.com', 'bojonggede', 2);


-- --------------------------------------------------------

--
-- Struktur dari tabel periksa
--

CREATE TABLE periksa (
  id int(11) NOT NULL,
  tanggal date NOT NULL,
  berat double NOT NULL,
  tinggi double NOT NULL,
  tensi varchar(20) NOT NULL,
  keterangan varchar(100) DEFAULT NULL,
  pasien_id int(11) NOT NULL,
  dokter_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel periksa
--

INSERT INTO periksa (id, tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) VALUES
(1, '2025-05-03', 60, 175, '130/80 mmHg', 'Keadaan umum baik.', 1, 1),
(2, '2025-06-12', 48, 165, '120/70 mmHg', 'Sedikit demam.', 2, 2);


-- --------------------------------------------------------

--
-- Struktur dari tabel unit_kerja
--

CREATE TABLE unit_kerja (
  id int(11) NOT NULL,
  nama varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel unit_kerja
--

INSERT INTO unit_kerja (id, nama) VALUES
(1, 'UGD'),
(2, 'Rawat Inap Lantai 1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel kelurahan
--
ALTER TABLE kelurahan
  ADD PRIMARY KEY (id);

--
-- Indeks untuk tabel paramedik
--
ALTER TABLE paramedik
  ADD PRIMARY KEY (id);

--
-- Indeks untuk tabel pasien
--
ALTER TABLE pasien
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY kode (kode),
  ADD KEY fk_pasien_kelurahan (kelurahan_id);

--
-- Indeks untuk tabel periksa
--
ALTER TABLE periksa
  ADD PRIMARY KEY (id),
  ADD KEY pasien_id (pasien_id),
  ADD KEY dokter_id (dokter_id);

--
-- Indeks untuk tabel unit_kerja
--
ALTER TABLE unit_kerja
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel kelurahan
--
ALTER TABLE kelurahan
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel paramedik
--
ALTER TABLE paramedik
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel pasien
--
ALTER TABLE pasien
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel periksa
--
ALTER TABLE periksa
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel unit_kerja
--
ALTER TABLE unit_kerja
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel pasien
--
ALTER TABLE pasien
  ADD CONSTRAINT fk_pasien_kelurahan FOREIGN KEY (kelurahan_id) REFERENCES kelurahan (id) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;