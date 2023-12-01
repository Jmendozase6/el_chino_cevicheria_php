<?php

use data_transfer_objects\OrderDTO;
use data_transfer_objects\OrderStatusDTO;
use data_transfer_objects\UserDTO;

include_once '../landing/base_landing_view.php';
require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/OrderDAO.php';
require_once '../../../data_access_objects/UserDAO.php';

require_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../data_transfer_objects/OrderDTO.php';
require_once '../../../data_transfer_objects/OrderStatusDTO.php';

if (!isset($_SESSION)) {
    session_start();
}

$isAuthenticated = isset($_SESSION["id"]);
$userDAO = new UserDAO();
$orderDAO = new OrderDAO();


if ($isAuthenticated) {
    $currentUser = $userDAO->getUserById($_SESSION["id"]);
    $currentUserDTO = UserDTO::createFromResponse($currentUser);
    $orders = $orderDAO->getOrdersByUserId($_SESSION["id"]);
    $ordersDTO = [];
    foreach ($orders as $order) {
        $ordersDTO[] = OrderDTO::createFromResponse($order);
    }
}

function displayMyOrders(): string
{
    global $ordersDTO;
    $content = '';
    foreach ($ordersDTO as $orderDTO) {
        $content .= '
            <tr>
              <th scope="row">' . $orderDTO->getId() . '</th>
              <td>' . $orderDTO->getPaymentId() . '</td>
              <td>S/.' . $orderDTO->getTotal() . '</td>
              <td>' . $orderDTO->getCreatedAt() . '</td>
              <td>' . (new OrderStatusDTO)::getStatusByCode($orderDTO->getOrderStatus()) . '</td>
              <td>
                  <form action="orders_client_details_view.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="order_id" id="order_id" value="' . $orderDTO->getId() . '">
                    <input type="submit" class="btn btn-primary" value="Ver">
                  </form>
              </td>
            </tr>';
    }
    return $content;
}

$content = $isAuthenticated ? '
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center">Mis Pedidos</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">ID de Pago</th>
            <th scope="col">Total</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
          </tr>
          </thead>
          <tbody> ' . displayMyOrders() . '
          </tbody>
        </table>
      </div>
    </div>'
    : '<div class="container wrapper-error">
    <div class="row" >
        <div class="col-12 container-img-error-p" >
            <img  class="container-img-error" src = "../../resources/images/face.png" alt = "Persona pensando" >
        </div >
        <div class="col d-flex flex-column justify-content-center align-items-center" >
            <h2 class="text-center text-black py-3 fw-bold" > Por favor, inicia sesión para acceder a tu lista de pedidos .</h2 >
            <a href = "../sign_in/sign_in_view.php" class="btn btn-primary btn-submit m-3 w-25" > iniciar sesión </a >
        </div >
    </div >
</div > ';
displayBaseWeb($content);
