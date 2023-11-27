<?php

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

if (isset($_GET['productId']) && $_GET['productId'] != "") {

    $productsDAO = new ProductDAO();
    $cartDAO = new CartDAO();

    $productId = $_GET['productId'];

    $idsInCart = $cartDAO->getProductsIdFromCart();
    $isInCart = in_array($productId, array_column($idsInCart, 'id_product'));

//    Si no está en el carrito se agrega
    if (!$isInCart) {
        $cartDAO->addProductToCart($productId, 1);
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
}