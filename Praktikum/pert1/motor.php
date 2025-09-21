
<?php
class motor {
    //atribut motor
    private $merk;
    private $warna;
    private $jumRoda;

    //fungsi
    public function setMerk($nilai) {
        $this->merk=$nilai;
    }

    function getMerk() {
        return $this->merk;
    }
}