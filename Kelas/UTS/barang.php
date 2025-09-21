<?php
class Barang {
    public $idBarang;
    public $namaBarang;
    public $harga;
    public $stock;

    public function __construct($idBarang, $namaBarang, $harga, $stock) {
        $this->idBarang = $idBarang;
        $this->namaBarang = $namaBarang;
        $this->harga = $harga;
        $this->stock = $stock;
    }

    // Getter dan setter untuk setiap atribut
    
    public function getId(){
        return $this->idBarang;
    }
    
    public function getNama(){
        return $this->namaBarang;
    }
    
    public function getHarga(){
        return $this->harga;
    }
    
    public function getStock(){
        return $this->stock;
    }
    
    public function setNama($namaBarang){
        return $this->namaBarang = $namaBarang;
    }
    
    public function setHarga($harga){
        return $this->harga = $harga;
    }
    
    public function setStock($stock){
        return $this->stock = $stock;
    }
}