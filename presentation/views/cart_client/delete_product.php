<?php

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

$idProduct = $_GET['id'];
$cartDAO = new CartDAO();
$cartDAO->deleteProductFromCart($idProduct);
header("Location: " . $_SERVER['HTTP_REFERER']);