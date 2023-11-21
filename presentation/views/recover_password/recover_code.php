<?php

$recoverCodeInput = "";
$recoverCodeEmail = "";
$GLOBALS['errorCode'] = null;

if (isset($_POST['btn-verify'])) {

    session_start();
    $recoverCodeInput = $_POST['recover-code'];
    $recoverCodeEmail = $_SESSION['recover-code-email'];

// Coinciden ambos códigos?
    if ($recoverCodeInput == $recoverCodeEmail) {
        // No hay error, redirigir a la siguiente vista
        header('Location:recover_password_view.php');
        exit();
    } else {
        // Establecer el mensaje de error
        $errorCode = "El código ingresado es incorrecto.";
    }
}
