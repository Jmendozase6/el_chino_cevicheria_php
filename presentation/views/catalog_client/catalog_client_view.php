<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\ProductDTO;

include '../landing/base_landing_view.php';

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

$categoryDAO = new CategoryDAO();
$cartDAO = new CartDAO();
$productDAO = new ProductDAO();

$responseCategories = $categoryDAO->getCategories(20);
$categoriesDTO = [];
$responseProducts = [];

for ($i = 0; $i < sizeof($responseCategories); $i++) {
  $categoriesDTO[$i] = CategoryDTO::createFromResponse($responseCategories[$i]);
  $responseProducts[$i] = $productDAO->getProductsByIdCategory($categoriesDTO[$i]->getId());
}

$productsDTO = [];
for ($i = 0; $i < sizeof($responseProducts); $i++) {
  for ($j = 0; $j < sizeof($responseProducts[$i]); $j++) {
    $productsDTO[$i][$j] = ProductDTO::createFromResponse($responseProducts[$i][$j]);
  }
}

$content = '
    <div class="container my-2">
    <div class="row">
    <div class="col pt-4 d-flex justify-content-center flex-column align-items-center">
    <h2 class="text-center fw-bold">Catálogo</h2>
        <img class="pt-2 pb-5" src="../../resources/icons/line.svg" alt="">
        </div>
    </div>
    
        ' . displayCategoriesAndProducts() . '
    </div>
';

function displayCategoriesAndProducts()
{
  global $categoriesDTO, $responseProducts, $productsDTO, $cartDAO;

  $content = '';

  for ($i = 0; $i < sizeof($categoriesDTO); $i++) {
    $content .= '
            <div class="row">
                <div class="col mt-4">
                    <strong id="category-' . $categoriesDTO[$i]->getId() . '" class="mb-3">' . $categoriesDTO[$i]->getName() . '</strong>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-3 pb-3">
                ' . displayProductsCards($responseProducts[$i], $productsDTO[$i], $cartDAO) . '
            </div>';
  }

  return $content;
}

function displayProductsCards($products, $productsDTO, $cartDAO)
{
  $content = '';

  foreach ($products as $key => $product) {
    $exists = $cartDAO->productAlreadyInCart($productsDTO[$key]->getId());
    $icon = $exists
      ? '<a href="../cart_client/delete_product.php?id=' . $productsDTO[$key]->getId() . '" class="btn-product btn-danger">
                    <i class="bi bi-trash3-fill"></i>
                </a>'
      : '<a id="add" class="btn-product btn-success" href="catalog_client.php?productId=' . $productsDTO[$key]->getId() . '">
                    <i class="bi bi-plus-lg"></i>
                </a>';

    $content .= '
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 container-card">
                <div class="card card-initial m-2">
                    <img src="' . $productsDTO[$key]->getImage() . '" class="card-img-top card-img-top-initial" alt="...">
                    <div class="card-body card-body-initial">
                        <h5 class="card-title name-category-initial fw-bold">' . $productsDTO[$key]->getName() . '</h5>
                        <p class="card-text card-text-initial fw-bolder">' . $productsDTO[$key]->getDescription() . '</p>
                    </div>
                    <div class="mb-4 d-flex justify-content-around">
                        <h5 class="me-4 ">S/' . $productsDTO[$key]->getPrice() . '</h5>
                        <div class="text-end">
                            ' . $icon . '
                        </div>
                    </div>
                </div>
            </div>';
  }

  return $content;
}

displayBaseWeb($content);

?>
