<?php

use data_transfer_objects\UserDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../services/phpmailer/EmailService.php';

$GLOBALS['nonExistentEmailMessage'] = null;

if (isset($_POST['btn-recover-password'])) {

//    Guardamos el email
    $email = trim($_POST['recover-email']);

//    Instanciamos los objetos
    $userDTO = new UserDTO();
    $userDAO = new UserDAO();
    $emailService = new EmailService();
    $randomCode = rand(100000, 999999);

//    Validar que el correo exista en nuestra base de usuarios
    try {
        $existsEmail = $userDAO->existsEmail($email);
        if ($existsEmail) {
            $emailService->sendEmail($email, 'Recuperación de Contraseña', EmailType::RecoverPassword, $randomCode);
            header('Location:../recover_password/recover_code_view.php');
            isSessionStarted();
            $_SESSION['recover-email'] = $email;
            $_SESSION['recover-code-email'] = $randomCode;
        } else {
            $nonExistentEmailMessage = "El correo electrónico no existe.";
        }
    } catch (Exception $e) {
        $nonExistentEmailMessage = "Error al enviar el correo electrónico.";
        header('Location:javascript://history.go(-1)');
    }
}
function isSessionStarted(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}