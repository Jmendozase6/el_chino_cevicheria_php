<?php

include '../../../data_access_objects/UserDAO.php';

session_start();
$userDAO = new UserDAO();
$email = "";
$password = "";
$GLOBALS['errorMessage'] = null;

if (isset($_POST['btn-sign-in'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($_POST['password'])) {
        $GLOBALS['errorMessage'] = "Por favor ingrese su correo y contraseña.";
    }

    try {
        $currentUser = $userDAO->signIn($email, $password);
        if (isset($currentUser['id'])) {
            $_SESSION["id"] = $currentUser['id'];
            header('Location: ../home/home_view.php');
            exit();
        } else {
            $errorMessage = "Credenciales Incorrectas";
        }
    } catch (Exception $e) {
        $errorMessage = "Error de la base de datos.";
    }
}
