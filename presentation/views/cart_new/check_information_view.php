<?php
global $cartTotal;

function displayIfAuthenticated(): string
{
    global $isAuthenticated, $preference;
    if ($isAuthenticated) {
        $javascriptCode = '
        <script type="text/javascript">
            const $id = new MercadoPago("' . MERCADO_PAGO_TEST_PUBLIC_KEY . '", {
                locale: "es-PE"
            })
            // bg color: #F6F6F6
            $id.checkout({
                preference: {
                    id: "' . $preference->id . '"
                },
                render: {
                    container: ".checkout-btn",
                    label: "Pagar con MercadoPago"
                }
            });
        </script>
    ';
        $content = '<div class="col-auto checkout-btn"></div>' . $javascriptCode;
    } else {
        $content = '
         <button type="button" class="btn btn-success" data-bs-toggle="modal"
                  data-bs-target="#sign-in-modal">
            Para poder pagar, inicia sesión
          </button> ';
        include_once '../sign_in/sign_in_view_modal.php';
    }

    return $content;
}

include '../landing/base_landing_view.php';
$content = '
<div class="container wrapper-check-information">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-7 d-flex justify-content-center align-items-center container-user-data">
            <div class="d-flex flex-column align-items-center w-100">
                <h1 class="text-check-information py-3">Comprobar información</h1>
                <div class="input-fields w-100">
                    <div class="name-user">
                        <label for="txt-name" class="label-content label-name w-100">Nombres
                            <input type="text" name="txt-name" id="txt-name"
                                   class="txt-user-data border-content"
                                   placeholder="Nombres"
                                   required>
                        </label>
                        <label for="txt-last-name" class="label-content w-100">Apellidos
                            <input type="text" name="txt-user-data txt-last-name" id="txt-last-name"
                                   class="txt-last-name txt-user-data border-content"
                                   placeholder="Apellidos" required>
                        </label>
                    </div>

                    <div class="">
                        <label for="txt-address" class="label-content">Dirección</label>
                        <input type="text" name="txt-address" id="txt-address" class="txt-user-data border-content"
                               placeholder="Dirección" required>
                    </div>
                    <div class="info-text">
                        <label for="txt-district" class="label-content label-district w-100">Distrito
                            <select class="form-select txt-user-data mb-2" id="txt-district" name="txt-district"
                                    aria-label="Default select example">
                                <option value="1">Vichayal - S/2.00</option>
                                <option value="2" selected>Querecotillo - S/2.00</option>
                            </select>
                        </label>

                        <label for="txt-phone" class="label-content w-100">Teléfono
                            <input type="text" name="txt-phone" id="txt-phone" class="txt-user-data border-content"
                                   placeholder="Teléfono" required>
                        </label>
                    </div>
                    <hr class="m-1">
                    <div class="">
                        <div class="py-2">
                            <h2 class="text-titles">Método de pago</h2>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="delivery" id="flexRadioDefault1"
                                       name="options" checked required>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Mercado Pago (Tarjetas)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="storePickup" id="flexRadioDefault2"
                                       name="options" required>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Plin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="storePickup" id="flexRadioDefault3"
                                       name="options" required>
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Yape
                                </label>
                            </div>
                        </div>
                        <h2 class="text-titles">Comentarios</h2>
                        <label for="txt-message" class="label-content-comment p-0 pb-1">(Opcional)</label>
                        <textarea name="txt-message" id="txt-message" class="textarea border-content txt-user-data"
                                  placeholder="Puedes colocar una referencia, te llamaremos de igual forma."
                                  required></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="container payment-card-check">
                <div class="row p-3 ">
                    <div class="col">
                        <div class="col d-flex justify-content-between pt-3">
                            <h6 class="text-card"> Delivery</h6>
                            <h6 class="text-card"> S / 2.00</h6>
                        </div>
                        <hr class="p-1">
                        <div class="col d-flex justify-content-between">
                            <h5 class="text-card-t"> Total</h5>
                            <h5 class="text-card-t text-card-t-modified"> S / ' . $cartTotal . '</h5>
                        </div>
                        ' . displayIfAuthenticated() . '
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
displayBaseWeb($content);
?>

