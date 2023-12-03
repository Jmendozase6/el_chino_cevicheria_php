<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['id'] == null) {
    header('Location: ../sign_in/sign_in_view.php');
} elseif ($_SESSION['id_role'] != 1) {
    header('Location: ../initial_client/initial_client_view.php');
} else {
    $categoryDAO = new CategoryDAO();
    $responseCategories = $categoryDAO->getCategories(100);
    $categoriesDTO = [];
    for ($i = 0; $i < sizeof($responseCategories); $i++) {
        $categoriesDTO[$i] = CategoryDTO::createFromResponse($responseCategories[$i]);
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
  <title>Categorías</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/add_category_style.css">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body>
<div class="bg-light mx-auto d-flex side-bar">
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
          <a href="add_category_view.php" class="btn btn-success py-2 fw-bold">Agregar</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Categorías
            </div>
            <div class="card-body">
              <div class="table-responsive-xl">
                <div id="example_wrapper">
                  <table id="example" class="table table-striped data-table dataTable"
                         style="max-width: 100%;" role="grid" aria-describedby="example_info">
                    <thead>
                    <tr role="row">
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Imagen</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="content" name="content">
                    <?php foreach ($categoriesDTO as $category) { ?>
                      <tr>
                        <th class="align-middle" scope="row"><?= $category->getId() ?></th>
                        <td class="text-truncate align-middle">
                        <span class="d-inline-block text-truncate" style="max-width: 150px;">
                        <?= $category->getName() ?>
                        </span>
                        </td>
                        <td class="align-middle">
                          <img class="img table-category-img" src="<?= $category->getImg() ?>" alt="imagen">
                        </td>
                        <td class="align-middle">
                          <a href="edit_category_view.php?id=<?= $category->getId() ?>"
                             class="col me-2 btn btn-outline-secondary"><i class="bi bi-pencil">
                            </i></a>
                          <a href="delete_category.php?id=<?= $category->getId() ?>"
                             class="col me-2 btn btn-outline-secondary"><i class="bi bi-trash3"></i>
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
      </div>
      <!--      <table class="table table-sm table-hover">-->
      <!--        <thead class="table-dark">-->
      <!--        <tr>-->
      <!--          <th scope="col">ID</th>-->
      <!--          <th scope="col">Nombre</th>-->
      <!--          <th scope="col">Imagen</th>-->
      <!--          <th scope="col">Acciones</th>-->
      <!--        </tr>-->
      <!--        </thead>-->
      <!--        <tbody id="content" name="content">-->
      <!--        --><?php //foreach ($categoriesDTO as $category) { ?>
      <!--          <tr>-->
      <!--            <th class="align-middle" scope="row">--><?php //= $category->getId() ?><!--</th>-->
      <!--            <td class="text-truncate align-middle">-->
      <!--            <span class="d-inline-block text-truncate" style="max-width: 150px;">-->
      <!--            --><?php //= $category->getName() ?>
      <!--            </span>-->
      <!--            </td>-->
      <!--            <td class="align-middle">-->
      <!--              <img class="img table-category-img" src="-->
        <?php //= $category->getImg() ?><!--" alt="imagen">-->
      <!--            </td>-->
      <!--            <td class="align-middle">-->
      <!--              <a href="edit_category_view.php?id=--><?php //= $category->getId() ?><!--"-->
      <!--                 class="col me-2 btn btn-outline-secondary"><i class="bi bi-pencil">-->
      <!--                </i></a>-->
      <!--              <a href="delete_category.php?id=--><?php //= $category->getId() ?><!--"-->
      <!--                 class="col me-2 btn btn-outline-secondary"><i class="bi bi-trash3"></i>-->
      <!--              </a>-->
      <!--            </td>-->
      <!--          </tr>-->
      <!--        --><?php //} ?>
      <!--        </tbody>-->
      <!--      </table>-->
    </main>
  </div>
</div>
</body>
</html>
