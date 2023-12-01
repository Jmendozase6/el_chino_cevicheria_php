<?php

include_once '../landing/base_landing_view.php';
require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../data_transfer_objects/OrderDTO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION)) {
        session_start();
    }
    $orderProductDAO = new OrderProductDAO();

    $orderId = $_POST['order_id'] ? intval($_POST['order_id']) : 0;
    $isAuthenticated = isset($_SESSION["id"]);

    if ($isAuthenticated) {
        $orders = $orderProductDAO->getOrdersProductsByOrderId($orderId);
    }

    function displayOrderProducts(): string
    {
        global $orders;
        $content = '';
        foreach ($orders as $order) {
            $content .= '
            <tr>
              <th scope="row" class="align-middle">' . $order["name"] . '</th>
              <td class="align-middle">' . $order["description"] . '</td>
              <td class="align-middle"><img src="' . $order["image"] . '" alt="Imagen de Producto" class="rounded-4 object-fit-cover" style="height: 7rem; width: 10rem;"></td>
              <td class="align-middle">S./ ' . $order["price"] . '</td>
              <td class="align-middle">' . $order["quantity"] . '</td>
              <td class="align-middle">' . $order["subtotal"] . '</td>
            </tr>';
        }
        return $content;
    }

    $content = $isAuthenticated ? '
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="text-center fw-bold mb-3">Mis Pedidos</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <table class="table table-hover">
              <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Imagen</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Subtotal</th>
              </tr>
              </thead>
              <tbody> ' . displayOrderProducts() . '
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
                <h2 class="text-center text-black py-3 fw-bold" > Por favor, inicia sesión para acceder a tu perfil .</h2 >
                <a href = "../sign_in/sign_in_view.php" class="btn btn-primary btn-submit m-3 w-25" > iniciar sesión </a >
            </div >
        </div >
    </div > ';
    displayBaseWeb($content);
}


