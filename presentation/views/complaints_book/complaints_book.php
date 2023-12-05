<?php

require_once '../../../services/phpmailer/EmailService.php';

if (!isset($_SESSION['errorMessageComplaintsBook'])) {
    $_SESSION['errorMessageComplaintsBook'] = null;
}
if (!isset($_SESSION['successMessageComplaintsBook'])) {
    $_SESSION['successMessageComplaintsBook'] = null;
}

if (isset($_POST['btn-send-book'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) || ctype_space($name) || ctype_space($email) || ctype_space($message)) {
        $_SESSION['errorMessageContactUs'] = "Por favor, complete todos los campos.";
        $_SESSION['successMessageContactUs'] = null;
    } else {
        $res = (new EmailService())->sendComplaintEmail($name, $email, $message);
        if ($res) {
            $_SESSION['successMessageComplaintsBook'] = "Su mensaje ha sido enviado con éxito.";
            $_SESSION['errorMessageComplaintsBook'] = null;
        } else {
            $_SESSION['errorMessageComplaintsBook'] = "Ha ocurrido un error al enviar su mensaje. Por favor, inténtelo de nuevo.";
            $_SESSION['successMessageComplaintsBook'] = null;
        }
    }
}