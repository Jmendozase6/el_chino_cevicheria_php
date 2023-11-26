<?php
include '../landing/base_landing_view.php';
$content = '
<div class="container wrapper-about-us">
    <div class="row pt-3 pb-4">
        <div class="col-sm-12 col-md-12 col-lg-6 column-text column-text-right ">
            <h1>¿Quiénes somos?</h1>
            <p>Somos “El Chino Cevichería”, ubicados en el distrito de Querecotillo, llevamos más de 12 años satisfaciendo el paladar de nuestros clientes. No hay lugar más preparado que nosotros para satisfacer sus gustos, consideramos que el cliente siempre es primero, porque sin ustedes, no seríamos nada.
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <img class="img-about-us" src="../../resources/images/about_us_01.png" alt="Sobre nosotros 01">
        </div>
    </div>
    <hr>
    <!--  Mobile-->
    <div class="row pt-4 pb-4 row-about-us ">
        <div class="col-sm-12 col-md-12 col-lg-6  column-text">
            <h1>Comida con ingredientes 100% frescos</h1>
            <p>En cada plato que degustará, se usaron ingredientes frescos y de alta calidad para siempre mantener la calidad.</p>
            <div class="row row-about-us-02 pt-2 pb-3">
                <div class="col-sm-6 col-md-6 d-flex flex-row justify-content-start align-items-center">
                    <img src="../../resources/icons/delivery.svg" alt="Delivery">
                    <div class="flex-column ps-2">
                        <h6>Contamos con delivery</h6>
                        <p>Recibimos comentarios</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 d-flex flex-row justify-content-start align-items-center secure-payment-column">
                    <img src="../../resources/icons/secure_payment.svg" alt="Pago seguro">
                    <div class="flex-column ps-2">
                        <h6>Pago 100% seguro</h6>
                        <p>Procesamos los pagos de forma segura</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 d-flex">
            <img class="img-about-us" src="../../resources/images/about_us_02.png" alt="Sobre nosotros 02">
        </div>
    </div>

    <!--  Desktop-->
    <div class="row pt-4 pb-4 row-about-us-01 ">
        <div class="col-lg-6 d-flex">
            <img class="img-about-us" src="../../resources/images/about_us_02.png" alt="Sobre nosotros 02">
        </div>
        <div class="col-lg-6 column-text column-text-left">
            <h1>Comida con ingredientes 100% frescos</h1>
            <p>En cada plato que degustará, se usaron ingredientes frescos y de alta calidad para siempre mantener la calidad.</p>

            <div class="row row-about-us-02">
                <div class="col-lg-12 col-xl-6 p-0 pt-2 d-flex flex-row align-items-center">
                    <img src="../../resources/icons/delivery.svg" alt="Delivery">
                    <div class="flex-column ps-2">
                        <h6>Contamos con delivery</h6>
                        <p>Recibimos comentarios</p>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6 p-0 pt-2 d-flex flex-row align-items-center">
                    <img src="../../resources/icons/secure_payment.svg" alt="Pago seguro">
                    <div class="flex-column ps-2">
                        <h6>Pago 100% seguro</h6>
                        <p>Procesamos los pagos de forma segura</p>
                    </div>
                </div>
                <div class="row row-about-us-02">
                <div class="col-lg-12 col-xl-6 p-0 pt-2 d-flex flex-row align-items-center">
                    <img src="../../resources/icons/leaf.svg" alt="Hoja">
                    <div class="flex-column ps-2">
                        <h6>100% Frescos</h6>
                        <p>Usamos ingredientes frescos.</p>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6 p-0 pt-2 d-flex flex-row align-items-center">
                    <img src="../../resources/icons/headphones.svg" alt="Audifono">
                    <div class="flex-column ps-2">
                        <h6>Libro de reclamaciones</h6>
                        <p>Puedes dejar tu queja.</p>
                    </div>
                </div>
            </div>
            <div class="row row-about-us-02">
                <div class="col-lg-12 col-xl-6 p-0 pt-2 d-flex flex-row align-items-center">
                    <img src="../../resources/icons/stars.svg" alt="Estrella">
                    <div class="flex-column ps-2">
                        <h6>Contamos con delivery</h6>
                        <p>Recibimos comentarios</p>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-6 p-0 pt-2 d-flex flex-row align-items-center">
                    <img src="../../resources/icons/package.svg" alt="Paquete">
                    <div class="flex-column ps-2">
                        <h6>Innovación</h6>
                        <p>Estamos constantemente innovándonos</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row pt-4 pb-4">
        <div class="col-sm-12 col-md-12 col-lg-6 column-text column-text-right ">
            <h1>Contamos con envío a domicilio.</h1>
            <p>Por ahora, solo realizamos envíos a domicilio a lugares dentro de Vichayal y Querecotillo, pero pronto haremos más extensa la zona de cobertura.
            </p>
            <div class="d-flex">
                <img src="../../resources/icons/check.svg" alt="Check">
                <p class="ps-1 pt-2">Rapidez al realizar tus pedidos.</p>
            </div>
            <div class="d-flex">
                <img src="../../resources/icons/check.svg" alt="Check">
                <p class="ps-1 pt-2">Seguridad en tus pagos.</p>
            </div>
            <div class="d-flex pb-3">
                <img src="../../resources/icons/check.svg" alt="Check">
                <p class="ps-1 pt-2">Integridad de los platos.</p>
            </div>
            <div class="pb-4 d-flex justify-content-center btn-content">
                <button class="btn">Comprar ahora <img src="../../resources/icons/arrow.svg" alt="Flecha"></button>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 d-flex align-items-center">
            <img class="img-about-us" src="../../resources/images/about_us_03.png" alt="Sobre nosotros 01">
        </div>
    </div>
</div>
';
displayBaseWeb($content);
?>
