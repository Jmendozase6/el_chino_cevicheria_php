<?php

require_once '../../../data_access_objects/CartDAO.php';

if (!isset($_SESSION)) {
  session_start();
}

$cartDAO = new CartDAO();
$cartTotal = $cartDAO->getTotalFromCart(session_id());
function displayBaseWeb($content): void
{
  global $cartTotal;
  echo '<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/base_lading_style.css">
    <link rel="stylesheet" href="../../styles/about_us_style.css">
    <link rel="stylesheet" href="../../styles/contact_us_style.css">
    <link rel="stylesheet" href="../../styles/cart_new_style.css">
    <link rel="stylesheet" href="../../styles/check_information_style.css">
    <link rel="stylesheet" href="../../styles/initial_client_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<header>
    <div class="wrapper-header">
        <div class="container-fluid p-0 header-content">
            <div class="row m-0">
                <div class="col-12 d-flex align-items-center justify-content-between">
                    <a class="text-decoration d-flex align-items-center gap-1"
                       href="https://maps.app.goo.gl/igMfNPdfXEXvA8kb6" target="_blank"
                       rel="noopener noreferrer"><img
                                src="../../resources/icons/map_pin.svg"
                                alt="Icono de la ubicación">
                        <p class="m-0 p-0">Calle 2
                            de febrero 140, Querecotillo</p></a>

                    <div class="d-flex align-items-center gap-1">
                        <a class="text-decoration" href="../sign_in/sign_in_view.php">Ingresar</a>
                        <p class="m-0">/</p>
                        <a class="text-decoration" href="../sign_up/sign_up_view.php">Registro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="wrapper-nav border-bottom">
    <div class="container-fluid m-0">
        <div class="row m-0">
            <div class="col-12 d-flex justify-content-between">
                 <nav class="navbar navbar-expand-lg">
        <div class="container-fluid m-0 p-0">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <img src="../../resources/icons/burger.svg" alt="">
            </button>
            <div class="nav-collapse collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../initial_client/initial_client_view.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../catalog_client/catalog_client_view.php">Carta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about_us/about_us_view.php">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact_us/contact_us_view.php">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
                <div class="d-flex align-items-center gap-2 cart">
                    <a class="text-decoration-none" href="../cart_new/cart_new_view.php"> <img src="../../resources/icons/cart.svg" alt="Carrito"></a>
                    <div class="d-flex flex-column justify-content-center">
                        <p>Carrito:</p>
                        <p class="text-black">S/.' . $cartTotal . '</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main>
                ' . $content . '
</main>
<footer class="footer">
    <div class="container-fluid m-0">
        <div class="row">
            <div class="footer-content col-md-12 d-flex justify-content-between align-items-center">
                <div class="footer-content col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center">
                <p >© 2023 El Chino Cevichería - Calle 2 de Febrero #140, Tamarindo - Querecotillo</p>
                </div>
                <div class="icons-payment gap-1">
                <img src="../../resources/images/mercado_pago.png" alt="Mercado pago">
                <img src="../../resources/images/secure_icon.png" alt="Secure icon">
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="../../resources/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../resources/script/navbarInteractionsScript.js"></script>
</body>
</html>';
}