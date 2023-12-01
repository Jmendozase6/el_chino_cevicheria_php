<?php
include '../../../data_access_objects/UserDAO.php';
require_once '../../../services/phpmailer/EmailService.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$GLOBALS['errorMessageSignUp'] = null;
$emailService = new EmailService();

if (isset($_SESSION["id"])) {
    header('Location: ../home/home_view.php');
    exit();
}


if (isset($_POST['btn-sign-up'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $name = trim($_POST['name']);
    $lastName = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $userDAO = new UserDAO();

//    if (strlen($password) < 6 || strlen($email) == 0 || strlen($name) == 0 || strlen($phone) == 0 || strlen($address) == 0 || strlen($lastName) == 0) {
    if (empty($password) || empty($email) || empty($name) || empty($phone) || empty($address) || empty($lastName) || ctype_space($password) || ctype_space($email) || ctype_space($name) || ctype_space($phone) || ctype_space($address) || ctype_space($lastName)) {
        $errorMessageSignUp = "Por favor, ingrese todos los campos.";
    } else {
        try {
            $signUpResponse = $userDAO->signUp($email, $password, $name, $phone, 2, $address, $lastName);
            if ($signUpResponse) {
                $errorMessageSignUp = null;
                $currentUser = $userDAO->signIn($email, $password);
                if (isset($currentUser['id'])) {
                    $rolId = $currentUser['id_role'];
                    $_SESSION["id"] = $currentUser['id'];
                    $_SESSION["id_role"] = $currentUser['id_role'];
                    $errorMessageSignUp = null;
                    if ($rolId == 2) {
                        $emailService->sendSignUpEmail($email);
//          Si es cliente, se manda al catálogo de productos
                        header('Location: ../initial_client/initial_client_view.php');
                        exit();
                    }
                } else {
                    $errorMessageSignUp = "Error al iniciar sesión.";
                }
            } else {
                $errorMessageSignUp = "Error al registrarse.";
            }
        } catch (Exception $e) {
            $errorMessageSignUp = 'Estamos teniendo problemas.';
        }
    }


}

