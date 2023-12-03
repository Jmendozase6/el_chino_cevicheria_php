<?php
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agregar una categoría</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<main class="p-2">
  <form
      action="add_category.php"
      method="post" enctype="multipart/form-data">

    <div class="container">

      <div class="row">
        <div class="col-auto p-0 my-2">
          <a href="categories_view.php" class="btn btn-outline-success"><i
                class="bi-arrow-left"></i></a>
        </div>
      </div>

      <div class="row">
        <p class="fw-bold fs-3 p-0">Agregar</p>
      </div>

      <div class="row">
        <div class="col-12 p-0">
          <label for="name" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="name" name="name"
                 required>
        </div>
      </div>

      <div class="row pb-2">
        <div class="col-12 p-0">
          <label for="image" class="form-label">Imagen</label>
          <input type="file" class="form-control" id="image" name="image" accept="image/*">
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
