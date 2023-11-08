<?php

use data_transfer_objects\CategoryDTO;

require_once '../../../data_access_objects/CategoryDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';

$categoryDAO = new CategoryDAO();
$responseCategories = $categoryDAO->getCategories();
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
<div class="wrapper">
    <?= include "../components/custom_nav.php" ?>
  <nav class="navbar navbar-expand-lg">
    <div class="">
        <?php foreach ($categoriesDTO as $categoryDTO): ?>
          <a href="../category_client/category_client_view.php?id=<?= $categoryDTO->getId() ?>"
             class="btn btn-outline-secondary"><?= $categoryDTO->getName() ?></a>
        <?php endforeach; ?>
    </div>
  </nav>
</div>
</body>
</html>
