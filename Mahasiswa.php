<?php
class Mahasiswa {
    public $nama;
    public $nim;
    public $no_hp;
    public $jurusan;
    public $mata_kuliah = array();

    public function __construct($nama, $nim, $no_hp, $jurusan) {
        $this->nama = $nama;
        $this->nim = $nim;
        $this->no_hp = $no_hp;
        $this->jurusan = $jurusan;
    }

    public function daftar_Matkul($mata_kuliah) {
        $this->mata_kuliah[] = $mata_kuliah;
    }

    public function hitung_IPK() {
        $total_sks = 0;
        $total_nilai = 0;

        foreach ($this->mata_kuliah as $mk) {
            $total_sks += $mk->sks;
            $total_nilai += $mk->hitung_NilaiAkhir() * $mk->sks;
        }

        return ($total_sks > 0) ? $total_nilai / $total_sks : 0;
    }
}


class MataKuliah {
    public $kode_matkul;
    public $nama_matkul;
    public $sks;
    public $nilai;

    public function __construct($kode_matkul, $nama_matkul, $sks, $nilai = 0) {
        $this->kode_matkul = $kode_matkul;
        $this->nama_matkul = $nama_matkul;
        $this->sks = $sks;
        $this->nilai = $nilai;
    }

    public function jadwal() {
        return "Jadwal untuk Mata Kuliah {$this->nama_matkul} belum ditentukan.";
    }

    public function hitung_NilaiAkhir() {
        return $this->nilai;
    }
}


class Jurusan {
    public $kode_jurusan;
    public $nama_jurusan;
    public $fakultas;
    public $mahasiswa = array();

    public function __construct($kode_jurusan, $nama_jurusan, $fakultas) {
        $this->kode_jurusan = $kode_jurusan;
        $this->nama_jurusan = $nama_jurusan;
        $this->fakultas = $fakultas;
    }

    public function daftar_Mahasiswa($mahasiswa) {
        $this->mahasiswa[] = $mahasiswa;
    }

    public function lihat_Matkul() {
        // Mengembalikan daftar mata kuliah yang ada di jurusan ini
        return "Mata kuliah untuk jurusan {$this->nama_jurusan}.";
    }
}


// Membuat objek jurusan
$jurusanSI = new Jurusan("SI", "Sistem Informasi", "Fakultas Ekonomi Bisnis");

// Membuat objek mahasiswa
$mahasiswa1 = new Mahasiswa("Afnina Najwa", "23.230.0024", "085727998317", $jurusanSI);

// Membuat beberapa objek mata kuliah
$matkul1 = new MataKuliah("MK001", "Pemrograman Berbasis WEB 2", 3, 85);
$matkul2 = new MataKuliah("MK002", "Sistem Basis Data", 3, 90);

// Menambahkan mata kuliah ke mahasiswa
$mahasiswa1->daftar_Matkul($matkul1);
$mahasiswa1->daftar_Matkul($matkul2);

// Menghitung IPK mahasiswa
echo "IPK Mahasiswa {$mahasiswa1->nama}: " . $mahasiswa1->hitung_IPK() . "</br>";

// Menambahkan mahasiswa ke jurusan
$jurusanSI->daftar_Mahasiswa($mahasiswa1);

// Melihat mata kuliah yang tersedia di jurusan
echo $jurusanSI->lihat_Matkul();
?>