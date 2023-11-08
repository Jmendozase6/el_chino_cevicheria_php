<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\ProductDTO;

require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

if ($_GET) {
    $categoryDAO = new CategoryDAO();
    $categoryId = $_GET['id'];
    $response = $categoryDAO->getCategoriesById($categoryId);
    $categoryDTO = CategoryDTO::createFromResponse($response);

    $productDAO = new ProductDAO();
    $responseProducts = $productDAO->getProductsByIdCategory($categoryId);

    $productsDTO = [];
    for ($i = 0; $i < sizeof($responseProducts); $i++) {
        $productsDTO[$i] = ProductDTO::createFromResponse($responseProducts[$i]);
    }
} else {
    $categoryDTO = null;
    $productsDTO = [];
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
<div class="container">
  <h1><?= $categoryDTO->getName() ?></h1>
</div>
<table class="table m-5">
  <thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Total</th>
    <th scope="col">Imagen</th>
    <th scope="col">Descuento</th>
    <th scope="col">Stock</th>
    <th scope="col">Precio</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($productsDTO as $product) { ?>
    <tr>
      <th scope="row"><?php echo $product->getId() ?></th>
      <th scope="row"><?php echo $product->getName() ?></th>
      <th scope="row"><img src="<?php echo $product->getImage() ?>" alt="Img producto" width=50></th>
      <th scope="row"><?= $product->getDiscount() ?></th>
      <th scope="row"><?= $product->getStock() ?></th>
      <th scope="row"><?= $product->getPrice() ?></th>
    </tr>
  <?php } ?>
  </tbody>
</table>

</body>
</html>
