<?php
ob_start();
error_reporting(E_ALL & ~E_DEPRECATED);

use data_transfer_objects\ProductDTO;
use data_transfer_objects\UserDTO;
use MercadoPago\Item;
use MercadoPago\Preference;

include_once '../landing/base_landing_view.php';
include_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';
include_once '../../../data_transfer_objects/UserDTO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';

if (!isset($_SESSION)) {
    session_start();
    $id = $_SESSION['id'];
}
$isAuthenticated = isset($_SESSION["id"]);
//obtener el check seleccionado mandado en el post pero si es nulo que no se rompa
$checkDelivery = $_GET['options'] ?? null;
$checkPayment = $_GET['paymentOption'] ?? null;

if ($checkDelivery == null) {
    header('Location: ../cart_new/cart_new_view.php');
    exit();
}
echo 'PAYMENT METHOD = ' . $checkPayment . '<br>';
echo 'DELIVERY METHOD = ' . $checkDelivery . '<br>';

if ($isAuthenticated) {
    $userDAO = new UserDAO();
    $currentUser = $userDAO->getUserById($_SESSION["id"]);
    $currentUserDTO = UserDTO::createFromResponse($currentUser);
} else {
    header('Location: ../sign_in/sign_in_view.php');
    exit();
}

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

if ($cartTotal == 0) {
    header('Location: ../empty_cart/empty_cart_view.php');
    exit();
}

if ($checkDelivery == 'delivery') {
    $cartTotal += 2;
}

if (sizeof($responseProductsFromCart) > 0) {
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
//    "success" => $_SERVER['HTTP_HOST'] . "/../presentation/views/cart_client/create_order.php",
        "success" => $_SERVER['HTTP_HOST'] . "/../presentation/views/cart_client/create_order.php",
        "failure" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "/../error/error_view.php",
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

function displayByPaymentMethod()
{
    global $checkPayment;
    if ($checkPayment == 'mercadoPago') {
        return displayIfAuthenticatedPayment();
    } else if ($checkPayment == 'yape') {
        return '<div class="col-auto checkout-btn d-flex justify-content-center align-items-center">
                    <img src="../../resources/images/YAPE-QR.jpg" alt="Yape" class="img-yape">
                </div>';
    } else if ($checkPayment == 'plin') {
        return '<div class="col-auto checkout-btn d-flex justify-content-center align-items-center">
                    <img src="../../resources/images/PLIN-QR.png" alt="Plin" class="img-plin">
                </div>';
    } else {
        return '';
    }
}

function displayIfAuthenticatedPayment(): string
{
    global $isAuthenticated, $preference;
    if ($isAuthenticated) {
        $javascriptCode = '
    <script type = "text/javascript" >
            const id = new MercadoPago("' . MERCADO_PAGO_TEST_PUBLIC_KEY . '", {
        locale:"es-PE"
            })
            id.checkout({
                preference: {
                    id: "' . $preference->id . '"
                },
                render: {
        container:
                ".checkout-btn",
                    label: "Pagar con MercadoPago",
                }
            });
        </script>
    ';
        $content = '<div class="col-auto checkout-btn d-flex justify-content-center align-items-center"></div >' . $javascriptCode;
    }

    return $content;
}

function displayIfDelivery(): string
{
    global $checkDelivery;
    return $checkDelivery == 'delivery' ? '<div class="col d-flex justify-content-between pt-3">
                  <h6 class="text-card"> Delivery</h6 >
                  <h6 class="text-card"> S / 2.00</h6 >
                </div >
                <hr class="p-1" > ' : '';
}

function displayDistrict(): string
{
    global $checkDelivery;
    if ($checkDelivery !== 'delivery') {
        return '';
    }
    return '<label for="txt-district" class="label-content label-district w-100" > Distrito
                            <select class="form-select txt-user-data mb-2" id = "txt-district" name = "txt-district">
                                <option value = "1" > Vichayal - S / 2.00</option >
                                <option value = "2" selected > Querecotillo - S / 2.00</option >
                            </select >
                        </label>';
}

$content = '
    <div class="container wrapper-check-information">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-7 d-flex justify-content-center align-items-center container-user-data" >
            <div class="d-flex flex-column align-items-center w-100">
                <h1 class="text-check-information py-3" > Comprobar información </h1 >
                <div class="input-fields w-100" >
                    <form action="" method="get">
                        <div class="name-user" >
                            <label for="txt-name" class="label-content label-name w-100" > Nombres
                                <input type = "text" name = "txt-name" id = "txt-name"
                                       class="txt-user-data border-content"
                                       placeholder = "Nombres"
                                       value = "' . $currentUserDTO->getName() . '"
                                       required >
                            </label >
                            <label for="txt-last-name" class="label-content w-100" > Apellidos
                                <input type ="text" name = "txt-last-name" id = "txt-last-name"
                                       class="txt-last-name txt-user-data border-content"
                                       placeholder = "Apellidos"
                                       value = "' . $currentUserDTO->getLastName() . '"
                                       required >
                            </label >
                        </div >
                        <div class="info-text flex-column">
                            <label for="txt-address" class="label-content" > Dirección</label >
                            <input type = "text" name="txt-address" id ="txt-address" class="txt-user-data border-content"
                                   placeholder = "Dirección"
                                   value = "' . $currentUserDTO->getAddress() . '"
                                    required >
                        </div >
                        <div class="info-text" >
                        ' . displayDistrict() . '
                            <label for="txt-phone" class="label-content w-100" > Teléfono
                                <input type = "text" name = "txt-phone" id = "txt-phone" class="txt-user-data border-content"
                                       placeholder = "Teléfono"
                                       value = "' . $currentUserDTO->getPhone() . '"
                                       required >
                            </label >
                        </div >
                        <hr class="m-1" >
                        <h2 class="text-titles" > Comentarios</h2 >
                        <label for="txt-message" class="label-content-comment p-0 pb-1" > (Opcional)</label >
                        <textarea name = "txt-message" id = "txt-message" class="textarea border-content txt-user-data"
                                  placeholder = "Puedes colocar una referencia, te llamaremos de igual forma."
                                  required ></textarea >
                    </form>
                </div >
            </div >
        </div >
        <div class="col-sm-12 col-md-12 col-lg-5" >
            <div class="container payment-card-check" >
                <div class="row p-3 pt-4" >
                    <div class="col" >
                    ' . displayIfDelivery() . '
                        <div class="col d-flex justify-content-between mb-3" >
                            <h5 class="text-card-t" > Total</h5 >
                            <h5 class="text-card-t text-card-t-modified" > S / ' . $cartTotal . '</h5 >
                        </div >
                    ' . displayByPaymentMethod() . '
                    </div >
                </div >
            </div >
        </div >
    </div >
</div >
    ';
displayBaseWeb($content);
?>
