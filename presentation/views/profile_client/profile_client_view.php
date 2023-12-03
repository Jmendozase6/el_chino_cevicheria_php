<?php

use data_transfer_objects\UserDTO;

include_once '../landing/base_landing_view.php';
include_once '../../../data_access_objects/UserDAO.php';
include_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../data_access_objects/CartDAO.php';
require('profile_client.php');

if (!isset($_SESSION)) {
    session_start();
}

if ($GLOBALS['errorMessageProfile'] != null) { ?>
  <style>.display-on-error {
          display: block;
      }
  </style><?php
}

$isAuthenticated = isset($_SESSION["id"]);

if ($isAuthenticated) {
    $userDAO = new UserDAO();
    $currentUser = $userDAO->getUserById($_SESSION["id"]);
    $currentUserDTO = UserDTO::createFromResponse($currentUser);
}

$content = $isAuthenticated ? '
<div class="container py-5">
    <div class="row ">
        <div class="col-md-12">
            <h1 class="fw-bold my-2 text-center">Información Personal</h1>
        </div>

        <div class="row">
            <div class="col-md-12 m-2 d-flex justify-content-center align-items-center">
                <img src="' . $currentUserDTO->getImg() . '" alt="Foto de perfil" class="text-center object-fit-cover"
                     style="width: 200px; height: 200px">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-12 p-0 ">
                <div class="row">
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-2 d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <label for="name" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="' . $currentUserDTO->getName() . '" required autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-2 d-flex justify-content-center align-items-centerr">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <label for="last-name" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="last-name" name="last-name"
                                       value="' . $currentUserDTO->getLastName() . '" autocomplete="off">
                            </div>

                        </div>
                        <div class="mb-2 d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="' . $currentUserDTO->getEmail() . '" readonly autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-2 d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="' . $currentUserDTO->getAddress() . '" required autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-2 d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="' . $currentUserDTO->getPhone() . '" required autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-2 d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <button type="submit" class="btn btn-primary btn-submit w-100" id="btn-save-profile" name="btn-save-profile">Guardar</button>
                            </div>
                        </div>
                        <div class="mb-2 d-flex justify-content-center align-items-center">
                            <div class="col-sm-12 col-md-8 col-lg-6">
                                <div class="alert alert-danger display-on-error" role="alert">
                                    Error: ' . $GLOBALS['errorMessageProfile'] . '
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
' : '<div class="container wrapper-error">
    <div class="row">
        <div class="col-12 container-img-error-p">
            <img  class="container-img-error" src="../../resources/images/face.png" alt="Persona pensando">
        </div>
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <h2 class="text-center text-black py-3 fw-bold">Por favor, inicia sesión para acceder a tu perfil.</h2>
            <a href="../sign_in/sign_in_view.php" class="btn btn-primary btn-submit m-3 w-25">iniciar sesión</a>
        </div>
    </div>
</div>';
displayBaseWeb($content);
?>