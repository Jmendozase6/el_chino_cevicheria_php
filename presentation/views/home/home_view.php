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
        <div class="container-fluid container-fluid-content">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body py-5">Primary Card</div>
                        <div class="card-footer d-flex">
                            View Details
                            <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark h-100">
                        <div class="card-body py-5">Warning Card</div>
                        <div class="card-footer d-flex">
                            View Details
                            <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body py-5">Success Card</div>
                        <div class="card-footer d-flex">
                            View Details
                            <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body py-5">Danger Card</div>
                        <div class="card-footer d-flex">
                            View Details
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
                                      <img src="
<?= $categoryDTO->getImg() ?>" class="card-img-top rounded-2"
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
                            Area Chart Example
                        </div>
                        <div class="card-body">
                            <canvas class="chart" width="1052" height="526"
                                    style="display: block; box-sizing: border-box; height: 100%; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3 pe-0">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                            Area Chart Example
                        </div>
                        <div class="card-body">
                            <canvas class="chart" width="1052" height="526"
                                    style="display: block; box-sizing: border-box; height: 100%; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pe-0">
                <div class="col-md-12 mb-3 pe-0">
                    <div class="card mb-5">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Data Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-xl">
                                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example" class="table table-striped data-table dataTable"
                                                   style="width: 100%;" role="grid" aria-describedby="example_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 224px;">Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 332px;">Position
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 167px;">Office
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1" aria-label="Age: activate to sort column ascending"
                                                        style="width: 55px;">Age
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Start date: activate to sort column ascending"
                                                        style="width: 137px;">Start date
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 135px;">Salary
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                <tr class="odd">
                                                    <td class="sorting_1">Airi Satou</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>33</td>
                                                    <td>2008/11/28</td>
                                                    <td>$162,700</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1">Angelica Ramos</td>
                                                    <td>Chief Executive Officer (CEO)</td>
                                                    <td>London</td>
                                                    <td>47</td>
                                                    <td>2009/10/09</td>
                                                    <td>$1,200,000</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1">Ashton Cox</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>San Francisco</td>
                                                    <td>66</td>
                                                    <td>2009/01/12</td>
                                                    <td>$86,000</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1">Bradley Greer</td>
                                                    <td>Software Engineer</td>
                                                    <td>London</td>
                                                    <td>41</td>
                                                    <td>2012/10/13</td>
                                                    <td>$132,000</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1">Brenden Wagner</td>
                                                    <td>Software Engineer</td>
                                                    <td>San Francisco</td>
                                                    <td>28</td>
                                                    <td>2011/06/07</td>
                                                    <td>$206,850</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1">Brielle Williamson</td>
                                                    <td>Integration Specialist</td>
                                                    <td>New York</td>
                                                    <td>61</td>
                                                    <td>2012/12/02</td>
                                                    <td>$372,000</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1">Bruno Nash</td>
                                                    <td>Software Engineer</td>
                                                    <td>London</td>
                                                    <td>38</td>
                                                    <td>2011/05/03</td>
                                                    <td>$163,500</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1">Caesar Vance</td>
                                                    <td>Pre-Sales Support</td>
                                                    <td>New York</td>
                                                    <td>21</td>
                                                    <td>2011/12/12</td>
                                                    <td>$106,450</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1">Cara Stevens</td>
                                                    <td>Sales Assistant</td>
                                                    <td>New York</td>
                                                    <td>46</td>
                                                    <td>2011/12/06</td>
                                                    <td>$145,600</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1">Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>Edinburgh</td>
                                                    <td>22</td>
                                                    <td>2012/03/29</td>
                                                    <td>$433,060</td>
                                                </tr>
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
</body>
</html>
