<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL & ~E_DEPRECATED);

include_once '../landing/base_landing_view.php';

use data_transfer_objects\ProductDTO;

require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/ProductDTO.php';

$cartDAO = new CartDAO();
$responseProductsFromCart = $cartDAO->getProductsFromCart();
$cartTotal = $cartDAO->getTotalFromCart(session_id());
$productsFromCartDTO = [];

foreach ($responseProductsFromCart as $productFromCart) {
    $productDAO = new ProductDAO();
    $product = $productDAO->getProductById($productFromCart['id']);
    $productDTO = ProductDTO::createFromResponse($product);
    $productsFromCartDTO[] = $productDTO;
}

$isAuthenticated = isset($_SESSION["id"]);

if (sizeof($productsFromCartDTO) == 0) {
    header('Location: ../empty_cart/empty_cart_view.php');
    exit();
}

function displayProducts(): string
{
    global $productsFromCartDTO, $responseProductsFromCart;
    $content = '';

    for ($i = 0;
         $i < sizeof($productsFromCartDTO);
         $i++) {
        $content .= '
     <div class="col-4 d-flex justify-content-center align-content-center">
                <img class="mb-2 rounded-1 img-product" src="' . $productsFromCartDTO[$i]->getImage() . '" alt="Producto">
     </div>
            <div class="col-4 d-flex flex-column justify-content-start gap-2 p-1 product-data">
               <h6 class="name-product">' . $productsFromCartDTO[$i]->getName() . '</h6>
               <h6 class="name-type">' . $productsFromCartDTO[$i]->getDescription() . '</h6>
               <h6 class="name-price">S/.' . $productsFromCartDTO[$i]->getPrice() . '</h6>
            </div>
            <div class="col-4 p-0 d-flex align-items-center">
            
            <div class="content-btn d-flex">
                <a class="btn text-black btn-sm d-flex justify-content-center align-items-center p-1"
                id="btn-increase" 
                type="button"
                href="change_quantity.php?id=' . $productsFromCartDTO[$i]->getId() .
            '&quantity=' . $responseProductsFromCart[$i]['quantity'] . '&type=I"><i class="bi bi-plus-lg"></i></a>

                <p class="m-0 p-2 text-black"><strong>' . $responseProductsFromCart[$i]['quantity'] . '</strong></p>
                
                <a class="btn text-black btn-sm d-flex justify-content-center align-items-center p-1"
                  id="btn-decrease" 
                  type="button"
                  href="change_quantity.php?id=' . $productsFromCartDTO[$i]->getId() .
            '&quantity=' . $responseProductsFromCart[$i]['quantity'] . '&type=D"
                >' . displayIcon($responseProductsFromCart[$i]['quantity'] == 1) . '</a >
            </div >
            </div >
        <hr>
        ';
    }
    return $content;
}

function displayIcon($quantity): string
{
    return $quantity == 1 ? '<i class="bi bi-trash text-danger"></i > ' : '<i class="bi bi-dash"></i>';
}

function displayIfAuthenticated(): string
{
    $isAuthenticated = isset($_SESSION["id"]);
    if ($isAuthenticated) {
        return '
        <div class="pb-2 d-flex justify-content-center mb-3">
            <button class="btn btn-primary" type="submit" onclick="sendPaymentForm()">Pagar</button>
        </div>
        ';
    } else {
        $content = '
        <div class="pb-2 d-flex justify-content-center mb-3">
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                  data-bs-target="#sign-in-modal">
            Inicia sesión para pagar
            </button>
         </div> ';
        include_once '../sign_in/sign_in_view_modal.php';
    }
    return $content;
}

function displayPaymentForm(): string
{
    return '<form action="check_information_view.php" method="post" id="payment-form" name="payment-form">
    <h2 class="text-titles"> Método de pago </h2>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="mercadoPago" id="flexRadioDefault1"
                   name="paymentOption" checked required>
            <label class="form-check-label" for="flexRadioDefault1">
                Mercado Pago (Tarjetas)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="plin" id="flexRadioDefault2"
                   name="paymentOption" required>
            <label class="form-check-label" for="flexRadioDefault2">
                Plin
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="yape" id="flexRadioDefault3"
                   name="paymentOption" required>
            <label class="form-check-label" for="flexRadioDefault3">
                Yape
            </label>
        </div>
        <h2 class="text-titles"> Tipo de entrega </h2>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="delivery" id="flexRadioDefault4" name="options"
                   checked required>
            <label class="form-check-label" for="flexRadioDefault4">
                Delivery
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="storePickup" id="flexRadioDefault5"
                   name="options" required>
            <label class="form-check-label" for="flexRadioDefault5">
                Recojo en tienda
            </label>
        </div>
</form>';
}

$content = '
<div class="container">
    <h1 class="pt-3 pb-5 text-center fw-bold">Carrito de compras</h1>
    <div class="row">
        <div class="col-lg-7">
            <div class="row">
              ' . displayProducts() . '
            </div>
        </div>
        <div class="col-lg-5">
            <div class="container payment-card">
                <div class="row pe-4 ps-4 pt-2 pb-4 ">
                    <div class="py-2">
                        ' . displayPaymentForm() . '
                    </div>
                    <div class="col d-flex justify-content-between py-3">
                        <h6 class="text-card">Delivery</h6>
                        <h6 class="text-card">S/ 2.00</h6>
                    </div>
                    <hr class="p-1">
                    <div class="col d-flex justify-content-between">
                        <h5 class="text-card-t">Total:</h5>
                        <h5 class="text-card-t text-card-t-modified">S/ ' . $cartTotal . '</h5>
                    </div>
                </div>
                <div class="row">
                      ' . displayIfAuthenticated() . '
                </div>
            </div>
        </div>
    </div>
</div>

';
displayBaseWeb($content);