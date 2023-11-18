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

session_start();
if ($_SESSION['id'] == null) {
    header('Location: ../sign_in/sign_in_view.php');
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
          <div class="col-8 d-flex flex-column">
            <div class="p-4 bg-white rounded-4 shadow-sm content-menu">
              <h2>Menú</h2>
              <div class="row">
                <div class="col">
                  <p>Selecciona tu comida favorita</p>
                </div>
                <div class="col-auto">
                  <a href="#">Editar</a>
                </div>
              </div>
              <div class="row row-cols-4 g-2">
                  <?php foreach ($categoriesDTO as $categoryDTO) { ?>
                    <div class="col">
                      <div class="card border-0">
                        <img src="<?= $categoryDTO->getImg() ?>" class="card-img-top rounded-2"
                             alt="Categoría" width="30">
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
          <div class="col-4 d-flex flex-column">
            <div class="bg-white p-4 rounded-4 shadow-sm content-menu2">
              <h2 class="most-sold pb-2">Más vendidos</h2>
              <div class="card border-0 img-card-most-sold ">
                <img src="<?= $mostSellProductDTO->getImage() ?>"
                     class="card-img-top rounded-2"
                     alt=" Producto más vendido ">
              </div>
              <p class="card-text text-center most-sold pt-3 pb-1 ">
                <strong><?= $mostSellProductDTO->getName() ?></strong></p>
              <div class="text-center">
                <span class="badge text-bg-light pb-2"><?= $responseMostSellProduct['total_quantity'] ?> ventas</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="side-menu bg-white vh-100">
      <div class="d-flex justify-content-center data-user">
        <strong style="font-size: 2rem; color: #56a2a2">Tus datos</strong>
      </div>
      <div class="d-flex justify-content-center pt-2 pb-3">
        <img src="../../resources/images/<?= $modelUser->getImg() ?>"
             class="card-img-top rounded-circle w-50 card-img-user"
             alt="Logo usuario">
      </div>

      <div class="d-flex flex-column user-data-form">
        <label for="name" class="form-label  pt-3"> Nombre</label>
        <input id="name" type="text" value="<?= $modelUser->getName() ?>" class="form-control"
               placeholder="Nombre" readonly>


        <label for="lastname" class="form-label pt-3"> Apellidos </label>
        <input id="lastname" type="text" value="<?= $modelUser->getLastName() ?>"
               class="form-control"
               placeholder="Apellidos" readonly>


        <label for="email" class="form-label  pt-3"> Correo</label>
        <input id="email" type="email" value="<?= $modelUser->getEmail() ?>" class="form-control"
               placeholder="Correo" readonly>

        <label for="role" class="form-label  pt-3"> Rol</label>
        <input id="role" type="text" value="<?= $modelUser->getRoleById() ?>" class="form-control"
               placeholder="Rol" readonly>
      </div>
    </div>
  </div>
</div>
</body>
</html>
