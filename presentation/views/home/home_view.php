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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
  <title>Inicio</title>

</head>
<body>
<div class=" position-fixed vw-100 vh-100 bg-light">
  <div class="vh-100 bg-default mx-auto d-flex side-bar">
    <div class="side-menu bg-white vh-100">
      <img class="mx-auto d-flex justify-content-center" src="../../resources/image/logo.png" alt="logo"/>
      <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
             class="text-lg" height="1em" width="1em"
             xmlns="http://www.w3.org/2000/svg">
          <polygon fill="#E8EAF6" points="42,39 6,39 6,23 24,6 42,23"></polygon>
          <g fill="#C5CAE9">
            <polygon points="39,21 34,16 34,9 39,9"></polygon>
            <rect x="6" y="39" width="36" height="5"></rect>
          </g>
          <polygon fill="#B71C1C" points="24,4.3 4,22.9 6,25.1 24,8.4 42,25.1 44,22.9"></polygon>
          <rect x="18" y="28" fill="#D84315" width="12" height="16"></rect>
          <rect x="21" y="17" fill="#01579B" width="6" height="6"></rect>
          <path fill="#FF8A65"
                d="M27.5,35.5c-0.3,0-0.5,0.2-0.5,0.5v2c0,0.3,0.2,0.5,0.5,0.5S28,38.3,28,38v-2C28,35.7,27.8,35.5,27.5,35.5z"></path>
        </svg>
        <p>Inicio</p>
      </section>
      <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
             class="text-lg" height="1em" width="1em"
             xmlns="http://www.w3.org/2000/svg">
          <g fill="#3F51B5">
            <polygon points="17.8,18.1 10.4,25.4 6.2,21.3 4,23.5 10.4,29.9 20,20.3"></polygon>
            <polygon points="17.8,5.1 10.4,12.4 6.2,8.3 4,10.5 10.4,16.9 20,7.3"></polygon>
            <polygon points="17.8,31.1 10.4,38.4 6.2,34.3 4,36.5 10.4,42.9 20,33.3"></polygon>
          </g>
          <g fill="#90CAF9">
            <rect x="24" y="22" width="20" height="4"></rect>
            <rect x="24" y="9" width="20" height="4"></rect>
            <rect x="24" y="35" width="20" height="4"></rect>
          </g>
        </svg>
        <p>Pedidos</p>
      </section>
      <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
             class="text-lg" height="1em" width="1em"
             xmlns="http://www.w3.org/2000/svg">
          <g fill="#00BCD4">
            <rect x="19" y="22" width="10" height="20"></rect>
            <rect x="6" y="12" width="10" height="30"></rect>
            <rect x="32" y="6" width="10" height="36"></rect>
          </g>
        </svg>
        <p>Estadísticas</p>
      </section>
      <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
             class="text-lg" height="1em" width="1em"
             xmlns="http://www.w3.org/2000/svg">
          <path fill="#FFCCBC"
                d="M7,40V8c0-2.2,1.8-4,4-4h24c2.2,0,4,1.8,4,4v32c0,2.2-1.8,4-4,4H11C8.8,44,7,42.2,7,40z"></path>
          <g fill="#FF5722">
            <polygon points="42.7,24 32,33 32,15"></polygon>
            <rect x="14" y="21" width="23" height="6"></rect>
          </g>
        </svg>
        <p>Cerrar sesión</p>
      </section>
    </div>
    <div class="d-flex flex-column header-content">
      <div class="d-flex justify-content-between align-items-center p-4 mt-4">
        <h1 class="fs-4 header-text">Gestiona Tu Comercio</h1>
        <div class="d-flex flex-column content-search">
          <input class="form-control me-2 border-0 shadow-sm" type="search" placeholder="Buscar producto"
                 aria-label="Search">
        </div>
      </div>
      <div class="m-4 p-4 bg-white rounded-4 shadow-sm d-flex flex-column content-menu">
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
                  <img src="<?= $categoryDTO->getImg() ?>" class="card-img-top" alt="..." height="90">
                  <div class="card-body">
                    <p class="card-text text-center"><strong><?= $categoryDTO->getName() ?></strong></p>
                  </div>
                </div>
              </div>
            <?php } ?>
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
