<?php

use data_transfer_objects\UserDTO;

include '../landing/base_landing_view.php';
include_once '../../../data_access_objects/UserDAO.php';
include_once '../../../data_transfer_objects/UserDTO.php';
require('profile_client.php');

if (!isset($_SESSION)) {
    session_start();
}

$isAuthenticated = isset($_SESSION["id"]);

if ($isAuthenticated) {
    $userDAO = new UserDAO();
    $currentUser = $userDAO->getUserById($_SESSION["id"]);
    $currentUserDTO = UserDTO::createFromResponse($currentUser);
}

$editable = "";

$content = $isAuthenticated ? '
<div class="containerd-flex flex-column align-items-center">
  <div class="row">
    <div class="col-md-12">
      <h1 class="fw-bold my-2">Información Personal</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 m-2">
      <img src="' . $currentUserDTO->getImg() . '" alt="Foto de perfil" class="text-center object-fit-cover"
           style="width: 200px; height: 200px">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-10 col-md-12 p-0">
      <div class="row">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-2">
            <div class="col-sm-12 col-md-8 col-lg-6">
              <label for="name" class="form-label">Nombres</label>
              <input type="text" class="form-control" id="name" name="name"
               value="' . $currentUserDTO->getName() . '">
            </div>
          </div>
          <div class="mb-2">
            <div class="col-sm-12 col-md-8 col-lg-6">
              <label for="last-name" class="form-label">Apellidos</label>
              <input type="text" class="form-control" id="last-name" name="last-name"
                     value="' . $currentUserDTO->getLastName() . '">
            </div>
  
          </div>
          <div class="mb-2">
            <div class="col-sm-12 col-md-8 col-lg-6">
              <label for="email" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" 
              value="' . $currentUserDTO->getEmail() . '">
            </div>
          </div>
          <div class="mb-2">
            <div class="col-sm-12 col-md-8 col-lg-6">
              <label for="address" class="form-label">Dirección</label>
              <input type="email" class="form-control" id="address" name="address"
                     value="' . $currentUserDTO->getAddress() . '">
            </div>
          </div>
          <div class="mb-2">
            <div class="col-sm-12 col-md-8 col-lg-6">
              <label for="phone" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="phone" name="phone"
                     value="' . $currentUserDTO->getPhone() . '">
            </div>
          </div>
          
          <div class="mb-2">
            <div class="col-sm-12 col-md-8 col-lg-6">
              <button type="submit" class="btn-update-profile btn-primary" id="btn-update-profile" name="btn-update-profile">Actualizar
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
' : '<h1>PONER IMÁGEN TRISTE Y ABAJO K INICIE SESIÓN</h1>';
displayBaseWeb($content);

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Información Personal</title>
</head>
<body>
</body>
</html>
