<?php
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
  <title>Iniciar sesión</title>
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
          <header>Inicio de Sesion</header>
          <div class="underline"></div>
          <form action="sign_in.php" enctype="multipart/form-data" method="post">

            <div class="input-field">
              <input type="email" class="input" name="email" id="email" required autocomplete="off">
              <label for="email" class="">Correo electrónico</label>
            </div>
            <div class="input-field">
              <input type="password" class="input" name="password" id="password" required autocomplete="off">
              <label for="password" class="password">Contraseña</label>
            </div>

            <div class="input-field">
              <button type="submit" class="submit" name="btnSignIn">Sign in</button>
            </div>
              <?php include "sign_in.php"; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
