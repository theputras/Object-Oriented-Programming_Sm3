<?php 
$beli = (int) readline("Jumlah Beli: ");


function hitung_bonus ($beli) {
$bonus = 0;
if ($beli >= 2){
    $bonus = floor($beli / 2);
    } 
    return $bonus;
}

$bonus = hitung_bonus($beli);

echo "Anda mendapatkan $bonus bonus barang gratis!" . "\n";

echo "Jumlah barang yang dibayar: " . ($beli + $bonus);
?>