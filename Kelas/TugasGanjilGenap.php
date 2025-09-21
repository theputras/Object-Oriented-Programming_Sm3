<?php 
// Fungsi untuk memeriksa apakah suatu bilangan adalah ganjil atau genap

  function numCheck($bilangan) {
  if ($bilangan % 2 == 0) {
    return "Genap";
  } else {
    return "Ganjil";
  }
}
  // Inputkan bilangan
  $bilangan = (int) readline("Masukkan bilangan: ");
  
  // Cek apakah bilangan adalah ganjil atau genap
  $result = numCheck($bilangan);
  
  // Tampilkan hasil
  echo "Bilangan $bilangan adalah $result";

?>