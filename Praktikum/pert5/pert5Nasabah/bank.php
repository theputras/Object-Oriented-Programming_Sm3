<?php
include_once 'nasabah.php';
class bank extends nasabah {
    private $namaBank;
    private $bunga;
    
    function getNamaBank() {
        return $this -> namaBank;
    }

    function getBunga() {
        return $this -> bunga;
    }

    function setNamaBank($namaBank) {
        $this -> namaBank = $namaBank;
    }

    function setBunga ($bunga) {
        $this -> bunga = $bunga;
    }
}