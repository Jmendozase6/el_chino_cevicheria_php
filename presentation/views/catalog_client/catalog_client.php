<?php

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

if (isset($_GET['productId']) && $_GET['productId'] != "") {

  $productsDAO = new ProductDAO();
  $cartDAO = new CartDAO();

  $productId = $_GET['productId'];
  $cartDAO->addProductToCart($productId, 1);

  header("Location:javascript://history.go(-1)");
}
?>