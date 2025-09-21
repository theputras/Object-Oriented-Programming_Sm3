<?php
include_once  'bank.php';

$obk = new bank();

$obk -> setNorek("791273971");
$obk -> setNamaNasabah("Krisna");
$obk -> setSaldo(90000);
$obk -> setNamaBank("Bank BCA");
$obk -> setBunga(0.25);

$saldoakhir = $obk-> getSaldo() + ($obk->getSaldo() * $obk -> getBunga());

echo "Nama Nasabah: " . $obk -> getNamaNasabah()."<br> \n";
echo "Nomor Rekening: " . $obk -> getNorek() ."<br> \n";
echo "Bank: " . $obk -> getNamaBank() ."<br> \n";
echo "Bunga: " . $obk -> getBunga() . "<br> \n";
echo "Saldo Awal: " . number_format($obk -> getSaldo()) ."<br> \n";
echo "Saldo Akhir: " . number_format($saldoakhir) ."<br> \n";