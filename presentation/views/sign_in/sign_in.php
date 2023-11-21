<?php

include '../../../data_access_objects/UserDAO.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userDAO = new UserDAO();
$GLOBALS['errorMessage'] = null;

if (isset($_SESSION["id"])) {
    header('Location: ../home/home_view.php');
    exit();
}

if (isset($_POST['btn-sign-in'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($_POST['password'])) {
        $errorMessage = "Por favor ingrese su correo y contraseña.";
    }

    try {
        $currentUser = $userDAO->signIn($email, $password);
        $rolId = $currentUser['id_role'];
        if (isset($currentUser['id'])) {

            $_SESSION["id"] = $currentUser['id'];

//                Si es administrador, se manda al dashboard
            if ($rolId == 1) {
                header('Location: ../home/home_view.php');
                exit();
            } else if ($rolId == 2) {
//            Si es cliente, se manda al catálogo de productos
                header('Location: ../catalog_client/catalog_client_view.php');
                exit();
            }
        } else {
            $errorMessage = "Credenciales Incorrectas";
        }
    } catch (Exception $e) {
        $errorMessage = "Error de la base de datos.";
    }
}
