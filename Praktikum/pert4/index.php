<?php
include 'balok.php';

$obj = new balok();

$obj -> setPanjang(5);
$obj -> setLebar(6);
$obj -> setTinggi(2);

$luas = $obj->getPanjang() * $obj-> getLebar();
$volume = $luas * $obj->getTinggi();

echo 'Luas: ' . $luas;
echo '<br>';
echo 'Volume: '. $volume;
?>