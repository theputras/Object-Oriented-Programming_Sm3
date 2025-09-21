<?php
    
class perhitunganPersegi {
    private $sisi;
    public function __construct($s) {
        $this->sisi= $s;
    }
    function getSisi(){
        return $this->sisi;
    }
    function luasPersegi() {
        return $this -> sisi * $this -> sisi;
    }
}

class perhitunganSegitiga {
    private $alas;
    private $tinggi;
    public function __construct($A,$T) {
        $this->alas= $A;
        $this ->tinggi= $T;
    }

    function getAlas() {
        return $this ->alas;
    }
    function getTinggi() {
        return $this -> tinggi;
    }
    function luasSegitiga() {
        return 0.5 * $this -> alas * $this -> tinggi;
    }
}