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
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/add_category_style.css">
</head>
<body>
<main class="container pt-4 pb-4">
  <div class="row align-content-between">
    <div class="col-4">
      <a href="home_view.php" class="btn btn-outline-success"><i
            class="bi-arrow-left"></i></a>
    </div>
    <div class="col-4"><h1 class="py-2 fw-bold">Menú</h1></div>
    <div class="col-4"><a href="add_category_view.php" class="btn btn-success float-end">Agregar</a></div>
  </div>
  <table class="table table-sm table-hover">
    <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Imagen</th>
      <th scope="col">Acciones</th>
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
</main>
</body>
</html>
