<?php

use data_transfer_objects\OrderDTO;

require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../data_transfer_objects/OrderProductDTO.php';
require_once '../../../data_transfer_objects/OrderStatusDTO.php';
require_once '../../../data_transfer_objects/OrderDTO.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$orderProductDAO = new OrderProductDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dateFromValue = $_POST["date-from"];
    $dateToValue = $_POST["date-to"];
    $responseOrders = $orderProductDAO->getOrdersByDate($dateFromValue, $dateToValue);

    $ordersFilterDTO = [];

    foreach ($responseOrders as $responseOrder) {
        $ordersFilterDTO[] = OrderDTO::createFromResponse($responseOrder);
    }
    $serializedOrders = serialize($ordersFilterDTO);
    $_SESSION['ordersFilterDTO'] = $serializedOrders;

    header('Location: order_view.php');
}