<?php

use data_transfer_objects\UserDTO;

require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_transfer_objects/UserDTO.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['id'] == null) {
    header('Location: ../sign_in/sign_in_view.php');
} elseif ($_SESSION['id_role'] != 1) {
    header('Location: ../initial_client/initial_client_view.php');
} else {
    $userDAO = new UserDAO();
    $responseClients = $userDAO->getClients();
    $responseClientsDTO = [];
    for ($i = 0; $i < sizeof($responseClients); $i++) {
        $responseClientsDTO[$i] = UserDTO::createFromResponse($responseClients[$i]);
    }
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Categorías</title>
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/add_category_style.css">
</head>
<body>
<main class="container pt-4 pb-4">
  <div class="row align-content-between">
    <div class="col-4">
      <a href="home_view.php" class="btn btn-outline-success"><i
            class="bi-arrow-left"></i></a>
    </div>
    <div class="col-4"><h1 class="py-2 fw-bold">Usuarios</h1></div>
  </div>
  <table class="table table-sm table-hover">
    <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombres</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Dirección</th>
      <th scope="col">Correo</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Imagen</th>
      <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody id="content" name="content">
    <?php foreach ($responseClientsDTO as $client) { ?>
      <tr>
        <th class="align-middle" scope="row"><?= $client->getId() ?></th>
        <td class="text-truncate align-middle">
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                    <?= $client->getName() ?>
                    </span>
        </td>
        <td class="text-truncate align-middle">
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                    <?= $client->getLastName() ?>
                    </span>
        </td>
        <td class="text-truncate align-middle">
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                    <?= $client->getAddress() ?>
                    </span>
        </td>
        <td class="text-truncate align-middle">
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                    <?= $client->getEmail() ?>
                    </span>
        </td>
        <td class="text-truncate align-middle">
                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                    <?= $client->getPhone() ?>
                    </span>
        </td>
        <td class="align-middle">
          <img class="img table-category-img" src="<?= $client->getImg() ?>" alt="imagen"
               style="width: 100px; height: 100px">
        </td>
        <td class="align-middle">
          <a href="delete_user.php?id=<?= $client->getId() ?>"
             class="col me-2 btn btn-outline-secondary"><i class="bi bi-trash3"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</main>
</body>
</html>
