<?php

use data_transfer_objects\UserDTO;

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
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Libro de Reclamaciones</h2>
            <form action="complaint_book.php" enctype="multipart/form-data">
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

                <button type="submit" class="btn btn-primary btn-submit">Enviar Reclamación</button>
            </form>
        </div>
    </div>
</div>
';
displayBaseWeb($content);
?>
