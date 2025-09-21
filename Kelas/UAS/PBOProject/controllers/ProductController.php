<?php
require_once 'config/Database.php';
require_once 'models/Product.php';

class ProductController {
    private $db;
    private $product;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }

    public function index() {
        // Ambil data produk
        $stmt = $this->product->readProduct();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Ambil data outlets dari database
        $query = "SELECT id_outlet, nama_outlet FROM outlets";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $outlets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // // Debugging: Cek data outlets
        // echo "<pre>";
        // print_r($outlets);
        // echo "</pre>";
    
        // Kirim data produk dan outlets ke view
        include 'views/product/index.php';
    }

    public function createProduct() {
        if($_POST) {
            $this->product->nama_product = $_POST['nama_product'];
            $this->product->harga_product = $_POST['harga_product'];
            $this->product->gambar_product = $_POST['gambar_product'];
            $this->product->keterangan_product = $_POST['keterangan_product'];
            $this->product->quantity = $_POST['quantity'];
            $this->product->id_outlet = $_POST['id_outlet'];
            if($this->product->createProduct()) {
                header("Location: index.php");
                exit;
            }
        }
        include 'views/product/create.php';
    }

    public function getAllOutlets() {
        $query = "SELECT * FROM outlets";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function getProductNameById($id) {
        $this->product->id_product = $id;
        $stmt = $this->product->cariProduct();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return $row['nama_product'];
        } else {
            return '';
        }
    }
    
    
   

    public function editProduct($id_product) {
        // Ambil data produk berdasarkan ID
        $this->product->id_product = $id_product;
        $stmt = $this->product->cari();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Ambil data outlets dari database
        $query = "SELECT id_outlet, nama_outlet FROM outlets";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $outlets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($_POST) {
            // Jika form dikirim, update data produk
            $this->product->id_product = $id_product;
            $this->product->nama_product = $_POST['nama_product'];
            $this->product->harga_product = $_POST['harga_product'];
            $this->product->gambar_product = $_POST['gambar_product'];
            $this->product->keterangan_product = $_POST['keterangan_product'];
            $this->product->quantity = $_POST['quantity'];
            $this->product->id_outlet = $_POST['id_outlet'];
    
            if ($this->product->updateProduct()) {
                header("Location: index.php");
                exit;
            }
         } else {
            $this->product->id_product = $id_product;
            $product = $this->product->cari()->fetch(PDO::FETCH_ASSOC);
            $outlets = $this->getAllOutlets();
            include 'views/product/edit.php';
        }
    }

    public function deleteProduct($id_product) {
        $this->product->id_product = $id_product;
        if ($this->product->deleteProduct($id_product)) {
            header("Location: index.php");
            exit;
        }
    }
    public function getProductDetails($idProduct) {
        $query = "SELECT p.id_product, pq.id_outlet, o.nama_outlet 
                  FROM products p 
                  LEFT JOIN products_quantity pq ON p.id_product = pq.id_product 
                  LEFT JOIN outlets o ON pq.id_outlet = o.id_outlet 
                  WHERE p.id_product = :id_product";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_product', $idProduct);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        // Kirim data produk dan outlets ke view
        include 'views/product/index.php';
    }
    
  
}
?>