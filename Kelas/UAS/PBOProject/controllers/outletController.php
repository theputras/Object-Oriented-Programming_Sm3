<?php
require_once 'config/Database.php';
require_once 'models/outlet.php';

class outletController {
    private $db;
    private $outlet;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->outlet = new outlet($this->db);
    }
    
    // public function index() {
    
    //     // Ambil data outlets dari database
    //     $stmt = $this->outlet->readOutlets();
    //     $outlets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //     // Kirim data produk dan outlets ke view
    //     include 'views/product/index.php';
    // }
    
    public function createOutlet() {
        if($_POST) {
            $this->outlet->nama_outlet = $_POST['nama_outlet'];
            $this->outlet->alamat_outlet = $_POST['alamat_outlet'];
            $this->outlet->tipe_outlet = $_POST['tipe_outlet'];
            if($this->outlet->createOutlet()) {
                header("Location: index.php");
                exit;
            }
        }
        include 'views/product/create.php';
    }
    
    

    public function getAllOutlets() {
        $stmt = $this->outlet->readOutlets();
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function editOutlet($id_outlet) {
        // Ambil data outlet berdasarkan ID
        $this->outlet->id_outlet = $id_outlet;
        $stmt = $this->outlet->cariOutlet();
        $outlet = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($_POST) {
            // Jika form dikirim, update data outlet
            $this->outlet->id_outlet = $id_outlet;
            $this->outlet->nama_outlet = $_POST['nama_outlet'];
            $this->outlet->alamat_outlet = $_POST['alamat_outlet'];
            $this->outlet->tipe_outlet = $_POST['tipe_outlet'];
    
            if ($this->outlet->updateOutlet()) {
                header("Location: index.php");
                exit;
            }
         } else {
            $this->outlet->id_outlet = $id_outlet;
            $outlet = $this->outlet->cariOutlet()->fetch(PDO::FETCH_ASSOC);
            include 'views/product/edit.php';
        }
    }
    
    
    public function deleteOutlet($id_outlet) {
        $this->outlet->id_outlet = $id_outlet;
        if ($this->outlet->deleteoutlet($id_outlet)) {
            header("Location: index.php");
            exit;
        }
    }
    
}