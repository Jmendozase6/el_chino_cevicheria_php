<?php
require_once '../../../data_access_objects/UserDAO.php';

$GLOBALS['successMessageProfile'] = null;
$GLOBALS['errorMessageProfile'] = null;

if (isset($_POST['btn-update-profile'])) {

    if (!isset($_SESSION)) {
        session_start();
    }

    $id = $_SESSION["id"];

    $name = trim($_POST['name']);
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $userDAO = new UserDAO();

    $user = $userDAO->updateProfile($id, $name, $lastName, $address, $phone, $email);

    if ($user != null) {
        $successMessageProfile = "Se actualizaron los datos";
        echo $successMessageProfile;
    } else {
        $errorMessageProfile = "Ocurrió un error al actualizar";
        echo $errorMessageProfile;
    }
}