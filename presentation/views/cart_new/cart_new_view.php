<?php
ob_start();
session_start();
error_reporting(E_ALL & ~E_DEPRECATED);

include '../landing/base_landing_view.php';

use data_transfer_objects\ProductDTO;
use MercadoPago\Item;
use MercadoPago\Preference;

require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/ProductDTO.php';

$cartDAO = new CartDAO();
$responseProductsFromCart = $cartDAO->getProductsFromCart();
$cartTotal = $cartDAO->getTotalFromCart(session_id());
$productsFromCartDTO = [];
$isAuthenticated = false;

foreach ($responseProductsFromCart as $productFromCart) {
    $productDAO = new ProductDAO();
    $product = $productDAO->getProductById($productFromCart['id']);
    $productDTO = ProductDTO::createFromResponse($product);
    $productsFromCartDTO[] = $productDTO;
}

if (isset($_SESSION["id"])) {
    $isAuthenticated = true;
}

if (sizeof($productsFromCartDTO) > 0) {
    require_once __DIR__ . '/../../../vendor/autoload.php';
    include_once __DIR__ . '/../../../datasource/constants.php';

    MercadoPago\SDK::setAccessToken(MERCADO_PAGO_ACCESS_TOKEN);

    $preference = new Preference();
    $productsDTO = [];

    for ($i = 0; $i < sizeof($productsFromCartDTO); $i++) {
        $item = new Item();
        $item->id = $productsFromCartDTO[$i]->getId();
        $item->title = $productsFromCartDTO[$i]->getName();
        $item->quantity = $responseProductsFromCart[$i]['quantity'];
        $item->unit_price = $productsFromCartDTO[$i]->getPrice();
        $item->currency_id = 'PEN';
        $productsDTO[$i] = $item;
    }

    $preference->items = $productsDTO;

    $preference->back_urls = array(
        "success" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "/../success_payment_view.php",
        "failure" => "/../error/error_view.php",
        "pending" => "http://localhost:8080/checkout/pending"
    );

    $preference->auto_return = "approved";
    $preference->binary_mode = true;

    try {
        $preference->save();
    } catch (Exception $e) {
        echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }

    ob_end_flush();
}

if (sizeof($productsFromCartDTO) == 0) {
    header('Location: ../empty_cart/empty_cart_view.php');
    exit();
}

//mobile
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
            <div class="col-4 d-flex flex-column justify-content-start gap-2 p-0">
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
        <hr >
        ';
    }
    return $content;
}

function displayIcon($quantity): string
{
    return $quantity == 1 ? '<i class="bi bi-trash text-danger"></i > ' : '<i class="bi bi-dash"></i>';
}

function displayIfAuthenticated($id): string
{
    global $isAuthenticated, $preference;
    if ($isAuthenticated) {
        $javascriptCode = '
        <script type="text/javascript">
            console.log("SI ENTRA");
            const $id = new MercadoPago("TEST-ac3fb947-48d2-4b8f-9ad8-ea130a6d8ba3", {
                locale: "es-PE"
            });
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


$content = '
<!--mobile-->
<div class="wrapper-cart">
    <div class="container">
        <div class="row">
            <h1 class="pt-3 pb-5 text-center fw-bold cart-title"> Carrito de compras </h1>
            ' . displayProducts() . '
        </div>
    </div>
</div>
<div class="wrapper-payment-card">
    <div class="container payment-card">
        <div class="row p-4">
            <div class="py-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="delivery" id="flexRadioDefault1" name="options"
                           checked required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Delivery
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="storePickup" id="flexRadioDefault2"
                           name="options" required>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Recojo en tienda
                    </label>
                </div>
            </div>
            <div class="col d-flex justify-content-between py-3">
                <h6 class="text-card"> Delivery</h6>
                <h6 class="text-card"> S / 2.00</h6>
            </div>
            <hr class="p-1">
            <div class="col d-flex justify-content-between">
                <h5 class="text-card-t"> Total</h5>
                <h5 class="text-card-t text-card-t-modified"> S / ' . $cartTotal . '</h5>
            </div>
        </div>
    </div>
</div>

<!--desktop-->
<div class="wrapper-cart-desktop" >
  <h1 class="pt-3 pb-5 text-center fw-bold" > Carrito de compras </h1 >
  <div class="container" >
    <div class="row" >
      <div class="col-lg-7" >
        <div class="row">
            ' . displayProducts() . '
        </div >
      </div >
      <div class="col-lg-5" >
        <div class="container payment-card" >
          <div class="row p-4" >
  <div class="py-2">
             <div class="form-check">
                <input class="form-check-input" type="radio" value="delivery" id="flexRadioDefault1" name="options" checked required>
                <label class="form-check-label" for="flexRadioDefault1">
                    Delivery
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="storePickup" id="flexRadioDefault2" name="options" required>
                <label class="form-check-label" for="flexRadioDefault2">
                    Recojo en tienda
                </label>
            </div>
            </div>
            <div class="col d-flex justify-content-between py-3" >
              <h6 class="text-card" > Delivery</h6 >
              <h6 class="text-card" > S / 2.00</h6 >
            </div >
            <hr class="p-1" >
            <div class="col d-flex justify-content-between" >
              <h5 class="text-card-t" > Total:</h5 >
              <h5 class="text-card-t text-card-t-modified" > S / ' . $cartTotal . '</h5 >
            </div >
          </div >
          <div class=" pb-4 d-flex justify-content-center" >
            ' . displayIfAuthenticated("mpBtnDesktop") . '
          </div >
        </div >
      </div >
    </div >
  </div >
</div >
';
displayBaseWeb($content);

?>
