<?php
require_once '../../config/Database.php';
require_once '../../models/Product.php';
    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);
    if (isset($_GET['id'])) {
        $product->id_product = $_GET['id'];
        $stmt = $product->cariProduct();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $nama_product = $row['nama_product'];
            
            $query = "SELECT pq.id_outlet, o.nama_outlet 
                      FROM products_quantity pq 
                      LEFT JOIN outlets o ON pq.id_outlet = o.id_outlet 
                      WHERE pq.id_product = :id_product";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_product', $product->id_product);
            $stmt->execute();
            $outletDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($outletDetails) {
                echo $nama_product . '|' . $outletDetails['id_outlet'] . '|' . $outletDetails['nama_outlet'];
            } else {
                echo $nama_product . '| |';
            }
        } else {
            echo 'Produk tidak ada';
        }
    }
?>