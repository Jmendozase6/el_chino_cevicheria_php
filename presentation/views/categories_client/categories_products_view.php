<?php

use data_transfer_objects\ProductDTO;

include_once '../landing/base_landing_view.php';

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
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3 container-card">
                <div class="card card-initial m-2">
                    <img src="' . $productsDTO[$i]->getImage() . '" class="card-img-top card-img-top-initial" alt="...">
                    <div class="card-body card-body-initial">
                        <h5 class="card-title name-category-initial fw-bold">' . $productsDTO[$i]->getName() . '</h5>
                        <p class="card-text card-text-initial fw-bolder">' . $productsDTO[$i]->getDescription() . '</p>
                    </div>
                    <div class="mb-4 d-flex justify-content-around">
                        <h5 class="me-4 ">S/' . $productsDTO[$i]->getPrice() . '</h5>
                        <div class="text-end">
                            ' . $icon . '
                        </div>
                    </div>
                </div>
            </div>
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