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
    $responseProducts = $productDAO->getProducts(200);
    $productsDTO = [];
    for ($i = 0; $i < sizeof($responseProducts); $i++) {
        $productsDTO[$i] = ProductDTO::createFromResponse($responseProducts[$i]);
    }
}
$categoryDAO = new CategoryDAO();

function getActive($active)
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
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/add_category_style.css">
</head>
<body>
<main class="container pt-4 pb-4">
  <div class="row align-content-between">
    <div class="col-4">
      <a href="../home/home_view.php" class="btn btn-outline-success"><i
            class="bi-arrow-left"></i></a>
    </div>
    <div class="col-4"><h1 class="py-2 fw-bold">Productos</h1></div>
    <div class="col-4"><a href="products_admin_view.php" class="btn btn-success float-end">Agregar</a></div>
  </div>
  <table class="table table-sm table-hover table-responsive">
    <thead class="table-dark">
    <tr>
      <!--      <th scope="col">ID</th>-->
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Imagen</th>
      <th scope="col">Precio</th>
      <th scope="col">Categoría</th>
      <th scope="col">Fecha de creación</th>
      <th scope="col">Descuento</th>
      <th scope="col">Estado</th>
      <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody id="content" name="content">
    <?php foreach ($productsDTO as $product) { ?>
      <tr>
        <!--        <td class="align-middle">--><?php //= $product->getId() ?><!--</td>-->
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
          <img class="img table-category-img" src="<?= $product->getImage() ?>" alt="imagen">
        </td>
        <td class="align-middle"><?= $product->getPrice() ?></td>
        <td class="align-middle"><?= $categoryDAO->getCategoryById($product->getIdCategory())['name'] ?></td>
        <td class="align-middle"><?= $product->getCreatedAt() ?></td>
        <td class="align-middle"><?= $product->getDiscount() ?></td>
        <td class="align-middle"><?= getActive($product->getActive()) ?></td>
        <td class="align-middle">
          <a href="?id=<?= $product->getId() ?>"
             class="col me-2 btn btn-outline-secondary"><i class="bi bi-pencil">
            </i></a>
          <a href="?id=<?= $product->getId() ?>"
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
