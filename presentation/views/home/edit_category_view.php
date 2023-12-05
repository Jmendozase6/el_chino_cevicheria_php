<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_transfer_objects/CategoryDTO.php';

$id = $_GET['id'];
$categoryDAO = new CategoryDAO();
$categoryResponse = $categoryDAO->getCategoryById($id);
$categoryDTO = CategoryDTO::createFromResponse($categoryDAO->getCategoryById($id));
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Editar Categoría</title>
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<main class="p-2">
  <form
      action="edit_category.php?image=<?= $categoryDTO->getImg() ?>&id=<?= $categoryDTO->getId() ?>"
      method="post" enctype="multipart/form-data">

    <div class="container">

      <div class="row">
        <div class="col-auto p-0 my-2">
          <a href="categories_view.php" class="btn btn-outline-success"><i
                class="bi-arrow-left"></i></a>
        </div>
      </div>

      <div class="row">
        <p class="fw-bold fs-3 p-0">Editar</p>
      </div>

      <div class="row">
        <div class="col-12 p-0">
          <label for="name" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="name" name="name"
                 value="<?= $categoryDTO->getName() ?>" required>
        </div>
      </div>

      <div class="row pb-2">
        <div class="col-12 p-0">
          <label for="image" class="form-label">Imagen</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*"
                 value="<?= $categoryDTO->getImg() ?>">
        </div>
      </div>

      <div class="row">
        <div class="input-field p-0">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>

    </div>
  </form>
</main>
</body>
</html>
