<?php

include '../landing/base_landing_view.php';


use data_transfer_objects\ProductDTO;

require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/ProductDTO.php';

$cartDAO = new CartDAO();
$responseProductsFromCart = $cartDAO->getProductsFromCart();
$productsFromCartDTO = [];
$isAuthenticated = false;

foreach ($responseProductsFromCart as $productFromCart) {
  $productDAO = new ProductDAO();
  $product = $productDAO->getProductById($productFromCart['id']);
  $productDTO = ProductDTO::createFromResponse($product);
  $productsFromCartDTO[] = $productDTO;
}

if (sizeof($productsFromCartDTO) > 0) {
  header('Location: ../cart_new/cart_new_view.php');
  exit();
}

$content = '
    <div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
      <div class="text-center">
        <img class="w-100" src="../../resources/images/empty.png" alt="Carrito Vacío"> <br> <br>
        <span>No hay productos agregados</span>
      </div>
    </div>
  </div>
';
displayBaseWeb($content);
?>