<?php
require_once '../../../data_access_objects/UserDAO.php';

if (!isset($_SESSION)) {
    session_start();
}

$GLOBALS['successMessageProfile'] = null;
$GLOBALS['errorMessageProfile'] = null;

if (isset($_POST['btn-save-profile'])) {

    $id = $_SESSION["id"];

    $name = trim($_POST['name']);
    $lastName = trim($_POST['last-name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $userDAO = new UserDAO();

    if (empty($name) || empty($address) || empty($phone) || ctype_space($name) || ctype_space($address) || ctype_space($phone)) {
        $errorMessageProfile = "Por favor, ingrese todos los datos";
    } else {

        $user = $userDAO->updateProfile($id, $name, $lastName, $address, $phone);

        if ($user != null) {
            $successMessageProfile = "Se actualizaron los datos";
        } else {
            $errorMessageProfile = "Ocurrió un error al actualizar";
        }
    }

}