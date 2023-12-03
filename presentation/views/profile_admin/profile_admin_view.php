<?php

use data_transfer_objects\UserDTO;

include_once '../../../data_access_objects/UserDAO.php';
include_once '../../../data_transfer_objects/UserDTO.php';

if (!isset($_SESSION)) {
    session_start();
}

$isAuthenticated = isset($_SESSION["id"]);

if ($isAuthenticated) {
    $userDAO = new UserDAO();
    $currentUser = $userDAO->getUserById($_SESSION["id"]);
    $currentUserDTO = UserDTO::createFromResponse($currentUser);
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cuenta</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body>
<div class="bg-light mx-auto d-flex side-bar vw-100 vh-100">
    <?php include '../components/side_bar.php' ?>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center p-2">
      <div class="row">
          <?php include '../components/side-menu-mobile.php' ?>
      </div>
    </div>
    <div class="container-fluid-content py-5">
      <div class="row ">
        <div class="col-md-12">
          <h1 class="fw-bold my-2 text-center">Información Personal</h1>
        </div>

        <div class="row">
          <div class="col-md-12 m-2 d-flex justify-content-center align-items-center">
            <img src="<?= $currentUserDTO->getImg() ?>" alt="Foto de perfil" class="text-center object-fit-cover"
                 style="width: 200px; height: 200px">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-10 col-md-12 p-0 ">
            <div class="row">
              <form method="post" enctype="multipart/form-data" action="update_profile.php">
                <div class="mb-2 d-flex justify-content-center align-items-center">
                  <div class="col-sm-12 col-md-8 col-lg-6">
                    <label for="name" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?= $currentUserDTO->getName() ?>" required autofocus autocomplete="off">
                  </div>
                </div>
                <div class="mb-2 d-flex justify-content-center align-items-centerr">
                  <div class="col-sm-12 col-md-8 col-lg-6">
                    <label for="last-name" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="last-name" name="last-name"
                           value="<?= $currentUserDTO->getLastName() ?>" autocomplete="off">
                  </div>

                </div>
                <div class="mb-2 d-flex justify-content-center align-items-center">
                  <div class="col-sm-12 col-md-8 col-lg-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?= $currentUserDTO->getEmail() ?>" readonly autocomplete="off">
                  </div>
                </div>
                <div class="mb-2 d-flex justify-content-center align-items-center">
                  <div class="col-sm-12 col-md-8 col-lg-6">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="<?= $currentUserDTO->getAddress() ?>" required autocomplete="off">
                  </div>
                </div>
                <div class="mb-2 d-flex justify-content-center align-items-center">
                  <div class="col-sm-12 col-md-8 col-lg-6">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                           value="<?= $currentUserDTO->getPhone() ?>" required autocomplete="off">
                  </div>
                </div>
                <div class="mb-2 d-flex justify-content-center align-items-center">
                  <div class="col-sm-12 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-primary btn-submit w-100" id="btn-save-profile"
                            name="btn-save-profile">Guardar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
