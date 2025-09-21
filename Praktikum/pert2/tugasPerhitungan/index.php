<?php
include 'perhitungan.php';

$persegi = new perhitunganPersegi(10);
$segitiga = new perhitunganSegitiga(12, 10);

echo "===== Perhitungan Persegi =====";
echo"<br>";
echo "Panjang sisi: ". $persegi -> getSisi();
echo"<br>";
echo "Hasil: ". $persegi -> luasPersegi() ." cm^2";
echo "<hr>";
echo "===== Perhitungan Segitiga =====";
echo"<br>";
echo "Alas: ". $segitiga -> getAlas();
echo"<br>";
echo "Tinggi: ". $segitiga -> getTinggi();
echo"<br>";
echo "Hasil: ". $segitiga -> luasSegitiga() . " cm^2";
