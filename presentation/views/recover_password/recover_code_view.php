<?php
require('recover_code.php');
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
  <title>Recupera tu contraseña <?= $GLOBALS['errorCode'] ?></title>
    <?php if ($GLOBALS['errorCode'] != null) { ?>
      <style>.display-on-error {
              display: block;
          }</style><?php
    } ?>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-5 border-0">
        <div class="card-header bg-light border-0">
          <h3 class="text-center text-dark pt-1"><strong>Ingresa el código de recuperación</strong></h3>
        </div>
        <div class="card-body p-0">

          <form enctype="multipart/form-data" method="post">
            <div class="d-flex justify-content-center w-100">
              <label for="recover-code" class="w-75">
                <input type="number"
                       pattern="[0,9]+"
                       inputmode="numeric"
                       class="form-control my-3 text-center"
                       id="recover-code"
                       name="recover-code"
                       placeholder="Código de recuperación" minlength="6"
                       required>
              </label>
            </div>

            <div class="input-field d-flex justify-content-center">
              <button type="submit" class="btn btn-dark col-9 mb-3" name="btn-verify" id="btn-verify">Verificar</button>
            </div>

            <div class="alert alert-danger display-on-error" role="alert">
              <strong>Error: </strong> <?= $GLOBALS['errorCode']; ?>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "../components/custom_footer.php"; ?>
<script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
