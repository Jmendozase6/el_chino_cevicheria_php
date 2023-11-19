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
  <title>Recupera tu contraseña</title>
</head>
<body class="d-flex flex-column min-vh-100">

<!--<div class="container">-->
<!--  <div class="row">-->
<!--    <div class="col-md-6 offset-md-3">-->
<!--      <form action="recover_password_view.php" method="post" class="align-content-center">-->
<!---->
<!--        <div class="form-group">-->
<!--          <label for="recover-password-1">Nueva contraseña</label>-->
<!--          <input type="password" class="form-control pt-2" id="recover-password-1" name="recover-password-1"-->
<!--                 aria-describedby="emailHelp"-->
<!--                 placeholder="Nueva contraseña">-->
<!--        </div>-->
<!---->
<!--        <div class="form-group py-2">-->
<!--          <label for="recover-password-2">Repite tu contraseña</label>-->
<!--          <input type="password" class="form-control pt-2" id="recover-password-2" name="recover-password-2"-->
<!--                 placeholder="Password">-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-primary">Submit</button>-->
<!---->
<!--      </form>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->


<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-5 border-0">
        <div class="card-header bg-light border-0">
          <h3 class="text-center text-dark pt-1"><strong>Establece tu nueva contraseña</strong></h3>
        </div>
        <div class="card-body">
          <form action="recover_password_view.php" method="post" class="align-content-center">
            <div class="form-group">
              <label for="recover-password-1">Nueva contraseña</label>
              <input type="password" class="form-control pt-2" id="recover-password-1" name="recover-password-1"
                     aria-describedby="emailHelp"
                     placeholder="Nueva contraseña">
            </div>
            <div class="form-group py-2">
              <label for="recover-password-2">Repite tu contraseña</label>
              <input type="password" class="form-control pt-2" id="recover-password-2" name="recover-password-2"
                     placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary my-2 bg-dark border-0 col-12">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="card-footer bg-dark mt-auto">
  <p class="text-center text-light pt-2">El Chino Cevichería &copy; 2023</p>
</footer>
</body>
</html>
