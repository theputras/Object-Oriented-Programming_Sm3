<?php
// Parent Class
class BankAccount {
    private $balance;
    private $nama;
    
    public function __construct($bank1,$bank2) {
      $this -> balance;
      $this -> nama;
      
    }
    
    public function deposit($amount) {
        if($amount >= 0) {
        $this->balance += $amount;
        }
        return $this;
    }
    
}

