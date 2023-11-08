<?php
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Carrito</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../styles/side-bar-style.css">
</head>
<body>
<div class="wrapper">
    <?php include "../components/custom_nav.php" ?>
  <div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
      <div class="text-center">
        <strong style="font-size: 2rem">Carrito de compras</strong> <br> <br>
        <img src="../../resources/images/empty.png" alt="Carrito Vacío"> <br> <br>
        <span>No hay productos agregados</span>
      </div>
    </div>
  </div>
</div>
</body>
</html>
