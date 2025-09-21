<?php
require_once 'controllers/ProductController.php';
require_once 'controllers/transactionController.php';

$controller = new ProductController();
$Transaksicontroller = new transactionController();


$action = $_GET['action'] ?? null;
$id_product = $_GET['id_product'] ?? null;

if ($action === 'create') {
    $controller->createProduct();
} elseif ($action === 'edit' && $id_product) {
    $controller->editProduct($id_product);
} elseif ($action === 'delete' && $id_product) {
    $controller->deleteProduct($id_product);
} elseif ($action === 'processTransaction') {
    $Transaksicontroller->processTransaction();
} elseif ($action === 'cetakStruk' && isset($_GET['id_struk'])) {
    $transaction = $Transaksicontroller->cetakStruk($_GET['id_struk']);
    exit;
}  elseif ($action === 'getProductDetails' && isset($_GET['idProduct'])) {
    $controller->getProductDetails($_GET['idProduct']);
    exit;
} else {
    $controller->index();
}

if (isset($_POST['idProduk'])) {
    $idProduk = $_POST['idProduk'];
    $namaProduk = $controller->getProductNameById($idProduk);
}

$error = $_GET['error'] ?? null;
if ($error === 'outlet_not_found') {
    $error = 'ID Outlet tidak ditemukan.';
}



?>