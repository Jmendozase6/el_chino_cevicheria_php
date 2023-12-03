<?php
require('sign_in.php');
require('../recover_password/recover_password.php');
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Iniciar sesión</title>
  <link rel="icon" href="../../resources/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/sign-in-style.css">
    <?php if ($GLOBALS['errorMessage'] != null) { ?>
      <style>.display-on-error {
              display: block;
          }</style><?php
    } ?>
    <?php if ($GLOBALS['nonExistentEmailMessage'] != null) { ?>
      <style>.display-on-non-existent-email {
              display: block;
          }</style><?php
    } ?>
</head>
<body>
<div class="wrapper">
  <div class="container pt-3 main">
    <div class="row">
      <div class="col-md-6 side-image">
        <img src="../../resources/images/logo.png" alt="Logo chino cevicheria" class="img_logo">
        <div class="text">
        </div>
      </div>

      <div class="col-md-6 right">
        <div class="input-box">
          <header>Inicio de Sesión</header>
          <div class="underline"></div>
          <form enctype="multipart/form-data" method="post">

            <div class="input-field">
              <input type="email" class="input" name="email" id="email" required autocomplete="off"
                     autofocus>
              <label for="email">Correo electrónico</label>
            </div>

            <div class="input-field">
              <input type="password" class="input" name="password" id="password" required
                     autocomplete="off"
                     minlength="6" maxlength="16">
              <label for="password">Contraseña</label>
            </div>

            <div class="input-field">
              <button type="submit" class="submit" name="btn-sign-in" id="btn-sign-in">Iniciar sesión
              </button>
            </div>

            <button type="button" class="btn btn-modal w-10 border-0 mt-1 mb-1" data-bs-toggle="modal"
                    data-bs-target="#recover-password-modal">
              ¿Olvidaste tu contraseña?
            </button>

            <div class="alert alert-danger m-2 display-on-error" role="alert">
              <strong>Error: </strong> <?= $GLOBALS['errorMessage']; ?>
            </div>

          </form>
          <hr>
          <div class="input-field">
            <p class="text-secondary">Si no tiene una cuenta: <a
                  class="text-primary text-decoration-none fst-italic"
                  id="btn-sign-up"
                  href="../sign_up/sign_up_view.php">Regístrese
              </a>
            </p>
          </div>
          <div class="col d-flex flex-column justify-content-end  align-items-end">
            <div class="modal fade" id="recover-password-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Recuperar contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                  </div>
                  <div class="modal-body mt-1">
                    <span>Escribe tu correo y si tienes una cuenta te enviarémos un código de 6 digitos.</span>
                    <form enctype="multipart/form-data" method="post">
                      <div class="input-group mb-3 pt-2">
                        <label class="input-group-text" id="basic-addon1">@</label>
                        <input type="email" class="form-control"
                               placeholder="Correo electrónico" aria-label="Email"
                               aria-describedby="basic-addon1" id="recover-email"
                               name="recover-email" required>
                      </div>

                      <div class="input-field">
                        <button type="submit" class="submit"
                                id="btn-recover-password" name="btn-recover-password">
                          Recuperar contraseña
                        </button>
                      </div>
                    </form>
                    <div class="alert alert-danger m-2 display-on-non-existent-email" role="alert">
                      <strong>Error:</strong> <?= $GLOBALS['nonExistentEmailMessage']; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
