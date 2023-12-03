<?php

require_once '../../../data_access_objects/ProductDAO.php';

$id = $_GET['id'];
$productDAO = new ProductDAO();
$productDAO->deleteProductById($id);
header("Location: " . $_SERVER['HTTP_REFERER']);