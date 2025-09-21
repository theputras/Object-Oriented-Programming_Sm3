<?php
include 'DbBarang.php';
class barangApp {
    private $dbBarang;
    public function __construct(){
        $this -> dbBarang = new DbBarang();
    }
    
    public function main(){
        while (true) {
        $this -> showMenu();
            $choice = readline("Pilih menu (1-6): ");
            switch ($choice) {
                case 1:
                    $this->dbBarang->showAll();
                    break;
                case 2:
                    $this->insert();
                    break;
                case 3:
                    $this->update();
                    break;
                case 4:
                    $this->delete();
                    break;
                case 5:
                    $this->dbBarang -> deleteAll();
                    break;
                case 6:
                    echo "Keluar...";
                    exit;
                default:
                    echo "Pilihan salah! Silakan input kembali.\n";
            }
        }
    }
    
    private function showMenu(){
        echo "\n==== Menu ====\n";
        echo "\n";
        echo "1. Tampilkan semua barang\n";
        echo "2. Tambah barang baru\n";
        echo "3. Ubah data barang\n";
        echo "4. Hapus barang\n";
        echo "5. Hapus semua barang\n";
        echo "6. Keluar\n";
        
        echo "\n";
    }
    
    
    private function delete() {
        $idBarang = readline("Masukkan ID barang yang ingin dihapus: ");
        $this -> dbBarang -> delete($idBarang);
        echo "Barang dengan ID $idBarang berhasil dihapus\n";
    }
    
    
    private function update() {
        $idBarang = readline("Masukkan ID barang yang ingin di Update: ");
        $namaBarang = readline("Masukkan nama barang baru: ");
        $harga = (int)readline("Masukkan Harga baru: ");
        $stock = (int)readline("Masukkan Stok baru: ");
        
        
        $barangUpdated = new Barang($idBarang, $namaBarang, $harga, $stock);
        $this -> dbBarang -> update($barangUpdated);
    }
    
    private function insert() {
        $idBarang = readline("Masukkan ID Barang: ");
        $namaBarang = readline("Masukkan Nama Barang: ");
        $harga = (int)readline("Masukkan Harga: ");
        $stock = (int)readline("Masukkan Stock Barang: ");
        
        $barang = new Barang($idBarang, $namaBarang, $harga, $stock);
        
        $this -> dbBarang -> insert($barang);
        echo "\n";
        echo "Barang baru berhasil ditambahkan.\n";
    }
}