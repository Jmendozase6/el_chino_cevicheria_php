<?php

use data_transfer_objects\CategoryDTO;
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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['id'] == null) {
    header('Location: ../sign_in/sign_in_view.php');
} elseif ($_SESSION['id_role'] != 1) {
    header('Location: ../initial_client/initial_client_view.php');
} else {
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

    $currentDate = (new DateTime('now'))->format('Y-m-d');
    $previousMonthDate = (new DateTime())->modify('-1 month')->format('Y-m-d');

    $responseMostSellProduct = $orderProductDAO->getMostSellProduct();
    $responseProduct = $productDAO->getProductById($responseMostSellProduct['product_id']);

    $mostSellProductDTO = ProductDTO::createFromResponse($responseProduct);
    $totalSales = $orderProductDAO->getTotalSell($previousMonthDate, $currentDate);

    $responseOrders = $orderProductDAO->getOrdersWithUsers($previousMonthDate, $currentDate);

    $betterClients = $userDAO->getBettersCustomers();
    $betterClientsDTO = [];
    for ($i = 0; $i < sizeof($betterClients); $i++) {
        $tempUser = UserDTO::createFromResponse($userDAO->getUserById($betterClients[$i]['id']));
        $betterClientsDTO[$i] = [
            "user" => $tempUser,
            "total" => $betterClients[$i]['total']
        ];
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
  <link rel="stylesheet" href="../../styles/home-view-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>Inicio</title>
</head>
<body>

<div class="bg-default mx-auto d-flex side-bar">
    <?php include '../components/side_bar.php' ?>
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center p-2">
      <div class="row">
          <?php include '../components/side-menu-mobile.php' ?>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 d-flex flex-column">
          <div class="p-4 bg-white rounded-4 shadow-sm content-menu">
            <h2>Menú</h2>
            <div class="row">
              <div class="col">
                <p>Selecciona tu comida favorita</p>
              </div>
              <div class="col-auto">
                <a href="categories_view.php">Editar</a>
              </div>
            </div>
            <div class="row">
                <?php foreach ($categoriesDTO as $categoryDTO) { ?>
                  <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card border-0">
                      <img src="<?= $categoryDTO->getImg() ?>" class="card-img-top rounded-2"
                           alt="Categoría" width="30">
                      <div class="card-body">
                        <p class="card-text text-center fw-bold category-title">
                            <?= $categoryDTO->getName() ?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
            </div>
          </div>
        </div
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-6 mb-2 bg-white shadow-sm rounded-4 p-4">
        <div class="row align-content-between">
          <div class="col">
            <p class="fw-bold fs-6">Historial de pedidos</p>
          </div>
          <div class="col-auto">
            <p class="fw-bold">
              S/. <?= $totalSales['total_sales'] ?> ↓
              Este mes
            </p>
          </div>
        </div>
        <hr>
          <?php foreach ($responseOrders as $order) { ?>
            <div class="row">
              <div class="col-sm-3 mb-1">
                <img src="../../resources/images/<?= $order['img'] ?>"
                     class="card-img-top rounded-2 object-fit-cover display-on-desktop"
                     style="width: 90px; height: 100px;"
                     alt="Logo usuario">
              </div>
              <div class="col-sm-6 px-4">
                <p class="fw-bold"><?= $order['name'] ?></p>
                <p>Pedido #<?= $order['id'] ?></p>
                <p>  <?= (new DateTime($order['created_at']))->format('d-m-Y') ?></p>
              </div>
              <div class="col-sm-3 text-end">
                <p>S/ <strong><?= $order['total'] ?></strong></p>
                <!--              <p>S/ --><?php //= (new DateTime('now'))->format('Y-m-d') ?><!-- </p>-->
              </div>
            </div>
          <?php } ?>
      </div>
      <div class="col-sm-12 col-md-6 mb-2 bg-white shadow-sm rounded-4 p-4">
        <div class="row align-content-between">
          <div class="col">
            <p class="fw-bold fs-6">Mejores Clientes</p>
          </div>
        </div>
        <hr>
          <?php foreach ($betterClientsDTO as $bestClient) {
              $bestClientUser = $bestClient['user']; ?>
            <div class="row">
              <div class="col-sm-3 mb-1">
                <img src="../../resources/images/<?= $bestClientUser->getImg() ?>"
                     class="card-img-top rounded-2 object-fit-cover display-on-desktop"
                     style="width: 90px; height: 100px;"
                     alt=" Logo usuario">
              </div>
              <div class="col-sm-6 px-4">
                <p class="fw-bold"><?= $bestClientUser->getName() . ' ' . $bestClientUser->getLastName() ?></p>
                <p><?= $bestClientUser->getLastName() ?></p>
              </div>
              <div class="col-sm-3 text-end">
                <p>S/ <strong><?= $bestClient['total'] ?></strong></p>
              </div>
            </div>
          <?php } ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
