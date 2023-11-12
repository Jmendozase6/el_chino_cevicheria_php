<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\ProductDTO;

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

$categoryDAO = new CategoryDAO();
$responseCategories = $categoryDAO->getCategories(20);
$categoriesDTO = [];

for ($i = 0; $i < sizeof($responseCategories); $i++) {
    $categoriesDTO[$i] = CategoryDTO::createFromResponse($responseCategories[$i]);
}

$responseProducts = [];
$productDAO = new ProductDAO();
for ($i = 0; $i < sizeof($categoriesDTO); $i++) {
    $responseProducts[$i] = $productDAO->getProductsByIdCategory($categoriesDTO[$i]->getId());
}

$productsDTO = [];

for ($i = 0; $i < sizeof($responseProducts); $i++) {
    for ($j = 0; $j < sizeof($responseProducts[$i]); $j++) {
        $productsDTO[$i][$j] = ProductDTO::createFromResponse($responseProducts[$i][$j]);
    }
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Carta</title>
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/catalog-client-style.css">
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-8">

      <img src="https://placehold.co/1080x300" alt="Logo">
      <h1><strong>El Chino Cevichería</strong></h1>

      <!--    Lista de categorías del menú   -->
      <header id="header-categories">
        <div class="row">
          <strong>Selecciona una categoría</strong>
          <div class="col">
              <?php foreach ($categoriesDTO as $categoryDTO) { ?>
                <a type="button" class="btn btn-outline-success py-2 px-4"
                   href="#<?= $categoryDTO->getId() ?>"><?= $categoryDTO->getName() ?></a>
              <?php } ?>
          </div>
        </div>
      </header>

      <!--    Secciones de Categorías del Menú    -->
      <div class="container my-2">
          <?php for ($i = 0; $i < sizeof($categoriesDTO); $i++) { ?>
            <div class="row">
              <div class="col my-1">
                <strong id="<?= $categoriesDTO[$i]->getId() ?>" class="mb-3"><?= $categoriesDTO[$i]->getName() ?></strong>
              </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                <?php for ($j = 0; $j < sizeof($responseProducts[$i]); $j++) { ?>
                  <div class="col">
                    <div class="card">
                      <img src="<?= $productsDTO[$i][$j]->getImage() ?>" class="card-img-top" alt="..." height="150">
                      <div class="card-body">
                        <h5 class="card-title"><?= $productsDTO[$i][$j]->getName() ?></h5>
                        <p class="card-text">Precio: S/<?= $productsDTO[$i][$j]->getPrice() ?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
            </div>
          <?php } ?>
      </div>

    </div>
  </div>
</div>
</body>
</html>
