<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_transfer_objects/CategoryDTO.php';

$id = $_GET['id'];
$categoryDAO = new CategoryDAO();
$categoryResponse = $categoryDAO->getCategoriesById($id);
$categoryDTO = CategoryDTO::createFromResponse($categoryDAO->getCategoriesById($id));

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
<!--Formulario para editar una categoría-->
<form action="" method="post" enctype="multipart/form-data">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="py-2">Editar Categoría</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $categoryDTO->getName() ?>" required>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <label for="image" class="form-label">Imagen</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
      </div>
    </div>
    <div class="row">
      <div class="input-field">
        <button type="submit" class="btn btn-primary my-2" name="btn-sign-in" id="btn-sign-in">Guardar
        </button>
      </div>
    </div>
  </div>
</body>
</html>
