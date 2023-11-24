<?php
include '../../../data_access_objects/UserDAO.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$GLOBALS['errorMessage'] = null;
$GLOBALS['errorMessageModal'] = null;

if (isset($_SESSION["id"])) {
    header('Location: ../home/home_view.php');
    exit();
}

$from = isset($_POST['btn-sign-in-modal']) ? 'modal' : 'view';

if (isset($_POST['btn-sign-in']) || isset($_POST['btn-sign-in-modal'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $userDAO = new UserDAO();

    if (empty($_POST['password'])) {
        setDependsOnView($from, "Por favor ingrese su correo y contraseña.");
    }

    try {
        $currentUser = $userDAO->signIn($email, $password);

        if (isset($currentUser['id'])) {
            $rolId = $currentUser['id_role'];
            $_SESSION["id"] = $currentUser['id'];
            $_SESSION["id_role"] = $currentUser['id_role'];
            $errorMessage = null;

//          Si el login viene desde el modal, se queda en la página actual
            if ($from == 'modal') {
                header("Location: ../cart_client/cart_client_view.php");
                exit();
            }

//          Si es administrador, se manda al dashboard
            if ($rolId == 1) {
                header('Location: ../home/home_view.php');
                exit();
            } else if ($rolId == 2) {
//          Si es cliente, se manda al catálogo de productos
                header('Location: ../catalog_client/catalog_client_view.php');
                exit();
            }
        } else {
            setDependsOnView($from, "Credenciales Incorrectas");
        }
    } catch (Exception $e) {
        setDependsOnView($from, "Error de la base de datos.");
    }
}

function setDependsOnView($from, $message): void
{
    global $errorMessage, $errorMessageModal;
    if ($from == 'modal') {
        $errorMessageModal = $message;
    } else {
        $errorMessage = $message;
    }
}