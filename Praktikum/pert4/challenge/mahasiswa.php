<?php
class mahasiswa {
    private $nama;
    private $nim;
    private $prodi;
    private $tahun;

    public function __construct($nama, $nim) {
        $this->nama = $nama;
        $this->nim = $nim;
    }
    function getNama() {
        return $this->nama;
    }

    function getNim() {
        return $this->nim;
    }

    function getProdi() {
        return $this->prodi;
    }

    function getTahun() {
        return $this->tahun;
    }

    function setNama($nama) {
        $this->nama = $nama;
    }

    function setNim($nim) {
        $this->nim = $nim;
    }

    function setProdi($prodi) {
        $this->prodi = $prodi;
    }

    function setTahun($tahun) {
        $this->tahun = $tahun;
    }
}
?>