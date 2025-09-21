<?php
include 'classCar.php';
// Contoh objek 1
$myCar1 = new Car('Honda Beat', 'Merah', 2015);
echo "Model: " . $myCar1->getModel() . "\n";
echo "Warna: " . $myCar1->getColor() . "\n";
echo "Tahun: " . $myCar1->getYear() . "\n \n";

// Contoh objek 2
$myCar2 = new Car('Toyota Avanza', 'Putih', 2018);
echo "Model: " . $myCar2->getModel() . "\n";
echo "Warna: " . $myCar2->getColor() . "\n";
echo "Tahun: " . $myCar2->getYear() . "\n \n";

// Contoh objek 3
$myCar3 = new Car('Suzuki Ertiga', 'Hitam', 2020);
echo "Model: " . $myCar3->getModel() . "\n";
echo "Warna: " . $myCar3->getColor() . "\n";
echo "Tahun: " . $myCar3->getYear() . "\n";
?>