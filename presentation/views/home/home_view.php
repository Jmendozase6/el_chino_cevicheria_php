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
    session_start();
    $id = $_SESSION['id'];
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

    $betterClients = $userDAO->getBettersCustomers();
    $betterClientsDTO = [];
    for ($i = 0; $i < sizeof($betterClients); $i++) {
        $tempUser = UserDTO::createFromResponse($userDAO->getUserById($betterClients[$i]['id']));
        $betterClientsDTO[$i] = [
            "user" => $tempUser,
            "total" => $betterClients[$i]['total']
        ];
    }

} else {
    $modelUser = new UserDTO();
    $categoriesDTO = [];
    $responseCategories = [];
    $responseMostSellProduct = new OrderProductDTO();
    $mostSellProductDTO = new ProductDTO();
    $totalSales = null;
    $responseOrders = [];
    $betterClients = [];
    $betterClientsDTO = [];
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
  <title>Inicio</title>

</head>
<body>
<div class="position-fixed vw-100 vh-100 bg-light">
  <div class="vh-100 bg-default mx-auto d-flex side-bar">
      <?php include '../components/side_bar.php' ?>
    <div class="d-flex flex-column header-content">
      <div class="d-flex justify-content-between align-items-center p-4 mt-4">
        <h1 class="fs-1 header-text">Gestiona Tu Comercio</h1>
        <div class="d-flex flex-column content-search">
          <input class="form-control me-2 border-0 shadow-sm" type="search" placeholder="Buscar producto"
                 aria-label="Search">
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-9">
            <div class="p-4 bg-white rounded-4 shadow-sm d-flex flex-column content-menu">
              <h2>Menú</h2>
              <div class="row">
                <div class="col">
                  <p>Selecciona tu comida favorita</p>
                </div>
                <div class="col-auto">
                  <a href="#">Editar</a>
                </div>
              </div>
              <div class="row row-cols-4 row-cols-md-4 g-2">
                  <?php foreach ($categoriesDTO as $categoryDTO) { ?>
                    <div class="col">
                      <div class="card border-0">
                        <img src="<?= $categoryDTO->getImg() ?>" class="card-img-top rounded-2"
                             alt="..." height="180">
                        <div class="card-body">
                          <p class="card-text text-center">
                            <strong><?= $categoryDTO->getName() ?></strong></p>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="bg-white rounded-4 shadow-sm d-flex flex-column content-menu2">
              <h2 class="most-sold">Más vendidos</h2>
              <div class="row">
                <div class="col">
                  <p class="year">2023</p>
                </div>
              </div>
              <div class="">
                <div class="col">
                  <div class="card border-0">
                    <img src="<?= $mostSellProductDTO->getImage() ?>" class="card-img-top rounded-2"
                         alt="..." height="170">
                    <div class="card-body">
                      <p class="card-text text-center most-sold">
                        <strong><?= $mostSellProductDTO->getName() ?></strong></p>
                    </div>
                  </div>
                  <span class="badge text-bg-info p-2 "><?= $responseMostSellProduct['total_quantity'] ?> ventas</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <h4 class="title">Pedidos</h4>
          <div class="container bg-white col-md-6 row m-2 pb-3 p-4 rounded-4">
            <div class="row">
              <div class="col">
                <strong style="font-size: 2rem">Historial de pedidos</strong>
              </div>
              <div class="col-auto">
                <p>Últimos ↓</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <strong>S/<?= $totalSales['total_sales'] ?> ↓ </strong> | <strong> Este mes</strong>
              </div>
              <div class="table-group-divider m-3"></div>
            </div>
              <?php foreach ($responseOrders as $order) { ?>
                <div class="row pt-2">
                  <div class="col-2">
                    <img src="../../resources/image/<?= $order['img'] ?>" class="card-img-top rounded-2"
                         alt="Logo usuario">
                  </div>
                  <div class="col-4">
                    <p><strong><?= $order['name'] ?></strong></p>
                    <p>Pedido #<?= $order['id'] ?></p>
                  </div>
                  <div class="col-auto">
                    <p>S/ <?= $order['total'] ?> </p>
                  </div>
                </div>
              <?php } ?>
          </div>

          <div class="col-md-4">
            <h3 class="title">Mejores Clientes</h3>
            <div>
                <?php foreach ($betterClientsDTO as $bestClient) { ?>
                    <?php $total = $bestClient['total'] ?>
                    <?php $bestClient = $bestClient['user'] ?>
                  <div class="card mb-3" style="max-width: 400px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="../../resources/image/cat.jpg" class="img-fluid rounded-start"
                             alt="Foto del cliente">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title"><?= $bestClient->getName() . ' ' . $bestClient->getLastName() ?></h5>
                          <p><?= $bestClient->getEmail() ?></p>
                          <p class="card-text"><small class="text-muted">Total:
                              S/ <?= $total ?></small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--<h1>Datos del usuario:</h1>-->
  <!--<p>--><?php //echo $modelUser->__toString() ?><!--</p>-->
  <!--<h2>Si quieres acceder a una propiedad en específico lo haces así:</h2>-->
  <!--<p>--><?php //echo $modelUser->getName() ?><!--</p>-->

  <!---->
  <!--<h1>Categorías:</h1>-->
    <?php //foreach ($categoriesDTO as $categoryDTO) { ?>
  <!--    <p> --><?php //echo $categoryDTO->__toString() ?><!-- </p>-->
    <?php //} ?>
  <!---->
  <!--<h1>En caso de las categorías, no tienes autocompletado pero igual funcionan, mira, el método getName de la línea 75-->
  <!--    dice que no existe pero sí xd:</h1>-->
    <?php //foreach ($categoriesDTO as $categoryDTO) { ?>
  <!--    <p> --><?php //echo $categoryDTO->getName() ?><!-- </p>-->
    <?php //} ?>
  <!---->
  <!--<h1>Producto más vendido:</h1>-->
    <?php //echo $mostSellProductDTO->__toString() ?>
  <!--<p>Cantidad de ventas: --><?php //echo $responseMostSellProduct['total_quantity'] ?><!--</p>-->
  <!---->
  <!--<h1>Pedidos:</h1>-->
  <!--<h2>Historial de pedidos</h2>-->
  <!--<p>Total de ventas de todoooooooo: S/ --><?php //echo($totalSales['total_sales']); ?><!--</p>-->
  <!---->
  <!--<h1>Acá te dejo un ejemplo en una tabla de la lista de órdenes, los 3 datos que están en el diseño: nombre del usuario,-->
  <!--    id y precio total</h1>-->
  <!---->
  <!--<table class="table">-->
  <!--    <thead>-->
  <!--    <tr>-->
  <!--        <th scope="col">ID</th>-->
  <!--        <th scope="col">Total</th>-->
  <!--        <th scope="col">Usuario</th>-->
  <!--    </tr>-->
  <!--    </thead>-->
  <!--    <tbody>-->
  <!--    --><?php //foreach ($responseOrders as $order) { ?>
  <!--        <tr>-->
  <!--            <th scope="row">--><?php //echo $order['id'] ?><!--</th>-->
  <!--            <td>S/ --><?php //echo $order['total'] ?><!--</td>-->
  <!--            <td>--><?php //echo $order['name'] ?><!--</td>-->
  <!--        </tr>-->
  <!--    --><?php //} ?>
  <!--    </tbody>-->
  <!--</table>-->
  <!---->
  <!--<h1>Acá te dejo otro ejemplo pero con especie de tarjetas, son de bootstrap</h1>-->
  <!--<div class="row">-->
  <!--    --><?php //foreach ($responseOrders as $order) { ?>
  <!--        <div class="card p-0 m-2" style="width: 13rem;">-->
  <!--            <img src="https://picsum.photos/400/400" class="card-img-top" alt="img">-->
  <!--            <div class="card-body">-->
  <!--                <h5 class="card-title">--><?php //echo $order['name'] ?><!--</h5>-->
  <!--                <h6 class="card-subtitle mb-2 text-muted">--><?php //echo $order['id'] ?><!--</h6>-->
  <!--                <p class="card-text">--><?php //echo $order['total'] ?><!--</p>-->
  <!--            </div>-->
  <!--        </div>-->
  <!--    --><?php //} ?>
  <!--</div>-->

</body>
</html>
