<?php
require_once '../../../data_access_objects/UserDAO.php';

if (!isset($_SESSION)) {
    session_start();
}

$id = $_SESSION["id"];

$name = trim($_POST['name']);
$lastName = trim($_POST['last-name']);
$address = trim($_POST['address']);
$phone = trim($_POST['phone']);
$userDAO = new UserDAO();

if (!(empty($name) || empty($address) || empty($phone) || ctype_space($name) || ctype_space($address) || ctype_space($phone))) {
    $user = $userDAO->updateProfile($id, $name, $lastName, $address, $phone);
}
header('Location: ../profile_admin/profile_admin_view.php');
