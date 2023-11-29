<?php
include '../../../data_access_objects/UserDAO.php';

require_once __DIR__ . '/../../../services/phpmailer/EmailService.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$GLOBALS['errorMessageContactUs'] = null;
$GLOBALS['successMessageContactUs'] = null;

if (isset($_POST['btn-contact-us'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $content = trim($_POST['content']);
    $userDAO = new UserDAO();

    if ($name == '' || $email == '' || $subject == '' || $content == '') {
        $errorMessageContactUs = "Por favor, complete todos los campos.";
    } else {
        try {
            $emailService = new EmailService();
            $emailResponse = $emailService->sendContactUsEmail($name, $email, $subject, $content);
            if ($emailResponse) {
                $successMessageContactUs = "Correo electrónico enviado correctamente.";
                header('Location: contact_us_view.php');
            } else {
                $errorMessageContactUs = "Error al enviar el correo electrónico.";
            }
        } catch (Exception $e) {
            $errorMessageContactUs = "Error de la base de datos.";
        }
    }
}
