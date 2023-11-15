<?php

require_once '../../../data_access_objects/CartDAO.php';

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

$cartDAO = new CartDAO();
$responseProductsFromCart = $cartDAO->getProductsFromCart();
$productsFromCartDTO = [];

// QUITAR LUEGO ABAJO
$productDAO = new ProductDAO();
$responseProductsFromCart = [
    ['id' => 1, 'name' => 'Producto 1', 'description' => 'Descripción del producto 1', 'image' => 'https://picsum.photos/200/300', 'price' => 10, 'quantity' => 1],
    ['id' => 2, 'name' => 'Producto 2', 'description' => 'Descripción del producto 2', 'image' => 'https://picsum.photos/200/300', 'price' => 20, 'quantity' => 2],
    ['id' => 3, 'name' => 'Producto 3', 'description' => 'Descripción del producto 3', 'image' => 'https://picsum.photos/200/300', 'price' => 30, 'quantity' => 3],
    ['id' => 4, 'name' => 'Producto 4', 'description' => 'Descripción del producto 4', 'image' => 'https://picsum.photos/200/300', 'price' => 40, 'quantity' => 4],
    ['id' => 5, 'name' => 'Producto 5', 'description' => 'Descripción del producto 5', 'image' => 'https://picsum.photos/200/300', 'price' => 50, 'quantity' => 5],
    ['id' => 6, 'name' => 'Producto 6', 'description' => 'Descripción del producto 6', 'image' => 'https://picsum.photos/200/300', 'price' => 60, 'quantity' => 6],
    ['id' => 7, 'name' => 'Producto 7', 'description' => 'Descripción del producto 7', 'image' => 'https://picsum.photos/200/300', 'price' => 70, 'quantity' => 7],
    ['id' => 8, 'name' => 'Producto 8', 'description' => 'Descripción del producto 8', 'image' => 'https://picsum.photos/200/300', 'price' => 80, 'quantity' => 8],
    ['id' => 9, 'name' => 'Producto 9', 'description' => 'Descripción del producto 9', 'image' => 'https://picsum.photos/200/300', 'price' => 90, 'quantity' => 9],
    ['id' => 10, 'name' => 'Producto 10', 'description' => 'Descripción del producto 10', 'image' => 'https://picsum.photos/200/300', 'price' => 100, 'quantity' => 10],
    ['id' => 11, 'name' => 'Producto 11', 'description' => 'Descripción del producto 11', 'image' => 'https://picsum.photos/200/300', 'price' => 110, 'quantity' => 11],
];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/cart-client-style.css">
  <title>Carrito</title>
</head>
<body>
<!-- Si el carrito está vacío, muestra esta sección -->
<?php if (sizeof($responseProductsFromCart) == 0) { ?>
  <div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
      <div class="text-center">
        <strong style="font-size: 2rem">Carrito de compras</strong> <br> <br>
        <img src="../../resources/images/empty.png" alt="Carrito Vacío"> <br> <br>
        <span>No hay productos agregados</span>
      </div>
    </div>
  </div>
<?php } else { ?>
  <!--  Si el carrito tiene productos, muestra esto-->
  <div class="container d-flex flex-column justify-content-center align-content-center w-50 py-1 mb-3"
       style="background: #F6F6F6">
    <div class="row">
      <div class="col">
        <a class="d-flex align-items-center h-100 text-decoration-none text-black"><-Atrás </a>
      </div>
      <div class="col-auto">
        <div class="row">
          <p>Su carrito</p>
        </div>
        <div class="row">
          <strong>S/. 32.00</strong>
        </div>
      </div>
    </div>
  </div>
    <?php for ($i = 0; $i < sizeof($responseProductsFromCart); $i++) { ?>
    <!--    Lista de Productos    -->
    <div class="container d-flex flex-column justify-content-center align-content-center w-50 py-1">
      <div class="row py-1 justify-content-between">
        <div class="col-auto">
          <img src="<?= $responseProductsFromCart[$i]['image'] ?>" alt="Producto" class="img-fluid rounded-3"
               style="height: 90px">
        </div>
        <div class="col">
          <div class="row">
            <strong><?= $responseProductsFromCart[$i]['name'] ?></strong>
          </div>
          <div class="row">
            <p class="text-secondary"><?= $responseProductsFromCart[$i]['description'] ?></p>
          </div>
        </div>
        <div class="col-3 text-end">
          <button id="add" class="btn btn-success">
            <i class="bi bi-plus-lg"></i>
          </button>
          <span class="align-middle m-2 fs-5" id="quantity"><?= $responseProductsFromCart[$i]['quantity'] ?></span>
          <button id="delete" class="btn btn-danger">
            <i class="bi bi-trash3-fill"></i>
          </button>
        </div>
      </div>
      <hr class="border-top border-dark"/>
    </div>
    <?php }
} ?>

</body>
</html>
