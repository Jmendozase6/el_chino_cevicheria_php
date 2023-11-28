<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\ProductDTO;

include '../landing/base_landing_view.php';

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/CategoryDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

$categoryDAO = new CategoryDAO();
$cartDAO = new CartDAO();
$productDAO = new ProductDAO();

$responseCategories = $categoryDAO->getCategories(12);
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

function displayCategoryCards()
{
    global $categoriesDTO;
    $content = '';

    for ($i = 0; $i < sizeof($categoriesDTO); $i++) {
        $content .= '
      <div class="col">
                <div class="card-initial">
                <a href="../categories_client/categories_client_view.php?categoryId=' . $categoriesDTO[$i]->getId() . '"> 
                 <img src="' . $categoriesDTO[$i]->getImg() . '" class="card-img-top-initial" alt="...">
                </a>
                    <div class="card-body-initial">
                        <h5 class="card-title-initial">' . $categoriesDTO[$i]->getName() . '</h5>
                        <p class="card-text-initial">' . $categoriesDTO[$i]->getId() . '</p>
                    </div>
                </div>
            </div>
    ';
    }
    return $content;
}

$content = '
  <!-- Categorías Populares -->
  <div class="container py-5">
        <h1 class="text-center">Popular Dishes</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 py-5">
        ' . displayCategoryCards() . '
        </div>
  </div>
';

displayBaseWeb($content);
?>
