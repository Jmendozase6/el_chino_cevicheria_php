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
  global $categoriesDTO, $categoryDAO;
  $content = '';

  for ($i = 0; $i < sizeof($categoriesDTO); $i++) {
    $quantity = $categoryDAO->quantityProductsByCategory($categoriesDTO[$i]->getId());
    $content .= '
      <div class="col-12 col-sm-6 col-md-3 col-lg-3 container-card">
    <div class="card card-initial">
        <a href="../categories_client/categories_client_view.php?categoryId=' . $categoriesDTO[$i]->getId() . '">
            <img src="' . $categoriesDTO[$i]->getImg() . '" class="card-img-top card-img-top-initial" alt="...">
        </a>
        <div class="card-body card-body-initial">
            <h5 class="card-title name-category-initial fw-bold">' . $categoriesDTO[$i]->getName() . '</h5>
            <p class="card-text card-text-initial">Cantidad de platos: ' . $quantity["quantity"] . '</p>
        </div>
    </div>
</div>
    ';
  }
  return $content;
}

$content = '
<div class="wrapper-initial">
<div class="container container-initial">
    <div class="row row-about-us-02 row-initial">
        <div class="col-sm-6 col-md-4 col-lg-3 d-flex flex-row align-items-center container-featured container-featured-modified">
            <img class="me-2 mt-1" src="../../resources/icons/delivery.svg" alt="Delivery">
            <div class="flex-column">
                <h6>Contamos con delivery</h6>
                <p>Recibimos comentarios</p>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 d-flex flex-row align-items-center container-featured">
            <img class="me-2 mt-1" src="../../resources/icons/secure_payment.svg" alt="Pago seguro">
            <div class="flex-column">
                <h6>Pago 100% seguro</h6>
                <p>Pagos de forma segura</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 flex-row align-items-center container-featured container-featured-display-book">
            <img class="me-2 mt-1" src="../../resources/icons/headphones.svg" alt="Audifono">
            <div class="flex-column">
                <h6>Libro de reclamaciones</h6>
                <p>Puedes dejar tu queja.</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-3 flex-row align-items-center container-featured container-featured-display">
            <img class="me-2 mt-1" src="../../resources/icons/package.svg" alt="Paquete">
            <div class="flex-column">
                <h6>Innovación</h6>
                <p>Estamos constantemente innovándonos</p>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <di class="d-flex justify-content-between title-category">
     <h4 class="fw-bold">Categorias</h4>
    </di>
    <div class="row row-cols-1 row-cols-md-3 g-4 py-5">

        ' . displayCategoryCards() . '
    </div>
</div>
</div>
';

displayBaseWeb($content);
?>
