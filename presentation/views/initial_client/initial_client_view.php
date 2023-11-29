<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\ProductDTO;

include_once '../landing/base_landing_view.php';

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

$productsFilter = $productDAO->getProducts();
$productsFilterDTO = [];

for ($i = 0; $i < sizeof($productsFilter); $i++) {
  $productsFilterDTO[$i] = ProductDTO::createFromResponse($productsFilter[$i]);
}

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

function displayProductsCardsInitial()
{
  global $productsFilterDTO, $cartDAO;
  $content = '';
  for ($i = 0;
       $i < sizeof($productsFilterDTO);
       $i++) {

    $exists = $cartDAO->productAlreadyInCart($productsFilterDTO[$i]->getId());
    $icon = $exists ?
      '<a href="../cart_client/delete_product.php?id=' . $productsFilterDTO[$i]->getId() . '"
                                 class="btn-product btn-danger">
                                <i class="bi bi-trash3-fill"></i></a>'
      :
      '<a id="add" class="btn-product btn-success"
                                 href="categories_client.php?productId=' . $productsFilterDTO[$i]->getId() . '">
                                <i class="bi bi-plus-lg"></i>
                              </a>';

    $content .= '
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3 container-card">
                <div class="card card-initial m-2">
                    <img src="' . $productsFilterDTO[$i]->getImage() . '" class="card-img-top card-img-top-initial" alt="...">
                    <div class="card-body card-body-initial">
                        <h5 class="card-title name-category-initial fw-bold">' . $productsFilterDTO[$i]->getName() . '</h5>
                        <p class="card-text card-text-initial fw-bolder">' . $productsFilterDTO[$i]->getDescription() . '</p>
                    </div>
                    <div class="mb-4 d-flex justify-content-around">
                        <h5 class="me-4 ">S/' . $productsFilterDTO[$i]->getPrice() . '</h5>
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

function displayCategoryCards()
{
  global $categoriesDTO, $categoryDAO;
  $content = '';

  for ($i = 0; $i < 4; $i++) {
    $quantity = $categoryDAO->quantityProductsByCategory($categoriesDTO[$i]->getId());
    $content .= '
      <div class="col-12 col-sm-6 col-md-3 col-lg-3 container-card">
    <div class="card card-initial">
        <a href="../categories_client/categories_products_view.php?categoryId=' . $categoriesDTO[$i]->getId() . '">
            <img src="' . $categoriesDTO[$i]->getImg() . '" class="card-img-top card-img-top-initial" alt="...">
        </a>
        <div class="card-body card-body-initial">
            <h5 class="card-title name-category-initial fw-bold">' . $categoriesDTO[$i]->getName() . '</h5>
            <p class="card-text card-text-initial fw-bolder">Cantidad de platos: ' . $quantity["quantity"] . '</p>
        </div>
    </div>
</div>
    ';
  }
  return $content;
}

$content = '
<div class="wrapper-initial">
  <h1 class="text-center title-initial mb-4 fw-bold">Bienvenido a El Chino Cevichería</h1>
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
       <a href="../categories_client/categories_view.php" class="d-flex align-items-center">Ver todo <img class="ms-2"
            src="../../resources/icons/arrow_02.svg" alt="Flecha"></a>
    </di>
    <div class="row row-cols-1 row-cols-md-3 g-2 pb-3">
        ' . displayCategoryCards() . '
    </div>
    
    <di class="d-flex justify-content-between title-category">
     <h4 class="fw-bold">Productos</h4>
       <a href="../catalog_client/catalog_client_view.php" class="d-flex align-items-center">Ver todo <img class="ms-2"
            src="../../resources/icons/arrow_02.svg" alt="Flecha"></a>
    </di>
    <div class="container">
        <div class="row">
                ' . displayProductsCardsInitial() . '
        </div>
    </div>
</div>
</div>
';

displayBaseWeb($content);
?>
