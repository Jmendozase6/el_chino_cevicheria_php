<?php
require('sign_in.php');
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/recover-code-style.css">
  <title>Inicia sesión</title>
    <?php if ($GLOBALS['errorMessageModal'] != null) { ?>
      <style>.display-on-error {
              display: block;
          }</style><?php
    } ?>
</head>
<body>
<div class="modal fade" id="sign-in-modal" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Iniciar Sesión</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span class="mb-2">Ingresa tus datos para poder realizar el pago</span>
        <form enctype="multipart/form-data" method="post">

          <div class="input-field">
            <label for="email" class="form-label">
              <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico"
                     required>
            </label>
          </div>

          <div class="input-field">
            <label for="password" class="form-label">
              <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                     minlength="6" required>
            </label>
          </div>

          <button type="submit" class="btn btn-primary my-2 col-12" name="btn-sign-in-modal" id="btn-sign-in-modal"
                  value="sign-in-modal">
            Ingresar
          </button>

        </form>
        <div class="alert alert-danger display-on-error" role="alert">
          <strong>Error:</strong> <?= $GLOBALS['errorMessageModal']; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
