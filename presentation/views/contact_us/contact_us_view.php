<?php
include '../landing/base_landing_view.php';
require('contact_us.php');
$content = '
<div class="container-fluid wrapper-contact-us">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3 d-flex justify-content-center background-contact p-4">
            <div class="d-flex align-items-center flex-column content-contact">
                <img src="../../resources/icons/map_pin_02.svg" alt="Icono ubicación">
                <p class="text-content text-center">Calle 2 de Febrero #140, Tamarindo - Querecotillo</p>
            </div>
            <div class="d-flex align-items-center flex-column content-contact content-contact-border">
                <img src="../../resources/icons/email.svg" alt="Icono Email">
                <p class="text-content text-center">Proxy@gmail.com </p>
            </div>
            <div class="d-flex align-items-center flex-column content-contact">
                <img src="../../resources/icons/phonecall.svg" alt="Icono Telefono">
                <p class="text-content text-center">+51 957881758</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-9 d-flex flex-column justify-content-center align-items-center p-0 col-contact">
        <di class="p-4 container-contact">
            <div class="align-content">
                <h1 class="contact-text">Contáctanos!</h1>
                <p class="pb-4 description-contact">Si tienes alguna pregunta o consulta, no dudes en enviarnos un mensaje a través del siguiente formulario, nos encargaremos de ponernos en contacto contigo rápidamente.</p>
                <form enctype="multipart/form-data" method="post">
                
                <div class="input-field">
                    <input type="text" name="txt-name" id="txt-name" class="border-content"  placeholder="Nombre" required>
                    <input type="email" name="txt-email" id="txt-email"  class="border-content email-content"  placeholder="Email" required>
                </div>
               
               <div class="input-field-2">
                    <input type="text" name="txt-subject" id="txt-subject"  class="border-content" placeholder="Asunto" required>
                    <textarea name="txt-message" id="txt-message"  class="border-content" placeholder="Mensaje"
                              required></textarea>
               <div class="input-field">
           
                    <button type="submit" class="submit btn" name="btn-contact-us" id="btn-contact-us">Contactar
                    </button>
                </form>
            </di>
            </div>
        </div>
    </div>
</div> 
</div> 
</div> 
<div class="container-fluid container-map">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7951.20408931064!2d-80.6579306!3d-4.8381912!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9035fb3ecb8b8e45%3A0xb44c124e72aac4e2!2zw4lMIENISU5PIFNBWsOTTiBZIEZVU0nDk04!5e0!3m2!1ses-419!2spe!4v1700970860889!5m2!1ses-419!2spe" height="200" style=" width:100%;  border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
';
displayBaseWeb($content);
?>
<!--<form enctype="multipart/form-data" method="post">-->
<!---->
<!--    <div class="input-field">-->
<!--        <button type="submit" class="submit" name="btn-contact-us" id="btn-contact-us">Contactar-->
<!--        </button>-->
<!--    </div>-->
<!--</form>-->
<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport"-->
<!--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
<!--    <title>Document</title>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--</body>-->
<!--</html>-->