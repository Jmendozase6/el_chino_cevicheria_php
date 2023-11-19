<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//require '../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

enum EmailType: string
{
    case RecoverPassword = 'RecoverPassword';
    case OrderConfirmation = 'OrderConfirmation';
    case SignUp = 'SignUp';
}

class EmailService
{

    public function sendEmail($email, $subject, EmailType $emailType, $randomNumber = 0): bool
    {
        try {
            $mail = new PHPMailer(true);
            $mail->setLanguage('es', '/optional/path/to/language/directory/');
            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
            $mail->isSMTP();                                        //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                         //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                 //Enable SMTP authentication
            $mail->Username = 'jhairm064@gmail.com';                //SMTP username
            $mail->Password = 'xcqq tvzw lkfy ddoy';                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
            $mail->Port = 465;                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('support@codecrafters.dev', 'Soporte de El Chino Cevichería');
            $mail->addAddress($email, 'Cliente de El Chino Cevichería');     //Add a recipient
            $mail->addReplyTo('noreply@example.com', 'NoReply');

            //Content
            $mail->isHTML();                                  //Set email format to HTML
            $mail->Subject = $subject;
            //    Add email-template-php in the body
//            $mail->Body = file_get_contents('email-template.php');

            switch ($emailType) {
                case EmailType::RecoverPassword:
                    $mail->Body =
                        '<h1> Recuperación de contraseña </h1>
                         <p> Hola <br>
                         Tu código de recuperación es: ' . $randomNumber .
                        '<strong><?= $code ?></strong></p>
                    <p> Si no has solicitado un cambio de contraseña, ignora este mensaje.</p >';
                    $mail->AltBody = 'Correo electrónico de recuperación de contraseña';
                    break;

                case EmailType::OrderConfirmation:
                    $mail->Body =
                        '<h1> Bienvenido a El Chino Cevichería </h1>
                 <p> Hola <?= $name ?>, <br>
                 Su pedido se ha realizado correctamente</p>';
                    $mail->AltBody = 'Correo electrónico de confirmación de pedido';
                    break;

                case EmailType::SignUp:
                    $mail->Body =
                        '<h1> Bienvenido a El Chino Cevichería </h1>
                 <p> Hola <?= $name ?>, <br>
                 tu cuenta ha sido creada exitosamente.</p>';
                    $mail->AltBody = 'Correo electrónico de confirmación de registro';
                    break;
            }

            return $mail->send();
        } catch
        (Exception $e) {
            return false;
        }
    }

}