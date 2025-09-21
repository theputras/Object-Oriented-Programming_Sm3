<?php 

include 'classBooks.php';
// 6 objek Books
$book1 = new Books("Pemrograman Web", "Andi", "Andi Publisher", 2023, 85000);
$book2 = new Books("Algoritma dan Struktur Data", "Tono", "Informatika Bandung", 2022, 100000);
$book3 = new Books("Basis Data", "Budi", "Gramedia", 2021, 75000);
$book4 = new Books("Kecerdasan Buatan", "Citra", "Deep Publisher", 2024, 120000);
$book5 = new Books("Analisis Sistem", "Dwi", "Gramedia", 2022, 90000);
$book6 = new Books("Jaringan Komputer", "Eka", "Informatika Bandung", 2023, 80000);

// Menampilkan informasi buku
$book1->displayInfo();
$book2->displayInfo();
$book3->displayInfo();
$book4->displayInfo();
$book5->displayInfo();
$book6->displayInfo();


?>