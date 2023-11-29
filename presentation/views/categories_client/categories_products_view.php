<?php

use data_transfer_objects\ProductDTO;

include '../landing/base_landing_view.php';

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

require_once '../../../data_transfer_objects/ProductDTO.php';

$categoryId = $_GET['categoryId'];

$productDAO = new ProductDAO();
$cartDAO = new CartDAO();

$responseProducts = $productDAO->getProductsByIdCategory($categoryId);
$productsDTO = [];

for ($j = 0; $j < sizeof($responseProducts); $j++) {
    $productsDTO[$j] = ProductDTO::createFromResponse($responseProducts[$j]);
}

$ids = $cartDAO->getProductsIdFromCart();

$content = '
    <div class="container">
        <div class="row">
                ' . displayProductsCards() . '
        </div>
    </div>
';

function displayProductsCards()
{
    global $productsDTO, $cartDAO;
    $content = '';
    for ($i = 0;
         $i < sizeof($productsDTO);
         $i++) {

        $exists = $cartDAO->productAlreadyInCart($productsDTO[$i]->getId());
        $icon = $exists ?
            '<a href="../cart_client/delete_product.php?id=' . $productsDTO[$i]->getId() . '"
                                 class="btn-product btn-danger">
                                <i class="bi bi-trash3-fill"></i></a>'
            :
            '<a id="add" class="btn-product btn-success"
                                 href="categories_client.php?productId=' . $productsDTO[$i]->getId() . '">
                                <i class="bi bi-plus-lg"></i>
                              </a>';

        $content .= '
                  <div class="col-sm-4 col-md-3 col-xxl-2 mb-2">
                        <div class="card">
                          <img src="' . $productsDTO[$i]->getImage() . '" class="card-img-top" alt="Producto" height="150">
                          <div class="card-body">
                            <p class="card-title fw-bold fs-5">' . $productsDTO[$i]->getName() . '</p>
                            <p class="card-subtitle text-success fs-6">' . $productsDTO[$i]->getDescription() . '</p>
                            <p class="card-text">S/' . $productsDTO[$i]->getPrice() . '</p>
                            <div class="text-end">
                                ' . $icon . '
                            </div >
                          </div >
                        </div >
                  </div >
        ';
    }
    return '
        <div class="container my-2">
          <div class="row row-cols-1 row-cols-md-5 g-4">
            ' . $content . '
          </div>
        </div>
    ';
}

displayBaseWeb($content);