<?php
session_start();
if (!isset($_SESSION['recover-email']) || !isset($_SESSION['recover-code-email'])) {
    header('Location: ../../../index.php');
}

require('new_password.php');
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
  <title>Recupera tu contraseña</title>
    <?php if ($GLOBALS['noMatchPasswords'] != null) { ?>
      <style>.display-on-error {
              display: block;
          }</style><?php
    } ?>
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-5 border-0">
        <div class="card-header bg-light border-0">
          <h3 class="text-center text-dark pt-1"><strong>Establece tu nueva contraseña</strong></h3>
        </div>
        <div class="card-body p-0">

          <form method="post" class="align-content-center mt-2" enctype="multipart/form-data">

            <div class="input-field">
              <label for="recover-password-1">Nueva contraseña</label>
              <input type="password" class="form-control my-2" id="recover-password-1" name="recover-password-1"
                     placeholder="Nueva contraseña" minlength="6" required>
            </div>

            <div class="input-field">
              <label for="recover-password-2">Repite tu contraseña</label>
              <input type="password" class="form-control my-2" id="recover-password-2" name="recover-password-2"
                     placeholder="Password" minlength="6" required>
            </div>

            <button type="submit" class="btn btn-dark my-2 col-12" id="btn-update-password" name="btn-update-password">
              Actualizar
            </button>

            <div class="alert alert-danger display-on-error" role="alert">
              <strong>Error: </strong> <?= $GLOBALS['noMatchPasswords']; ?>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "../components/custom_footer.php"; ?>
</body>
</html>
