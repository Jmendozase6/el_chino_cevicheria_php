<?php

use data_transfer_objects\UserDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../services/phpmailer/EmailService.php';

if ($_POST) {

//    Guardamos el email
    $email = trim($_POST['recover-email']);

//    Instanciamos los objetos
    $userDTO = new UserDTO();
    $userDAO = new UserDAO();
    $emailService = new EmailService();
    $randomNumber = rand(100000, 999999);

//    Validar que el correo exista en nuestra base de usuarios
    try {
        $existsEmail = $userDAO->existsEmail($email);
        if ($existsEmail) {
            $responseEmail = $emailService->sendEmail('jhairmendoza2003@gmail.com', 'Recuperación de Contraseña', EmailType::RecoverPassword, $randomNumber);
        }
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico.";
    }
}