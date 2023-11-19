<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Correo Electrónico</title>
  <link rel="stylesheet" href="../../presentation/resources/bootstrap/css/bootstrap.min.css">
  <style>
      * {
          font-family: 'Poppins', sans-serif !important;
      }
  </style>
</head>
<body>
<!--Correo electrónico pare recuperar la contraseña, este contendrá un número de 6 digitos, aesthetic con bootstrap 5-->
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-5 border-0">
        <div class="card-header bg-dark">
          <h3 class="text-center text-light pt-1"><strong>Recuperación de contraseña</strong></h3>
        </div>
        <div class="card-body">
          <p class="text-center">Hola Jhair
            <br>Tu código de recuperación es: <br>
            <strong>12354</strong></p>
        </div>
        <div class="card-text">
          <p class="text-center">Si no has solicitado un cambio de contraseña, br ignora este mensaje.</p>
          <img src="../../presentation/resources/images/logo.png" alt="Logo de El Chino Cevichería"
               class="img-fluid mx-auto d-block">
        </div>
        <div class="card-footer bg-dark">
          <p class="text-center text-light pt-2">El Chino Cevichería &copy; 2021</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<h1>Recupera tu contraseña</h1>-->
<!--<p>Hola --><?php //echo $name ?><!--, tu código de recuperación es: <strong>-->
<?php //echo $code ?><!--</strong></p>-->
</body>
</html>