<?php
$paymentId = $_GET['payment_id'];
$paymentStatus = $_GET['status'];
$paymentType = $_GET['payment_type'];
$orderId = $_GET['merchant_order_id'];

//echo '<h3>Payment Information</h3>';
//
//echo "paymentId: " . $paymentId . '<br>';
//echo "paymentStatus: " . $paymentStatus . '<br>';
//echo "paymentType: " . $paymentType . '<br>';
//echo "orderId: " . $orderId . '<br>';

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
  <title>Document</title>
</head>
<body>
<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col-auto">
      <div class="card p-4">
        <div class="card-body">
          <h1>¡Gracias por tu compra!</h1>
          <p>El pago se realizó con éxito.</p>
          <p>Acabamos de enviar el reporte de compra a tu correo.</p>
          <a href="../sign_in/sign_in_view.php" class="btn btn-success text-decoration-none" type="button">Regresar al
            inicio</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
