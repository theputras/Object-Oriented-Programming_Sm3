<?php
require 'barang.php';
class DbBarang {
    private $listBarang = [];

    public function insert(Barang $barang) {
        $this->listBarang[] = $barang;
    }

    public function update(Barang $barang) {
        for ($i = 0; $i < count($this->listBarang); $i++) {
            if ($this-> listBarang[$i]->getId() == $barang->getId()) {
                $this->listBarang[$i] = $barang;
                echo "Barang dengan ID {$barang->getId()} berhasil diupdate\n";
                return;
            }
        }
        echo "Barang dengan ID {$barang->getId()} tidak ditemukan\n";
    }

    public function delete($id) {
        for ($i = 0; $i < count($this->listBarang); $i++) {
            if ($this-> listBarang[$i]->getId() == $id) {
                unset($this->listBarang[$i]);
                $this -> listBarang[$i] = array_values($this->listBarang);
                return;
            }
        }
        echo "Barang tidak ditemukan\n";
    }
    
    public function deleteAll() {
        $this->listBarang = [];
        echo "Barang sudah berhasil dihapus semua.\n";
    }
    
    

    public function showAll() {
        if (empty($this->listBarang)) {
            echo "\n";
            echo "Tidak ada barang yang tersedia\n";
            return;
        }
        foreach ($this->listBarang as $index => $barang) {
            echo "\n";
            echo "Barang Ke-" . ($index + 1).":\n" ;
            echo "ID Barang: " . $barang->getId() . "\n";
            echo "Nama Barang: " . $barang->getNama() . "\n";
            echo "Harga: " . number_format($barang->getHarga(),2, ',', '.')  . "\n";
            echo "Stok: " . $barang->getStock() . "\n";
            echo "\n";
            echo "===========================================\n";
            echo "\n";
        }
    }
}