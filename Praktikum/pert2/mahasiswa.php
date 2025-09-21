<?php 
class mahasiswa {
    private $nim;
    private $nama;
    /*public function __construct() {
        $this-> nim ="01";
        $this-> nama = "Krisna";
    }
    */

    public function __construct($n1, $n2) {
        $this-> nim =$n1;
        $this-> nama = $n2;
    }
    function getNim() {
        return $this -> nim;
    }
    function getNama(){
        return $this -> nama;
    }
}