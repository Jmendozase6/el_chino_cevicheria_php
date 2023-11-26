<?php

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

$idProduct = $_GET['id'];
$quantity = $_GET['quantity'];
$type = $_GET['type'];

$cartDAO = new CartDAO();

//Si es D, se suma 1 a la cantidad
if ($type == 'I') {
    $cartDAO->changeQuantity($idProduct, ($quantity + 1));
} else if ($type == 'D') {
    //Si es I, se resta 1 a la cantidad, pero se valida que sea mínimo 1
    if ($quantity > 1) {
        $cartDAO->changeQuantity($idProduct, ($quantity - 1));
    } else {
        $cartDAO->deleteProductFromCart($idProduct);
    }
}

header("Location: " . $_SERVER['HTTP_REFERER']);
