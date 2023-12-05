<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$_SESSION['txt-name'] = $_POST['txt-name'];
$_SESSION['txt-last-name'] = $_POST['txt-last-name'];
$_SESSION['txt-address'] = $_POST['txt-address'] ?? '';
$_SESSION['txt-phone'] = $_POST['txt-phone'];
$_SESSION['txt-district'] = $_POST['txt-district'] ?? '';
$_SESSION['txt-message'] = $_POST['txt-message'];
$_SESSION['check-delivery'] = $_GET['delivery'];
$_SESSION['check-payment'] = $_GET['typePayment'];

header('Location: send_payment_view.php');