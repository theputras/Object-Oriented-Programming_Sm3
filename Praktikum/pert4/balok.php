<?php

include "persegi.php";

class balok extends persegi {
    private $tinggi;

    function getTinggi() {
        return $this->tinggi;
    }
    function setTinggi($tinggi) {
        $this->tinggi = $tinggi;
    }

}