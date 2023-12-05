<?php

use data_transfer_objects\UserDTO;

include_once '../landing/base_landing_view.php';
include_once '../../../data_access_objects/UserDAO.php';
include_once '../../../data_transfer_objects/UserDTO.php';
require('complaints_book.php');

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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Libro de Reclamaciones</h2>
            <form enctype="multipart/form-data" method="post">
                <div class="form-group py-2">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre" required
                    value="' . ($currentUserDTO ? $currentUserDTO->getName() . " " . $currentUserDTO->getLastName() : '') . '">
                </div>

                <div class="form-group py-2">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" required
                    value="' . ($currentUserDTO ? $currentUserDTO->getEmail() : '') . '">
                </div>

                <div class="form-group py-2">
                    <label for="message">Mensaje de Reclamación:</label>
                    <textarea class="form-control form-control-textarea" id="message" name="message" rows="4" placeholder="Ingrese su reclamación" required></textarea>
                </div>

                  <div class="input-field">
                    <button type="submit" class="btn" style="font-size: 0.9rem;" name="btn-send-book" id="btn-send-book">Enviar Reclamo
                    </button>
                  </div>

                <div class="alert alert-danger mt-2 display-on-error-complaints" role="alert">
                  <strong>Error: </strong> ' . $_SESSION['errorMessageComplaintsBook'] . '
                </div>              
              
                <div class="alert alert-success mt-2 display-on-success-complaints" role="alert">
                  <strong>Genial: </strong> ' . $_SESSION['successMessageComplaintsBook'] . '
                </div>
                
            </form>
        </div>
    </div>
</div>
';
displayBaseWeb($content);