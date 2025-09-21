<?php

abstract class manusia {

    private $tinggi;
    public function __construct($tinggi){
        $this -> tinggi = $tinggi;
    }
    function getTinggi() {
        return $this -> tinggi;
    }

    public abstract function BMI();
    
    
}