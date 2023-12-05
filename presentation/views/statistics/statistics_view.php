<?php

use data_transfer_objects\CategoryDTO;
use data_transfer_objects\OrderDTO;
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
    $responseCategories = $categoryDAO->getCategoriesWithProducts();
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
    $dataQtyOrdersByDay = $orderDAO->getQuantityOrdersByDay();
    $dataQuantityOrdersOfWeek = $orderDAO->getQuantityOrdersOfWeek();

//   Datos a json
    $jsonLabelsDays = json_encode($labels);

    $jsonDataEarnsDaily = json_encode($dataEarnsChart);
    $jsonDataQtyClientsDaily = json_encode($dataQtyClientsDaily);
    $jsonDataQtyOrdersByDay = json_encode($dataQtyOrdersByDay);
    $jsonDataQuantityOrdersOfWeek = json_encode($dataQuantityOrdersOfWeek);

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
  <title>Estadísticas</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
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
      <div class="row pe-0 mb-5">
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Ganancias Diarias
            </div>
            <div class="card-body">
              <canvas class="chart" width="1052" height="526"
                      style="display: block; box-sizing: border-box; height: 100%; width: 100%;"
                      id="weekly-earnings-chart"></canvas>
              <script type="text/javascript">
                  const chartWeekly = document.getElementById("weekly-earnings-chart");
                  const labelsWeekly = <?= $jsonLabelsDays ?>;
                  const dataWeeklyEarningsLine = {
                      type: 'line',
                      label: "Ganancias Diarias",
                      data: <?= $jsonDataEarnsDaily?>,
                      borderWidth: 1,
                      borderColor: '#80ed99',
                  };
                  const dataWeeklyEarningsBar = {
                      type: 'bar',
                      label: "Ganancias Diarias",
                      data: <?= $jsonDataEarnsDaily?>,
                      borderWidth: 1,
                      borderColor: '#80ed99',
                  };
                  new Chart(chartWeekly, {
                      data: {
                          labels: labelsWeekly,
                          datasets: [
                              dataWeeklyEarningsLine,
                              dataWeeklyEarningsBar,
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
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Cantidad de Clientes
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
                      borderColor: '#ef476f',
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
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Cantidad de Órdenes por Día
            </div>
            <div class="card-body">
              <canvas class="chart" width="1052" height="526"
                      style="display: block; box-sizing: border-box; height: 100%; width: 100%;"
                      id="orders-chart"></canvas>
              <script type="text/javascript">
                  const ordersChart = document.getElementById("orders-chart");
                  const dataOrders = {
                      label: "Cantidad de Órdenes por Día",
                      data: <?= $jsonDataQtyOrdersByDay?>,
                      borderWidth: 1,
                      borderColor: '#ff7d00',
                  };
                  new Chart(ordersChart, {
                      type: 'line',
                      data: {
                          labels: labelsWeekly,
                          datasets: [
                              dataOrders,
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
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Cantidad de Órdenes de esta semana
            </div>
            <div class="card-body" style="width: 50%; height: 50%">
              <canvas class="chart" width="1052" height="320"
                      style="display: block; box-sizing: border-box; height: 100%; width: 100%;"
                      id="orders-week-chart"></canvas>
              <script type="text/javascript">
                  const chartOrdersWeekly = document.getElementById("orders-week-chart");
                  const dataOrdersWeekly = {
                      label: "Cantidad de Órdenes por Semana",
                      data: <?= $jsonDataQuantityOrdersOfWeek?>,
                      borderWidth: 1,
                  };
                  new Chart(chartOrdersWeekly, {
                      type: 'pie',
                      data: {
                          labels: labelsWeekly,
                          datasets: [
                              dataOrdersWeekly,
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
    </div>
  </div>
</div>
</body>
</html>
