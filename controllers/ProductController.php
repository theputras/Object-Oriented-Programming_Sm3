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
        $stmt = $this->product->read();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/product/index.php';
    }

    public function create() {
        if($_POST) {
            $this->product->nama_product = $_POST['nama_product'];
            $this->product->harga_product = $_POST['harga_product'];
            $this->product->gambar_product = $_POST['gambar_product'];
            $this->product->keterangan_product = $_POST['keterangan_product'];
            if($this->product->create()) {
                header("Location: index.php");
                exit;
            }
        }
        include 'views/product/create.php';
    }

    public function edit($id) {
        if($_POST) {
            $this->product->id = $id;
            $this->product->nama_product = $_POST['nama_product'];
            $this->product->harga_product = $_POST['harga_product'];
            $this->product->gambar_product = $_POST['gambar_product'];
            $this->product->keterangan_product = $_POST['keterangan_product'];
            if($this->product->update()) {
                header("Location: index.php");
                exit;
            }
        } else {
            $this->product->id = $id;
            $product = $this->product->cari()->fetch(PDO::FETCH_ASSOC);
            include 'views/product/edit.php';
        }
    }

    public function delete($id) {
        $this->product->id = $id;
        if($this->product->delete()) {
            header("Location: index.php");
        }
    }
    public function refresh() {
        $stmt = $this->product->read();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/product/table.php';
    }
}
?>