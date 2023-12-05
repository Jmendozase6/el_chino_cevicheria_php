<?php

use data_transfer_objects\OrderDTO;
use data_transfer_objects\UserDTO;

ob_start();
error_reporting(E_ALL & ~E_DEPRECATED);

if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../../../vendor/autoload.php';
include_once __DIR__ . '/../../../datasource/constants.php';

require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/OrderDAO.php';
require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_access_objects/OrderProductDAO.php';
require_once '../../../services/phpmailer/EmailService.php';

require_once '../../../data_transfer_objects/OrderDTO.php';
require_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

$nameOrder = $_SESSION['txt-name'] ?? '';
$lastNameOrder = $_SESSION['txt-last-name'] ?? '';
$addressOrder = $_SESSION['txt-address'] ?? '';
$phoneOrder = $_SESSION['txt-phone'] ?? '';
$district = $_SESSION['txt-district'] ?? '';
$message = $_SESSION['txt-message'] ?? '';
$delivery = $_SESSION['check-delivery'] ?? '';
$payment = $_SESSION['check-payment'] ?? '';

$paymentId = $_GET['payment_id'] ?? '';
$paymentStatus = $_GET['status'] ?? '';
$paymentType = $_GET['payment_type'] ?? '';
$orderId = $_GET['merchant_order_id'] ?? '';

$orderProductDAO = new OrderProductDAO();
$cartDAO = new CartDAO();
$orderDAO = new OrderDAO();
$orderDTO = new OrderDTO();
$userDAO = new UserDAO();
$emailService = new EmailService();
$userDTO = UserDTO::createFromResponse($userDAO->getUserById($_SESSION['id']));

if ($delivery == 'delivery') {
    $total = $cartDAO->getTotalFromCart(session_id()) + 2;
} else {
    $total = $cartDAO->getTotalFromCart(session_id());
}
$orderDTO->setTotal($total);
$orderDTO->setUserId($_SESSION['id']);
$orderDTO->setOrderStatus(1);
$orderDTO->setPaymentId($paymentId);
$orderDTO->setNameOrder($nameOrder);
$orderDTO->setLastNameOrder($lastNameOrder);
$orderDTO->setAddressOrder($addressOrder);
$orderDTO->setPhoneOrder($phoneOrder);
$orderDTO->setDistrictOrder($district);
$orderDTO->setCommentsOrder($message);

if ($total != 0 || $paymentStatus == 'approved') {

    $lastId = $orderDAO->createOrder($orderDTO, $paymentStatus, $paymentType, $orderId);

    $responseProductsFromCart = $cartDAO->getProductsIdQtyFromCart();

    foreach ($responseProductsFromCart as $productFromCart) {
        $orderProductDAO->createOrderProduct($lastId, $productFromCart['id_product'], $productFromCart['quantity']);
    }

    $cartDAO->deleteCart(session_id());
    deleteSession();
    $emailService->sendOrderEmail($userDTO->getEmail(), 'Información de Compra', $lastId, $total);
    header('Location: success_payment_view.php');

} else {
    deleteSession();
    header('Location: ../error/error_view.php');
}

function deleteSession(): void
{
    unset($_SESSION['txt-name']);
    unset($_SESSION['txt-last-name']);
    unset($_SESSION['txt-address']);
    unset($_SESSION['txt-phone']);
    unset($_SESSION['txt-district']);
    unset($_SESSION['txt-message']);
    unset($_SESSION['check-delivery']);
    unset($_SESSION['check-payment']);
}