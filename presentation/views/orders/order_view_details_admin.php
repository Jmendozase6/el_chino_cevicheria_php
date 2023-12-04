<?php

use data_transfer_objects\OrderStatusDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_access_objects/OrderDAO.php';
require_once '../../../data_access_objects/CategoryDAO.php';
require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/OrderStatusDAO.php';

require_once '../../../data_transfer_objects/OrderProductDTO.php';
require_once '../../../data_transfer_objects/OrderStatusDTO.php';
require_once '../../../data_transfer_objects/OrderDTO.php';
require_once '../../../data_transfer_objects/OrderStatusDTO.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['id'] == null) {
    header('Location: ../sign_in/sign_in_view.php');
} elseif ($_SESSION['id_role'] != 1) {
    header('Location: ../initial_client/initial_client_view.php');
} else {

    $orderProductDAO = new OrderProductDAO();
    $orderDAO = new OrderDAO();

    $orderId = $_POST['order_id'] ? intval($_POST['order_id']) : 0;
    $order = $orderDAO->getOrderById($orderId);
    $isAuthenticated = isset($_SESSION["id"]);

    if ($isAuthenticated) {
        $orders = $orderProductDAO->getOrdersProductsByOrderId($orderId);
    }

    $orderStatusDAO = new OrderStatusDAO();
    $orderStatusResponse = $orderStatusDAO->getOrderStatus();
    $orderStatusDTO = [];
    for ($i = 0; $i < count($orderStatusResponse); $i++) {
        $orderStatusDTO[$i] = OrderStatusDTO::createFromResponse($orderStatusResponse[$i]);
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
  <title>Detalles del Pedido</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid p-4">
  <div class="row">
    <div class="col-md-12 mb-3">
      <div class="card">
        <div class="card-header bg-white">
          <div class="row">
            <div class="col-md-6">
              <h5 class="card-title">Detalles del Pedido</h5>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <a href="../orders/order_view.php" class="btn btn-outline-secondary">Regresar</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-6">
              <h6 class="card-subtitle mb-4 text-muted">Datos del Cliente</h6>
              <input type="hidden" id="orderIdInput" value="<?= $order['id'] ?>">
              <p class="card-text">
                <strong>Nombre: </strong> <?= $order['name_order'] ?><br><br>
                <strong>Apellidos: </strong> <?= $order['last_name_order'] ?><br><br>
                <strong>Dirección: </strong> <?= $order['address_order'] ?><br><br>
                <strong>Teléfono: </strong> <?= $order['phone_order'] ?><br><br>
                <strong>Comentarios: </strong> <?= $order['comments_order'] ?><br><br>
              </p>
            </div>
            <div class="col-md-6">
              <h6 class="card-subtitle mb-4 text-muted">Datos del Pedido</h6>
              <div class="card-text">
                <strong>Fecha:</strong> <?= $order['created_at'] ?> <br><br>
                <strong>Estado:</strong> <?= (new OrderStatusDTO)::getStatusByCode($order['order_status']) ?> <br><br>
                <strong>Total:</strong> S/.<?= $order['total'] ?> <br><br>
                <select class="form-select" aria-label="Estado de la Órden" id="orderStatusSelect">
                    <?php foreach ($orderStatusDTO as $orderStatus) { ?>
                      <option value="<?= $orderStatus->getId() ?>"><?= $orderStatus->getStatus() ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h6 class="card-subtitle mb-2 text-muted">Productos</h6>
              <table class="table table-hover">
                <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">SubTotal</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order) { ?>
                  <tr>
                    <td><?= $order['name'] ?></td>
                    <td><?= $order['description'] ?></td>
                    <td><img src="<?= $order['image'] ?>" alt="product-image" width="100"></td>
                    <td>S/.<?= $order['price'] ?></td>
                    <td><?= $order['quantity'] ?></td>
                    <td>S/.<?= $order['subtotal'] ?></td>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../../resources/script/updateOrderStatus.js"></script>
</body>
</html>
