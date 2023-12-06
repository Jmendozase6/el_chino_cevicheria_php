<?php

use data_transfer_objects\OrderDTO;
use data_transfer_objects\OrderStatusDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/OrderProductDTO.php';
require_once '../../../data_transfer_objects/OrderStatusDTO.php';
require_once '../../../data_transfer_objects/OrderDTO.php';


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
    $responseOrders = $orderProductDAO->getOrdersByDate();

    $ordersFilterDTO = [];

    foreach ($responseOrders as $responseOrder) {
        $ordersFilterDTO[] = OrderDTO::createFromResponse($responseOrder);
    }
    $totalSales = $orderProductDAO->getTotalSell($previousMonthDate, $currentDate);
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pedidos</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"
  />
  <!-- Font Awesome -->
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
  />
</head>
<body class="bg-light">
<div class="vh-100 bg-default mx-auto d-flex side-bar">
    <?php include '../components/side_bar.php' ?>
  <div class="container-fluid p-4">
    <div class="row">
        <?php include '../components/side-menu-mobile.php' ?>
    </div>
    <div class="container-fluid container-fluid-content">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="row pe-0">
            <div class="col-md-12 mb-3 pe-0">
              <div class="card mb-5">
                <div class="card-header">
                  <span><i class="bi bi-table me-2"></i></span> Órdenes
                </div>
                <div class="card-body">
                  <div class="table-responsive-xl">
                    <div id="example_wrapper">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="example" class="data-table table"
                                 style="width: 100%;" role="grid" aria-describedby="example_info">
                            <thead>
                            <tr role="row">
                              <th>ID</th>
                              <th>ID Usuario</th>
                              <th>ID Pago</th>
                              <th>Total</th>
                              <th>Estado</th>
                              <th>Fecha</th>
                              <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($ordersFilterDTO as $order) { ?>
                              <tr>
                                <td><?= $order->getId() ?></td>
                                <td><?= $order->getUserId() ?></td>
                                <td><?= $order->getPaymentId() ?></td>
                                <td>S/. <?= $order->getTotal() ?></td>
                                <td><?= (new OrderStatusDTO)::getStatusByCode($order->getOrderStatus()) ?></td>
                                <td><?= $order->getCreatedAt() ?></td>
                                <td>
                                  <form action="order_view_details_admin.php" method="post"
                                        enctype="multipart/form-data">
                                    <input type="hidden" name="order_id" id="order_id"
                                           value="<?= $order->getId() ?>">
                                    <input type="submit" class="btn btn-primary" value="Ver">
                                  </form>
                                </td>
                              </tr>
                            <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
    <!-- DataTable -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script
        src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script
        src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script
        src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.min.js"></script>
    <script
        src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script
        src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>
    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../resources/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../resources/js/script.js"></script>
</body>
</html>
