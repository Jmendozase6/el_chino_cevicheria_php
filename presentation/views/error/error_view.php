<?php
include_once '../landing/base_landing_view.php';
$content = '
    <div class="container wrapper-error">
    <div class="row">
        <div class="col-12 container-img-error-p">
            <img  class="container-img-error" src="../../resources/images/error_404.png" alt="Error 404">
        </div>
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-center text-black py-3 fw-bold">Oops! Ocurrió un error en nuestros sistemas</h1>
            <p class="text-center  m-3">Reinténtelo mas tarde</p>
            <button class="btn btn-primary btn-submit  m-3">Volver al inicio</button>
        </div>
    </div>
</div>
';
displayBaseWeb($content);