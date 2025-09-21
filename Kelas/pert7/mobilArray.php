<?php
// Initialize an array to store car brands
$mobil = [];
$selesai = false;

while (!$selesai) {
    echo "PROGRAM MASTER MOBIL\n";
    echo "1. View All mobil\n";
    echo "2. Add Merek mobil\n";
    echo "3. Exit\n";
    echo "Masukan pilihan [1-3]: ";
    
    $pil = readline();
    
    if ($pil == 3) {
        $selesai = true;
        echo "Program selesai.\n";
    } elseif ($pil == 1) {
        echo "VIEW ALL MOBIL:\n";
        if (count($mobil) > 0) {
            foreach ($mobil as $mbl) {
                echo "- " . $mbl . "\n";
            }
        } else {
            echo "Belum ada data merek mobil.\n";
        }
    } elseif ($pil == 2) {
        echo "Masukan Merek mobil baru: ";
        $merek = readline();
        $mobil[] = $merek;
        echo "Merek mobil berhasil ditambahkan!\n";
    } else {
        echo "Pilihan tidak valid, coba lagi.\n";
    }
}
?>
