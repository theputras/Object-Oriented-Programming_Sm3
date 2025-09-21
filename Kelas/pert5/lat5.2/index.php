<?php
require './BankAccount.php';

$savingAccount = new SavingAccount("Andi");
$savingAccount->deposit(1000000);
$savingAccount->calculateInterest();
echo "Saldo saving account: " . $savingAccount->getBalance() . "\n";


$currentAccount = new CurrentAccount("Budi");
$currentAccount->withdraw(1500000);
echo "Saldo current account: " . $currentAccount->getBalance();
?>