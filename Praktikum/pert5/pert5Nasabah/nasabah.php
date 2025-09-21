<?php

class nasabah {
    private $noRek;
    private $namaNasabah;
    private $saldo;
    

    function getNorek() {
        return $this -> noRek;
    }

    function getNamaNasabah() {
        return $this -> namaNasabah;
    }

    function getSaldo() {
        return $this -> saldo;
    }

    function setNorek($noRek) {
        $this -> noRek = $noRek;
    }
    function setNamaNasabah($namaNasabah) {
        $this -> namaNasabah = $namaNasabah;
    }

    function setSaldo ($saldo) {
        $this -> saldo = $saldo;
    }
}