<?php
require_once '../../../data_access_objects/OrderDAO.php';

$orderDAO = new OrderDAO();
$orderId = $_POST['orderId'];
$selectedOrderStatus = $_POST['selectedOrderStatus'];
$res = $orderDAO->updateOrderStatus($orderId, $selectedOrderStatus);
print_r($res);