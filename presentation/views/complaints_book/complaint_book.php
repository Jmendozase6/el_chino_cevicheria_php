<?php

require_once '../../../services/phpmailer/EmailService.php';

if (isset($_POST)) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    (new EmailService())->sendComplaintEmail($name, $email, $message);

}
header('Location: ../initial_client/initial_client_view.php');