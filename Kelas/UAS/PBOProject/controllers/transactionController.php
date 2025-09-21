<?php
require_once 'config/Database.php';
require_once 'models/Product.php';
require_once 'controllers/ProductController.php';


class transactionController {

    private $db;
    private $product;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->product = new Product($this->db);
    }
    
    public function processTransaction() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idProduct = htmlspecialchars(strip_tags($_POST['idProduct']));
            $jumlah = htmlspecialchars(strip_tags($_POST['jumlahProduk']));
            $idOutlet = htmlspecialchars(strip_tags($_POST['idOutlet']));
    
            // Check if outlet exists
            if (!$this->product->checkOutletExists($idOutlet)) {
                header("Location: index.php?error=outlet_not_found");
                exit;
            }
    
            // Process transaction
            if ($this->product->processTransaction($idProduct, $idOutlet, $jumlah)) {
                header("Location: index.php");
                exit;
            } else {
                header("Location: index.php?error=transaction_failed");
                exit;
            }
        }
        // Kirim data produk dan outlets ke view
        include 'views/product/index.php';
    }
    // Add this function in ProductController
    public function cetakStruk($id_struk) {
        $transaction = $this->product->cetakStruk($id_struk);
        if ($transaction) {
            echo "<div id='nama_product' >{$transaction['nama_product']}</div>";
            echo "<div id='jumlah' >{$transaction['jumlah']}</div>";
            echo "<div id='harga_product' >{$transaction['harga_product']}</div>";
        } else {
            echo "Transaction details not found!";
        }
        // Kirim data produk dan outlets ke view
        include 'views/product/index.php';
    }


public function getTransactions() {
    $transactions = $this->product->getTransactions();
    return $transactions;
    // Kirim data produk dan outlets ke view
    include 'views/product/index.php';
}
}