<?php
require_once 'controllers/ProductController.php';

$controller = new ProductController();

if(isset($_GET['action']) && $_GET['action'] == 'create') {
    $controller->create();
} elseif(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $controller->edit($_GET['id']);
} elseif(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $controller->delete($_GET['id']);
} else {
    $controller->index();
}
?>