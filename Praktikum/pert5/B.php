<?php
include 'A.php';

class B extends A {
    public function setSifat() {
        $this -> sifat = "Suka Tidur";
    }

    public function getSifat() {
        return $this->sifat;
    }
}