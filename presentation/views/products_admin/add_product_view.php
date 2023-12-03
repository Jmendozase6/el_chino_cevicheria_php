<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_access_objects/CategoryDAO.php';

$categoryDAO = new CategoryDAO();
$categories = $categoryDAO->getCategories(20);
$categoriesDTO = [];

for ($i = 0; $i < sizeof($categories); $i++) {
    $categoriesDTO[$i] = CategoryDTO::createFromResponse($categories[$i]);
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agregar Producto</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="p-3">
<main>
  <div class="container">
    <div class="row mb-3 ps-2">
      <div class="col-12">
        <a href="javascript:history.back()" class="btn btn-outline-success"><i
              class="bi-arrow-left"></i></a>
      </div>
    </div>

    <!--formularo para agregar un producto con todas sus propiedades-->
    <form action="add_product.php" method="post" enctype="multipart/form-data">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1>Agregar Producto</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="id_category" class="mb-2">Categoría</label>
            <select name="id_category" id="id_category" class="form-control">
                <?php foreach ($categoriesDTO as $categoryDTO): ?>
                  <option value="<?php echo $categoryDTO->getId(); ?>"><?php echo $categoryDTO->getName(); ?></option>
                <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="name" class="mb-2">Nombre</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="description" class="mb-2">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="image" class="mb-2">Imagen</label>
            <input type="file" name="image" id="image" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="price" class="mb-2">Precio</label>
            <input type="number" name="price" id="price" class="form-control" value="0" min="0">
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <label for="discount" class="mb-2">Descuento</label>
            <input type="number" name="discount" id="discount" class="form-control" value="0" min="0" max="100">
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</main>
</body>
</html>
