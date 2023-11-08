<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_access_objects/CategoryDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';

if ($_GET) {
    $categoryDAO = new CategoryDAO();
    $categoryId = $_GET['id'];
    $response = $categoryDAO->getCategoryById($categoryId);
    $categoryDTO = CategoryDTO::createFromResponse($response);
} else {
    $categoryDTO = null;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Categoría <?= $categoryDTO->getName() ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body>
<div class="wrapper">
  <div class="row">
    <button href="../home_client/home_client_view.php" class="btn btn-primary">Wolver</button>
  </div>
</div>
</body>
</html>
