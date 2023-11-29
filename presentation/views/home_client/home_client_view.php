<?php
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
    <link rel="stylesheet" href="../../styles/home-client-style.css">
    <title>El Chino Cevichería</title>
</head>
<body>


<div class="container-fluid container-home-client">
    <div class="row row-home-client">

        <div class="col">
            <img height="180" src="../../resources/images/logo.png" alt="Logo">
        </div>
        <div class="col d-flex flex-column justify-content-end  align-items-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-modal w-10" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Aquí va el horario
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog  modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Información</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor sit
                            lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor sit
                            lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsumlorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum dolor
                            sitlorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem
                            ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci aliaslorem ipsum
                            dolor
                        </div>
                        <!--                        <div class="modal-footer">-->
                        <!--                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                        <!--                            <button type="button" class="btn btn-primary">Save changes</button>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col column-title">
            <h1 class="cevicheria-name">El Chino Cevichería 🐟</h1>
            <p class="section-title mt-3">¿Qué desea ordenar? 🍛</p>
            <p class="section-title mt-3">A domicilio 🚚</p>
            <a class="text-decoration-none" href="https://maps.app.goo.gl/igMfNPdfXEXvA8kb6"
               target="_blank" rel="noopener noreferrer"><p class="section-title btn-like">Calle 2
                    de febrero 140, Querecotillo 20141 📌</p></a>
        </div>
        <div class="col column-btn d-flex flex-column align-items-center">
            <a class="btn custom-button col-md-6 m-1 p-3" href="../catalog_client/catalog_client_view1.php">CATÁLOGO</a>
            <a class="btn custom-button col-md-6 m-1 p-3" href="https://wa.me/51929953419"
               target="_blank" rel="noopener noreferrer">WHATSAPP</a>
            <a class="btn custom-button col-md-6 m-1 p-3">FACEBOOK</a>
            <a class="btn custom-button col-md-6 m-1 p-3" href="../sign_in/sign_in_view.php">INICIAR SESIÓN</a>
        </div>
    </div>
</div>
<?php include '../components/custom_footer.php' ?>

<script src="../../resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>