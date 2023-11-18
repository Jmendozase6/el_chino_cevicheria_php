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
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../styles/catalog-client-style.css">
    <title>Carta</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center container-catalog">
    <div class="row">
        <div class="col">

            <img src="https://placehold.co/1080x300" alt="Logo">
            <div class="row">
                <h1 class="pt-3"><strong>El Chino Cevichería</strong></h1>
                <div class="text-end">
                    <a href="../cart_client/cart_client_view.php" class="text-decoration-none">Ir al carrrito <i class="bi bi-bag"></i></a>
                </div>
            </div>


            <!--    Lista de categorías del menú   -->
            <header class="header-categories">
                <div class="row">
                    <strong>Selecciona una categoría</strong>
                    <div class="col pt-2">
                      <?php foreach ($categoriesDTO as $categoryDTO) { ?>
                          <a type="button" class="btn btn-outline-success py-2 px-4 category-link"
                             data-target="<?= $categoryDTO->getId() ?>"> <?= $categoryDTO->getName() ?></a>
                      <?php } ?>
                    </div>
                </div>
            </header>

            <!--    Secciones de Categorías del Menú    -->
            <div class="container my-2">
              <?php for ($i = 0; $i < sizeof($categoriesDTO); $i++) { ?>
                  <div class="row">
                      <div class="col my-1">
                          <strong id="category-<?= $categoriesDTO[$i]->getId() ?>"
                                  class="mb-3"><?= $categoriesDTO[$i]->getName() ?></strong>
                      </div>
                  </div>
                  <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php for ($j = 0; $j < sizeof($responseProducts[$i]); $j++) { ?>
                        <div class="col mb-3">
                            <div class="card">
                                <img src="<?= $productsDTO[$i][$j]->getImage() ?>" class="card-img-top" alt="..." height="150">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $productsDTO[$i][$j]->getName() ?></h5>
                                    <p class="card-text">Precio: S/<?= $productsDTO[$i][$j]->getPrice() ?></p>
                                    <div class="text-end">
                                        <a id="add" class="btn btn-success"
                                           href="catalog_client.php?productId=<?= $productsDTO[$i][$j]->getId() ?>">
                                            <i class="bi bi-plus-lg"></i>
                                        </a>
                                    </div>
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
<script src="../../resources/script/scrollScript.js"></script>
</body>
</html>