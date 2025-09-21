<?php

require 'BankAccount.php';
class SavingAccount extends BankAccount {
    private $interestRate = 0.05;

    public function calculateInterest() {
        $interest = $this->balance * $this->interestRate;
        $this->balance += $interest;
        echo "Bunga sebesar Rp" . $interest . " telah ditambahkan.";
        echo "\n";
    }
}