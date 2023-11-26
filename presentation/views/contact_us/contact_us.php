<?php
include '../../../data_access_objects/UserDAO.php';

require_once __DIR__ . '/../../../services/phpmailer/EmailService.php';

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$GLOBALS['errorMessageContactUs'] = null;

if (isset($_POST['btn-contact-us'])) {

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $subject = trim($_POST['subject']);
  $content = trim($_POST['content']);
  $userDAO = new UserDAO();

  if (empty($name) || empty($email) || empty($subject) || empty($content)) {
    $errorMessage = "Por favor, llene todos los campos.";
  } else {
    try {
      $emailService = new EmailService();
      $emailResponse = $currentUser = $emailService->sendContactUsEmail($name, $email, $subject, $content);
      if ($emailResponse) {
        header('Location: contact_us_view.php');
      } else {
        $errorMessageContactUs = "Error al enviar el correo electrónico.";
      }
    } catch (Exception $e) {
      $errorMessageContactUs = "Error de la base de datos.";
    }
  }
}
