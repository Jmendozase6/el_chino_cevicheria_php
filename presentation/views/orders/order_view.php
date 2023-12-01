<?php

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
    $orderProductDAO = new OrderProductDAO();

    $currentDate = (new DateTime('now'))->format('Y-m-d');
    $previousMonthDate = (new DateTime())->modify('-1 month')->format('Y-m-d');

    $totalSales = $orderProductDAO->getTotalSell($previousMonthDate, $currentDate);
    $responseOrders = $orderProductDAO->getOrdersWithUsers($previousMonthDate, $currentDate);
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>Pedidos</title>
</head>
<body>
<div class=" position-fixed vw-100 vh-100 bg-light">
  <div class="vh-100 bg-default mx-auto d-flex side-bar">
      <?php include '../components/side_bar.php' ?>
    <div class="container-fluid p-4">
      <h1 class="header-text fw-bold">Historial de pedidos</h1>
      <div class="row">
          <?php include '../components/side-menu-mobile.php' ?>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-4 bg-white shadow-sm rounded-4 p-4">
          <div class="row flex-column gap-2">

            <div class="col-12">
              <div class="form-control">
                <label for="from-date" class="form-label">Desde</label>
                <input type="date" class="form-control" id="from-date" name="from-date"
                       value="<?= $previousMonthDate ?>">
              </div>
            </div>

            <div class="col-12">
              <div class="form-control">
                <label for="to-date" class="form-label">Hasta</label>
                <input type="date" class="form-control" id="to-date" name="to-date" value="<?= $currentDate ?>">
              </div>
            </div>

          </div>
          <hr>
          <div class="row align-content-between">
            <div class="col">
              <p class="fw-bold fs-3">
                S/. <?= $totalSales['total_sales'] ?> ↓
                Este mes
              </p>
            </div>
          </div>
          <hr>
          <div>
              <?php foreach ($responseOrders as $order) { ?>
                <div class="row">
                  <div class="col-3 col-md-4 mb-1">
                    <img src="<?= $order['img'] ?>"
                         class="card-img-top rounded-2 object-fit-cover display-on-desktop"
                         style="width: 90px; height: 100px;"
                         alt="Logo usuario">
                  </div>
                  <div class="col-6 px-md-5">
                    <p class="fw-bold"><?= $order['name'] ?></p>
                    <p>Pedido #<?= $order['id'] ?></p>
                    <p>  <?= (new DateTime($order['created_at']))->format('d-m-Y') ?></p>
                  </div>
                  <div class="col-3 col-md-2 text-end">
                    <p class="fw-bold">S/ <?= $order['total'] ?></p>
                  </div>
                </div>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
