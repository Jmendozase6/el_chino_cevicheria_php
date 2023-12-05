<?php
include '../../../data_access_objects/UserDAO.php';

require_once '../../../services/phpmailer/EmailService.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['errorMessageContactUs'])) {
    $_SESSION['errorMessageContactUs'] = null;
}
if (!isset($_SESSION['successMessageContactUs'])) {
    $_SESSION['successMessageContactUs'] = null;
}


if (isset($_POST['btn-contact-us'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $content = trim($_POST['content']);
    $userDAO = new UserDAO();

    if ($name == '' || $email == '' || $subject == '' || $content == '') {
        $_SESSION['errorMessageContactUs'] = "Por favor, complete todos los campos.";
        $_SESSION['successMessageContactUs'] = null;
    } else {
        try {
            $emailService = new EmailService();
            $emailResponse = $emailService->sendContactUsEmail($name, $email, $subject, $content);
            if ($emailResponse) {
                $_SESSION['successMessageContactUs'] = "Correo electrónico enviado correctamente.";
                $_SESSION['errorMessageContactUs'] = null;
                header('Location: contact_us_view.php');
            } else {
                $_SESSION['errorMessageContactUs'] = "Error al enviar el correo electrónico.";
                $_SESSION['successMessageContactUs'] = null;
            }
        } catch (Exception $e) {
            $_SESSION['successMessageContactUs'] = null;
            $_SESSION['errorMessageContactUs'] = "Error de la base de datos.";
        }
    }
}
