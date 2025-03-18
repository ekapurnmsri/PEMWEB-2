<?php
class NilaiMahasiswa {
    // Properti untuk menyimpan data mahasiswa
    public $nama;
    public $matakuliah;
    public $nilai_uts;
    public $nilai_uas;
    public $nilai_tugas;

    // Konstanta untuk persentase nilai
    public const PERSENTASE_UTS = 0.25;
    public const PERSENTASE_UAS = 0.30;
    public const PERSENTASE_TUGAS = 0.45;

    // Konstruktor untuk menginisialisasi properti
    public function __construct($nama, $matakuliah, $nilai_uts, $nilai_uas, $nilai_tugas) {
        $this->nama = $nama;
        $this->matakuliah = $matakuliah;
        $this->nilai_uts = $nilai_uts;
        $this->nilai_uas = $nilai_uas;
        $this->nilai_tugas = $nilai_tugas;
    }

    // Menghitung nilai akhir
    public function getNA() {
        return ($this->nilai_uts * self::PERSENTASE_UTS) +
               ($this->nilai_uas * self::PERSENTASE_UAS) +
               ($this->nilai_tugas * self::PERSENTASE_TUGAS);
    }

    // Menentukan kelulusan mahasiswa
    public function kelulusan() {
        return $this->getNA() >= 60 ? "Lulus" : "Drop Out";
    }

    // Menampilkan informasi mahasiswa
    public function cetakInformasi() {
        echo "Nama: " . $this->nama . "<br>";
        echo "Mata Kuliah: " . $this->matakuliah . "<br>";
        echo "Nilai UTS: " . $this->nilai_uts . "<br>";
        echo "Nilai UAS: " . $this->nilai_uas . "<br>";
        echo "Nilai Tugas: " . $this->nilai_tugas . "<br>";
        echo "Nilai Akhir: " . $this->getNA() . "<br>";
        echo "Status: " . $this->kelulusan() . "<br>";
    }
}

// Contoh penggunaan kelas NilaiMahasiswa
$mahasiswa1 = new NilaiMahasiswa("Budi", "Pemrograman Web", 70, 80, 90);
$mahasiswa1->cetakInformasi();
?>