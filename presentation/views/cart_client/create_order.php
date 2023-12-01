<?php

use data_transfer_objects\OrderDTO;

if (!isset($_SESSION)) {
    session_start();
}
require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/OrderDAO.php';
require_once '../../../data_access_objects/OrderProductDAO.php';

require_once '../../../data_transfer_objects/OrderDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';


$paymentId = $_GET['payment_id'];
$paymentStatus = $_GET['status'];
$paymentType = $_GET['payment_type'];
$orderId = $_GET['merchant_order_id'];

$cartDAO = new CartDAO();
$orderProductDAO = new OrderProductDAO();
$orderDAO = new OrderDAO();
$orderDTO = new OrderDTO();

$orderDTO->setTotal($cartDAO->getTotalFromCart(session_id()));
$orderDTO->setUserId($_SESSION['id']);
// 1 = En revisión
$orderDTO->setOrderStatus(1);
$orderDTO->setPaymentId($paymentId);
$lastId = $orderDAO->createOrder($orderDTO);

$responseProductsFromCart = $cartDAO->getProductsIdQtyFromCart();

foreach ($responseProductsFromCart as $productFromCart) {
    $orderProductDAO->createOrderProduct($lastId, $productFromCart['id_product'], $productFromCart['quantity']);
}

$cartDAO->deleteCart(session_id());

header('Location: success_payment_view.php');