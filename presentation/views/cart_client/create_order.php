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

// Data Client
$nameOrder = $_GET['txt-name'];
$lastNameOrder = $_GET['txt-last-name'];
$addressOrder = $_GET['txt-address'];
$phoneOrder = $_GET['txt-phone'];
$district = $_GET['district'];

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
$orderDTO->setOrderStatus(1);
$orderDTO->setPaymentId($paymentId);
$orderDTO->setNameOrder($nameOrder);
$orderDTO->setLastNameOrder($lastNameOrder);
$orderDTO->setAddressOrder($addressOrder);
$orderDTO->setPhoneOrder($phoneOrder);
$orderDTO->setDistrictOrder($district);

$lastId = $orderDAO->createOrder($orderDTO);

$responseProductsFromCart = $cartDAO->getProductsIdQtyFromCart();

foreach ($responseProductsFromCart as $productFromCart) {
    $orderProductDAO->createOrderProduct($lastId, $productFromCart['id_product'], $productFromCart['quantity']);
}

$cartDAO->deleteCart(session_id());

header('Location: success_payment_view.php');