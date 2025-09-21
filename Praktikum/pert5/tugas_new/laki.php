<?php

class laki extends manusia {
    public function __construct($tinggi) {
        parent::__construct($tinggi);
    }
    public function BMI(){
        return (parent::getTinggi()-100) - ((parent::getTinggi()-100)*0.15);
    }
}