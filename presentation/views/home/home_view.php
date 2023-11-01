<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\OrderProductDTO;
use data_transfer_objects\ProductDTO;
use data_transfer_objects\UserDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';
require_once '../../../data_transfer_objects/OrderProductDTO.php';

if ($_GET) {
    $id = $_GET['id'];
    $userDAO = new UserDAO();
    $responseUser = $userDAO->getUserById($id);
    $modelUser = UserDTO::createFromResponse($responseUser);

    $categoryDAO = new CategoryDAO();
    $responseCategories = $categoryDAO->getCategories();
    $categoriesDTO = [];
    for ($i = 0; $i < sizeof($responseCategories); $i++) {
        $categoriesDTO[$i] = CategoryDTO::createFromResponse($responseCategories[$i]);
    }

    $orderProductDAO = new OrderProductDAO();
    $productDAO = new ProductDAO();

    $responseMostSellProduct = $orderProductDAO->getMostSellProduct();
    $responseProduct = $productDAO->getProductById($responseMostSellProduct['product_id']);

    $mostSellProductDTO = ProductDTO::createFromResponse($responseProduct);
    $totalSales = $orderProductDAO->getTotalSell();

    $responseOrders = $orderProductDAO->getOrdersWithUsers();
    print_r($responseOrders);


} else {
    $modelUser = new UserDTO();
    $categoriesDTO = [];
    $responseCategories = [];
    $responseMostSellProduct = new OrderProductDTO();
    $mostSellProductDTO = new ProductDTO();
    $totalSales = null;
    $responseOrders = [];
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inicio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<h1>Datos del usuario:</h1>
<p><?php echo $modelUser->__toString() ?></p>
<h2>Si quieres acceder a una propiedad en específico lo haces así:</h2>
<p><?php echo $modelUser->getName() ?></p>


<h1>Categorías:</h1>
<?php foreach ($categoriesDTO as $categoryDTO) { ?>
  <p> <?php echo $categoryDTO->__toString() ?> </p>
<?php } ?>

<h1>En caso de las categorías, no tienes autocompletado pero igual funcionan, mira, el método getName de la línea 75
  dice que no existe pero sí xd:</h1>
<?php foreach ($categoriesDTO as $categoryDTO) { ?>
  <p> <?php echo $categoryDTO->getName() ?> </p>
<?php } ?>

<h1>Producto más vendido:</h1>
<?php echo $mostSellProductDTO->__toString() ?>
<p>Cantidad de ventas: <?php echo $responseMostSellProduct['total_quantity'] ?></p>

<h1>Pedidos:</h1>
<h2>Historial de pedidos</h2>
<p>Total de ventas de todoooooooo: S/ <?php echo($totalSales['total_sales']); ?></p>

<h1>Acá te dejo un ejemplo en una tabla de la lista de órdenes, los 3 datos que están en el diseño: nombre del usuario, id y precio total</h1>

<table class="table">
  <thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Total</th>
    <th scope="col">Usuario</th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($responseOrders as $order) { ?>
    <tr>
      <th scope="row"><?php echo $order['id'] ?></th>
      <td>S/ <?php echo $order['total'] ?></td>
      <td><?php echo $order['name'] ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>

<h1>Acá te dejo otro ejemplo pero con especie de tarjetas, son de bootstrap</h1>
<div class="row">
    <?php foreach ($responseOrders as $order) { ?>
      <div class="card p-0 m-2" style="width: 13rem;">
        <img src="https://picsum.photos/400/400" class="card-img-top" alt="img">
        <div class="card-body">
          <h5 class="card-title"><?php echo $order['name'] ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?php echo $order['id'] ?></h6>
          <p class="card-text"><?php echo $order['total'] ?></p>
        </div>
      </div>
    <?php } ?>
</div>

</body>
</html>
