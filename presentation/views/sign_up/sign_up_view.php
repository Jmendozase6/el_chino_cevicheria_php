<?php
require('sign_up.php');
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/sign-in-style.css">
    <link rel="stylesheet" href="../../styles/recover-code-style.css">
    <title>Registro</title>
  <?php if ($GLOBALS['errorMessageSignUp'] != null) { ?>
      <style>.display-on-error {
              display: block;
          }</style><?php
  } ?>

</head>
<body>
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <img src="../../resources/images/logo.png" alt="Logo chino cevicheria" class="img_logo">
                <div class="text">
                </div>
            </div>

            <div class="col-md-6 right">
                <div class="input-box">
                    <header>Registro</header>
                    <div class="underline"></div>
                    <form enctype="multipart/form-data" method="post">
                        <div class="input-field">
                            <input type="text" class="input" name="name" id="name" required autocomplete="off"
                                   autofocus>
                            <label for="name">Nombre</label>
                        </div>

                        <div class="input-field">
                            <input type="text" class="input" name="last_name" id="last_name" required
                                   autocomplete="off">
                            <label for="last_name">Apellido</label>
                        </div>
                        <div class="input-field">
                            <input type="email" class="input" name="email" id="email" required autocomplete="off">
                            <label for="email">Correo electrónico</label>
                        </div>

                        <div class="input-field">
                            <input type="password" class="input" name="password" id="password" required
                                   autocomplete="off"
                                   minlength="6">
                            <label for="password">Contraseña</label>
                        </div>


                        <div class="input-field">
                            <input type="number" class="input" name="phone" id="phone" pattern="[0,9]+"
                                   inputmode="numeric" required autocomplete="off">
                            <label for="phone">Teléfono</label>
                        </div>

                        <div class="input-field">
                            <input type="text" class="input" name="address" id="address" required autocomplete="off">
                            <label for="address">Dirección</label>
                        </div>
                        <div class="input-field">
                            <button type="submit" class="submit" name="btn-sign-up" id="btn-sign-up">Registrarse
                            </button>
                        </div>

                        <div class="alert alert-danger m-2 display-on-error" role="alert">
                            <strong>Error: </strong> <?= $GLOBALS['errorMessageSignUp']; ?>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>