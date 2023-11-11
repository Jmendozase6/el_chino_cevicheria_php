<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_access_objects/CategoryDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';

$categoryDAO = new CategoryDAO();
$responseCategories = $categoryDAO->getCategories(10);
$categoriesDTO = [];

if (isset($responseCategories)) {
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
  <title>El Chino Cevichería</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body>

<div class="row-cols-auto">
  <img class="w-auto" height="200" src="../../resources/images/logo.png" alt="Logo">
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col p-5 m-5">
      <h1><strong style="color: #EC4C6E">El Chino Cevichería 🐟</strong></h1>
      <h2 class="mt-3">¿Qué desea ordenar? 🍛</h2>
      <h3 class="mt-3">A domicilio 🚚</h3>
    </div>
    <div class="col-7 d-flex flex-column mt-5">
      <button class="btn btn-primary col-6 m-1 p-3">Catálogo</button>
      <button class="btn btn-success col-6 m-1 p-3">Whatsapp</button>
      <button class="btn btn-primary col-6 m-1 p-3">Contacto</button>
    </div>
  </div>
</div>
</body>
</html>

<?php //include "../components/custom_nav.php" ?>
<!--<div class="row">-->
<!--  <div class="col-auto">-->
<!--    <h1>Bienvenido a <strong>El Chino Cevichería</strong></h1>-->
<!--    <h2>¿Qué desea ordenar?</h2>-->
<!--  </div>-->
<!--</div>-->
<!--<nav class="navbar navbar-expand-lg">-->
<!--  <div>-->
<!--      --><?php //foreach ($categoriesDTO as $categoryDTO): ?>
<!--        <a href="../category_client/category_client_view.php?id=--><?php //= $categoryDTO->getId() ?><!--"-->
<!--           class="btn btn-outline-secondary">--><?php //= $categoryDTO->getName() ?><!--</a>-->
<!--      --><?php //endforeach; ?>
<!--  </div>-->
<!--</nav>-->