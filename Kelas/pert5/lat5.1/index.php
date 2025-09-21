<?php
require 'SavingAccount.php';
$akun1 = new SavingAccount("Andi");
$akun1-> deposit(10000);
$akun1-> setInterestRate(0.05);
$akun1 -> addInterest();
echo "Balance Akun 1: " . $akun1->getBalance() . "\n";