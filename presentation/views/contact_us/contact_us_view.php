<?php

use data_transfer_objects\UserDTO;

require('contact_us.php');

include_once '../landing/base_landing_view.php';
include_once '../../../data_access_objects/UserDAO.php';
include_once '../../../data_transfer_objects/UserDTO.php';

if (!isset($_SESSION)) {
    session_start();
    $id = $_SESSION['id'];
}

$isAuthenticated = isset($_SESSION["id"]);
$currentUserDTO = null;

if ($isAuthenticated) {
    $userDAO = new UserDAO();
    $currentUser = $userDAO->getUserById($_SESSION["id"]);
    $currentUserDTO = UserDTO::createFromResponse($currentUser);
}

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
    <div
        class="col-sm-12 col-md-12 col-lg-9 d-flex flex-column justify-content-center align-items-center p-0 col-contact">
      <div class="p-4 container-contact">
        <div class="align-content">
          <h1 class="contact-text">Contáctanos!</h1>
          <p class="pb-4 description-contact">Si tienes alguna pregunta o consulta, no dudes en enviarnos un mensaje a
            través del siguiente formulario, nos encargaremos de ponernos en contacto contigo rápidamente.</p>
          <form enctype="multipart/form-data" method="post">

            <div class="input-field">

              <input type="text" name="name" id="name" class="border-content" aria-label="Nombre"
                     placeholder="Nombre" required value="' . ($currentUserDTO ? $currentUserDTO->getName() : '') . '">

              <input type="email" name="email" id="email"
                     class="border-content email-content" placeholder="Email"
                     required value="' . ($currentUserDTO ? $currentUserDTO->getEmail() : '') . '" aria-label="Correo">
            </div>

            <div class="input-field-2">
              <input type="text" name="subject" id="subject" class="border-content"
                     placeholder="Asunto" required aria-label="Asunto">
              
              <textarea name="content" id="content" class="border-content"
                        placeholder="Mensaje"
                        required></textarea>
                        
              <div class="input-field">
                <button type="submit" class="btn" name="btn-contact-us" id="btn-contact-us">Contactar
                </button>
              </div>

              <div class="alert alert-danger mt-2 display-on-error" role="alert">
                <strong>Error: </strong> ' . $_SESSION['errorMessageContactUs'] . '
              </div>              
              
              <div class="alert alert-success mt-2 display-on-success" role="alert">
                <strong>Genial: </strong> ' . $_SESSION['successMessageContactUs'] . '
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container-fluid container-map">
  <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7951.20408931064!2d-80.6579306!3d-4.8381912!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9035fb3ecb8b8e45%3A0xb44c124e72aac4e2!2zw4lMIENISU5PIFNBWsOTTiBZIEZVU0nDk04!5e0!3m2!1ses-419!2spe!4v1700970860889!5m2!1ses-419!2spe"
      height="200" style=" width:100%;  border:0;" allowfullscreen="" loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
';
displayBaseWeb($content);