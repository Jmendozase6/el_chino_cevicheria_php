<?php

require_once '../../../services/phpmailer/EmailService.php';

if (isset($_POST)) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL) || ctype_space($name) || ctype_space($email) || ctype_space($message)) {
        header('Location: ../initial_client/initial_client_view.php');
    } else {
        (new EmailService())->sendComplaintEmail($name, $email, $message);
    }
}
header('Location: ../initial_client/initial_client_view.php');