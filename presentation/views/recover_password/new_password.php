<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once '../../../data_access_objects/UserDAO.php';
$GLOBALS['noMatchPasswords'] = null;

if (isset($_POST['btn-update-password'])) {

  $password1 = $_POST['recover-password-1'];
  $password2 = $_POST['recover-password-2'];

  if ($password1 == $password2) {
    try {
      $userDAO = new UserDAO();
      $email = $_SESSION['recover-email'];
      $userDAO->setNewPassword($email, $_POST['recover-password-1']);
      header('Location:../sign_in/sign_in_view.php');
    } catch (Exception $e) {
      $noMatchPasswords = "Ocurrió un error al actualizar la contraseña.";
    }
  } else {
    $GLOBALS['noMatchPasswords'] = "Las contraseñas no coinciden.";
  }
}