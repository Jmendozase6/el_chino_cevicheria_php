<?php

use data_transfer_objects\ProductDTO;

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/ProductDTO.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['id'] == null) {
    header('Location: ../sign_in/sign_in_view.php');
} elseif ($_SESSION['id_role'] != 1) {
    header('Location: ../initial_client/initial_client_view.php');
} else {
    $productDAO = new ProductDAO();
    $responseProducts = $productDAO->getProducts(200, false);
    $productsDTO = [];
    for ($i = 0; $i < sizeof($responseProducts); $i++) {
        $productsDTO[$i] = ProductDTO::createFromResponse($responseProducts[$i]);
    }
}
$categoryDAO = new CategoryDAO();

function getActive($active): string
{
    return $active == 1 ? 'Activo' : 'Inactivo';
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Productos</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/add_category_style.css">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body>
<div class="bg-default mx-auto d-flex side-bar">
    <?php include '../components/side_bar.php' ?>
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center p-2">
      <div class="row">
          <?php include '../components/side-menu-mobile.php' ?>
      </div>
    </div>
    <main class="container-fluid container-fluid-content">
      <div class="row">
        <div class="col mb-3">
          <a href="../products_admin/add_product_view.php" class="btn btn-success py-2 fw-bold">Agregar</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Productos
            </div>
            <div class="card-body">
              <div class="table-responsive-xl">
                <div id="example_wrapper">
                  <table class="table table-sm table-hover table-responsive data-table"
                         id="product-list"
                         name="product-list">
                    <thead class="table-dark">
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripción</th>
                      <th scope="col">Imagen</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Categoría</th>
                      <!--      <th scope="col">Fecha de creación</th>-->
                      <th scope="col">Estado</th>
                      <th scope="col">Descuento</th>
                      <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="content" name="content">
                    <?php foreach ($productsDTO as $product) { ?>
                      <tr>
                        <td class="text-truncate align-middle">
                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                        <?= $product->getName() ?>
                        </span>
                        </td>
                        <td class="text-truncate align-middle">
                        <span class="d-inline-block text-truncate" style="max-width: 150px;">
                        <?= $product->getDescription() ?>
                        </span>
                        </td>
                        <td class="align-middle">
                          <img class="img table-category-img"
                               src="<?= $product->getImage() ?>" alt="imagen">
                        </td>
                        <td class="align-middle"><?= $product->getPrice() ?></td>
                        <td class="align-middle"><?= $categoryDAO->getCategoryById($product->getIdCategory())['name'] ?></td>
                        <!--        <td class="align-middle">-->
                          <?php //= $product->getCreatedAt() ?><!--</td>-->
                        <td class="align-middle"><?= getActive($product->getActive()) ?></td>
                        <td class="align-middle"><?= $product->getDiscount() ?></td>
                        <td class="align-middle">
                          <a href="../products_admin/edit_product_view.php?id=<?= $product->getId() ?>"
                             class="col me-2 btn btn-outline-secondary"><i
                                class="bi bi-pencil">
                            </i></a>
                          <a href="../products_admin/delete_product.php?id=<?= $product->getId() ?>"
                             class="col me-2 btn btn-outline-secondary"><i
                                class="bi bi-trash3 text-danger"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
  </div>
</div>
<script src="../../resources/js/jquery-3.7.0.js"></script>
<script src="../../resources/js/jquery.dataTables.min.js"></script>
<script src="../../resources/js/dataTables.bootstrap5.min.js"></script>
<script src="../../resources/js/script.js"></script>
</body>
</html>
