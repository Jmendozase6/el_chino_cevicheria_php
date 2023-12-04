<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\OrderDTO;
use data_transfer_objects\OrderStatusDTO;
use data_transfer_objects\ProductDTO;
use data_transfer_objects\UserDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_access_objects/OrderDAO.php';
require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../data_transfer_objects/CategoryDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';
require_once '../../../data_transfer_objects/OrderDTO.php';
require_once '../../../data_transfer_objects/OrderProductDTO.php';
require_once '../../../data_transfer_objects/OrderStatusDTO.php';

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

    $responseMostSellProducts = $orderProductDAO->getMostSellProducts();
    $mostSellProductsDTO = [];
    for ($i = 0; $i < sizeof($responseMostSellProducts); $i++) {
        $mostSellProductsDTO[$i] = ProductDTO::createFromResponse($productDAO->getProductById($responseMostSellProducts[$i]['product_id']));
    }

    $totalSales = $orderProductDAO->getTotalSell($previousMonthDate, $currentDate);

    $responseOrders = $orderProductDAO->getOrdersByDay();
    $ordersDTO = [];
    $ordersDTO = array_map(function ($order) {
        return OrderDTO::createFromResponse($order);
    }, $responseOrders);

    $betterClients = $userDAO->getBettersCustomers();
    $betterClientsDTO = [];
    for ($i = 0; $i < sizeof($betterClients); $i++) {
        $tempUser = UserDTO::createFromResponse($userDAO->getUserById($betterClients[$i]['id']));
        $betterClientsDTO[$i] = [
            "user" => $tempUser,
            "total" => $betterClients[$i]['total']
        ];
    }

    $orderDAO = new OrderDAO();

//    KPI
    $quantityClients = $userDAO->getQuantityClients();
    $monthlySales = $orderProductDAO->getTotalSell($previousMonthDate, $currentDate)['total_sales'];
    $quantityDayOrders = $orderDAO->getQuantityOrdersDay()['quantity'];
    $dailySales = $orderDAO->getDailySales()['total'];

//    Gráficas
    $labels = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    $dataEarnsChart = $orderDAO->getEarnedByDays();
    $dataQtyClientsDaily = $userDAO->getQuantityClientsByDays();

//   Datos a json
    $jsonDataNewClients = json_encode($dataEarnsChart);
    $jsonDataQtyClientsDaily = json_encode($dataQtyClientsDaily);

    $jsonLabelsDays = json_encode($labels);
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
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
  <link rel="stylesheet" href="../../styles/home-view-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <div class="container-fluid container-fluid-content">
      <div class="row">
        <div class="col-md-3 mb-3">
          <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">Cantidad de clientes</div>
            <div class="card-footer d-flex">
                <?= $quantityClients ?> Clientes
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-warning text-dark h-100">
            <div class="card-body py-5">Ganancias Mensuales</div>
            <div class="card-footer d-flex">
              S/. <?= $monthlySales ?>
              <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-success text-white h-100">
            <div class="card-body py-5">Cantidad de órdenes del día</div>
            <div class="card-footer d-flex">
                <?= $quantityDayOrders ?>
              <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-danger text-white h-100">
            <div class="card-body py-5">Ganancias del día</div>
            <div class="card-footer d-flex">
              S./ <?= $dailySales ?>
              <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
            </div>
          </div>
        </div>
      </div>
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
      <div class="row pe-0">
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Ganancias por día
            </div>
            <div class="card-body">
              <canvas class="chart" width="1052" height="526"
                      style="display: block; box-sizing: border-box; height: 100%; width: 100%;"
                      id="weekly-earnings-chart"></canvas>
              <script type="text/javascript">
                  const chartWeekly = document.getElementById("weekly-earnings-chart");
                  const labelsWeekly = <?= $jsonLabelsDays ?>;
                  const dataWeeklyEarnings = {
                      label: "Ganancias Diarias",
                      data: <?= $jsonDataNewClients?>,
                      borderWidth: 1,
                  };
                  new Chart(chartWeekly, {
                      type: 'line',
                      data: {
                          labels: labelsWeekly,
                          datasets: [
                              dataWeeklyEarnings,
                          ]
                      },
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          },
                      }
                  });
              </script>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3 pe-0">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Clientes Nuevos
            </div>
            <div class="card-body">
              <canvas class="chart" width="1052" height="526"
                      style="display: block; box-sizing: border-box; height: 100%; width: 100%;"
                      id="qty-clients"></canvas>
              <script type="text/javascript">
                  const chartQtyClients = document.getElementById("qty-clients");
                  const dataQtyClients = {
                      label: "Cantidad de Clientes por Día",
                      data: <?= $jsonDataQtyClientsDaily?>,
                      borderWidth: 1,
                  };
                  new Chart(chartQtyClients, {
                      type: 'line',
                      data: {
                          labels: labelsWeekly,
                          datasets: [
                              dataQtyClients,
                          ]
                      },
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          },
                      }
                  });
              </script>
            </div>
          </div>
        </div>
      </div>
      <div class="row pe-0">
        <div class="col-md-12 mb-3 pe-0">
          <div class="card mb-5">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> Órdenes del día
            </div>
            <div class="card-body">
              <div class="table-responsive-xl">
                <div id="example_wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="example" class="table table-striped data-table"
                             style="width: 100%;" role="grid" aria-describedby="example_info">
                        <thead>
                        <tr role="row">
                          <th>ID</th>
                          <th>ID Usuario</th>
                          <th>ID Pago</th>
                          <th>Total</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ordersDTO as $order) { ?>
                          <tr>
                            <td><?= $order->getId() ?></td>
                            <td><?= $order->getUserId() ?></td>
                            <td><?= $order->getPaymentId() ?></td>
                            <td>S/. <?= $order->getTotal() ?></td>
                            <td><?= (new OrderStatusDTO)::getStatusByCode($order->getOrderStatus()) ?></td>
                            <td>
                              <form action="../orders/order_view_details_admin.php"
                                    method="post"
                                    enctype="multipart/form-data">
                                <input type="hidden" name="order_id" id="order_id"
                                       value="<?= $order->getId() ?>">
                                <input type="submit" class="btn btn-primary"
                                       value="Ver">
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
<script src="../../resources/js/jquery-3.7.0.js"></script>
<script src="../../resources/js/jquery.dataTables.min.js"></script>
<script src="../../resources/js/dataTables.bootstrap5.min.js"></script>
<script src="../../resources/js/script.js"></script>
</body>
</html>
