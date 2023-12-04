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
    <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../styles/add_category_style.css">
    <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body class="bg-light vh-100 vw-100">
<div class="mx-auto d-flex side-bar">
  <?php include '../components/side_bar.php' ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center p-2">
            <div class="row">
              <?php include '../components/side-menu-mobile.php' ?>
            </div>
        </div>
        <main class="container-fluid container-fluid-content">
            <div class="col"><h1 class="py-2 fw-bold">Clientes</h1></div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Clientes
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-xl">
                                <div id="example_wrapper">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example" class="table table-striped data-table"
                                                   style="max-width: 100%;" role="grid" aria-describedby="example_info">
                                                <thead>
                                                <tr role="row">
                                                    <th style="width: 50px;">ID</th>
                                                    <th style="width: 100px;">Nombres</th>
                                                    <th style="width: 100px;">Apellidos</th>
                                                    <th style="width: 120px;">Dirección</th>
                                                    <th style="width: 120px;">Correo</th>
                                                    <th style="width: 70px;">Teléfono</th>
                                                    <th style="width: 150px;">Imagen</th>
                                                    <th style="width: 135px;">Acciones
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody id="content" name="content">
                                                <?php foreach ($responseClientsDTO as $client) { ?>
                                                    <tr>
                                                        <th class="align-middle"
                                                            scope="row"><?= $client->getId() ?></th>
                                                        <td class="text-truncate align-middle">
                                                            <span class="d-inline-block text-truncate"
                                                                  style="max-width: 150px;">
                                                            <?= $client->getName() ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-truncate align-middle">
                                                            <span class="d-inline-block text-truncate"
                                                                  style="max-width: 150px;">
                                                            <?= $client->getLastName() ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-truncate align-middle">
                                                            <span class="d-inline-block text-truncate"
                                                                  style="max-width: 150px;">
                                                            <?= $client->getAddress() ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-truncate align-middle">
                                                            <span class="d-inline-block text-truncate"
                                                                  style="max-width: 150px;">
                                                            <?= $client->getEmail() ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-truncate align-middle">
                                                            <span class="d-inline-block text-truncate"
                                                                  style="max-width: 150px;">
                                                            <?= $client->getPhone() ?>
                                                            </span>
                                                        </td>

                                                        <td class="align-middle d-flex justify-content-center  align-items-center">
                                                            <img class="img table-category-img"
                                                                 src="<?= $client->getImg() ?>"
                                                                 alt="imagen"
                                                                 style="width: 100px; height: 100px">
                                                        </td>
                                                        <td class="align-middle">
                                                            <a href="delete_user.php?id=<?= $client->getId() ?>"
                                                               class="col me-2 btn btn-outline-secondary"><i
                                                                        class="bi bi-trash3 text-danger"></i>
                                                            </a>
                                                            <label for="id_category"></label>
                                                            <!--                              <select name="id_category" id="id_category"-->
                                                            <!--                                      class="form-control">-->
                                                            <!--                                  --><?php //foreach ($roles as $role): ?>
                                                            <!--                                    <option-->
                                                            <!--                                        value="-->
                                                          <?php //echo $role->getId(); ?><!--">-->
                                                          <?php //echo $role->getName(); ?><!--</option>-->
                                                            <!--                                  --><?php //endforeach; ?>
                                                            <!--                              </select>-->
                                                            <!--                              <a href="change_role.php?id=-->
                                                          <?php //= $client->getId() ?><!--"-->
                                                            <!--                                 class="col me-2 btn btn-outline-secondary"><i class="bi bi-award"></i>-->
                                                            <!--                              </a>-->
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="../../resources/js/jquery-3.7.0.js"></script>
<script src="../../resources/js/jquery.dataTables.min.js"></script>
<script src="../../resources/js/dataTables.bootstrap5.min.js"></script>
<script src="../../resources/js/script.js"></script>
</body>
</html>
