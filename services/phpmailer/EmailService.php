<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once __DIR__ . '/../../datasource/constants.php';

class EmailService
{

    public function getMailConfigBase(): PHPMailer
    {
        $mail = new PHPMailer(true);
        try {

            $mail->setLanguage('es', '/optional/path/to/language/directory/');
            $mail->CharSet = 'UTF-8';

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                  //Enable verbose debug output
            $mail->isSMTP();                                        //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                         //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                 //Enable SMTP authentication
            $mail->Username = 'jhairm064@gmail.com';                //SMTP username
            $mail->Password = EMAIL_CRED;                //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
            $mail->Port = 465;

            $mail->setFrom('jhairm064@gmail.com', 'El Chino Cevichería');
            $mail->addReplyTo('noreply@example.com', 'NoReply');
            $mail->isHTML();
            return $mail;
        } catch (Exception $e) {
            return $mail;
        }
    }

    public function sendRecoverPasswordEmail($email, $subject, $randomNumber = 0): bool
    {
        try {
            $mail = $this->getMailConfigBase();

            //Recipients
            $mail->addAddress($email, 'El Chino Cevichería');

            //Content
            $mail->Subject = $subject;
            $mail->Body =
                '<h1> Recuperación de contraseña </h1>
                <p> Hola <br>
                Tu código de recuperación es: 
                <strong>' . $randomNumber . '</strong></p>
                <p> Si no has solicitado un cambio de contraseña, ignora este mensaje.</p >';
            $mail->AltBody = 'Correo electrónico de recuperación de contraseña';
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendContactUsEmail($name, $emailFrom, $subject, $content): bool
    {
        try {
            $mail = $this->getMailConfigBase();

            //Recipients
            $mail->addAddress('jhairm064@gmail.com', 'El Chino Cevichería');

            //Content
            $mail->Subject = $subject;
            $mail->Body =
                '<h1> Contacto </h1>
                <p> Hola <br>
                El usuario <strong>' . $name . '</strong> con correo electrónico <strong>' . $emailFrom . '</strong> </p>
                <p> Ha enviado el siguiente mensaje: </p>
                <p> <strong>' . $content . '</strong></p>';
            $mail->AltBody = 'Correo electrónico de contacto';
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendOrderEmail($email, $subject, $order): bool
    {
        try {
            $mail = $this->getMailConfigBase();

            //Recipients
            $mail->addAddress($email, 'El Chino Cevichería');

            //Content
            $mail->Subject = $subject;
            $mail->Body =
                '<h1> Orden de compra </h1>
                <p> Hola, acabas de realizar una compra en nuestro sitio web. <br>
                Tu orden entrará en proceso de envío una vez que se confirme el pago. <br> 
                <strong>' . $order . '</strong></p>
                <p> Si no has solicitado una orden de compra, ignora este mensaje.</p >';
            $mail->AltBody = 'Correo electrónico de orden de compra';
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendSignUpEmail($email): bool
    {
        try {
            $mail = $this->getMailConfigBase();

            //Recipients
            $mail->addAddress($email, 'El Chino Cevichería');

            //Content
            $mail->Subject = "Bienvenido a El Chino Cevichería";
            $mail->Body =
                '<h1> Registro </h1>
                <p> Hola, gracias por registrarte en nuestro sitio web. <br>
                <p> Si no te has registrado, ignora este mensaje.</p >';
            $mail->AltBody = 'Correo electrónico de registro';
            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}