<?php
ob_start();
error_reporting(E_ALL & ~E_DEPRECATED);

use data_transfer_objects\ProductDTO;
use data_transfer_objects\UserDTO;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;

include_once '../landing/base_landing_view.php';
require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_transfer_objects/ProductDTO.php';
require_once '../../../data_access_objects/UserDAO.php';
require_once '../../../data_transfer_objects/UserDTO.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isAuthenticated = isset($_SESSION["id"]);

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


if (sizeof($responseProductsFromCart) > 0) {
    require_once __DIR__ . '/../../../vendor/autoload.php';
    include_once __DIR__ . '/../../../datasource/constants.php';

    try {
        MercadoPago\SDK::setAccessToken(MERCADO_PAGO_ACCESS_TOKEN);
//        MercadoPago\SDK::setPublicKey(MERCADO_PAGO_PROD_PUBLIC_KEY);
//        MercadoPago\SDK::setClientId(MERCADO_PAGO_PROD_CLIENT_ID);
//        MercadoPago\SDK::setClientSecret(MERCADO_PAGO_CLIENT_SECRET);

        $preference = new Preference();
        $payer = new Payer();
        $productsDTO = [];

        for ($i = 0; $i < sizeof($productsFromCartDTO); $i++) {
            $item = new Item();
            $item->id = $productsFromCartDTO[$i]->getId();
            $item->title = $productsFromCartDTO[$i]->getName();
            $item->description = $productsFromCartDTO[$i]->getDescription();
            $item->category_id = $productsFromCartDTO[$i]->getIdCategory();
            $item->quantity = $responseProductsFromCart[$i]['quantity'];
            $item->unit_price = $productsFromCartDTO[$i]->getPrice();
            $item->currency_id = 'PEN';
            $item->picture_url = $productsFromCartDTO[$i]->getImage();
            $productsDTO[$i] = $item;
        }

        $delivery = $_SESSION['check-delivery'] ?? '';

        if ($delivery == 'delivery') {
            $cartTotal += 2;
            $productsDTO[sizeof($productsDTO)] = [
                "id" => "delivery",
                "title" => "Delivery",
                "quantity" => 1,
                "unit_price" => 2,
                "currency_id" => "PEN"];
        }

        $preference->payment_methods = array(
            "installments" => 1
        );

        $preference->items = $productsDTO;

        $payer->name = $currentUserDTO->getName();
        $payer->surname = $currentUserDTO->getLastName();
        $payer->email = $currentUserDTO->getEmail();
        $payer->phone = array(
            "area_code" => "51",
            "number" => $currentUserDTO->getPhone()
        );
        $preference->payer = $payer;

        $preference->back_urls = array(
//    "success" => $_SERVER['HTTP_HOST'] . "/../presentation/views/cart_client/create_order.php",
            "success" => $_SERVER['HTTP_HOST'] . "/../el_chino_cevicheria/presentation/views/cart_client/create_order.php",
            "failure" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "/../error/error_view.php",
        );

        $preference->auto_return = "approved";
        $preference->binary_mode = true;

        $preference->save();
    } catch (Exception $e) {
        echo 'Excepción capturada: ', $e->getMessage(), "\n";
    }

    ob_end_flush();
}

function displayIfDeliveryTextMount(): string
{
    global $delivery;
    if ($delivery == 'delivery') {
        $content = '<p class="card-title fw-medium"><strong>Delivery: </strong> S./ 2</p>';
    } else {
        $content = '';
    }
    return $content;
}

function displayIfDeliveryText(): string
{
    global $delivery;
    if ($delivery == 'delivery') {
        $content = '
          <p class="card-title fw-medium"><strong>Dirección: </strong>' . $_SESSION['txt-address'] . '</p>
          <p class="card-title fw-medium"><strong>¿Delívery?: </strong>' . $_SESSION['txt-district'] . '</p>';
    } else {
        $content = '';
    }
    return $content;
}

function displayIfMessage(): string
{
    if ($_SESSION['txt-message'] != '') {
        $content = '<p class="card-title fw-medium"><strong>Mensaje: </strong>' . $_SESSION['txt-message'] . '</p>';
    } else {
        $content = '';
    }
    return $content;
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
                },
            });
        </script>
    ';
        $content = '<div class="checkout-btn p-0"></div >' . $javascriptCode;
    }

    return $content;
}

function generatePaymentMethodHTML($method, $image, $alt): string
{
    return '<div class="checkout-btn p-0">
                <button type="button" class="btn mt-0" data-bs-toggle="modal" data-bs-target="#' . ucfirst($method) . '">
                    ' . ucfirst($method) . ' QR
                </button>
                <div class="modal fade" id="' . ucfirst($method) . '" tabindex="-1" aria-labelledby="' . ucfirst($method) . '" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img src="../../resources/images/' . strtoupper($image) . '" alt="' . ucfirst($alt) . '" class="img-' . strtolower($method) . ' w-100">
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                <a type="button" class="btn m-0" href="../cart_client/create_order.php">Confirmar pago</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
}

function displayByPaymentMethod(): string
{
    $checkPayment = $_SESSION['check-payment'] ?? '';
    if ($checkPayment == 'mercadoPago') {
        return displayIfAuthenticatedPayment();
    }

    $paymentMethods = ['yape', 'plin'];

    if (in_array($checkPayment, $paymentMethods)) {
        $image = $checkPayment == 'yape' ? 'YAPE-QR.jpg' : 'PLIN-QR.png';
        $alt = ucfirst($checkPayment);
        return generatePaymentMethodHTML($checkPayment, $image, $alt);
    }

    return '';
}

$content = '
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-sm-12 col-md-8 col-lg-6">
      <div class="card mt-3">
        <div class="card-body">
          <h5 class="card-title mb-3 fw-bold fs-3">Datos del Pedido</h5>
          <div class="row">
            <div class="col-6 p-0">
              <p class="card-title fw-medium"><strong>Nombres: </strong>' . $_SESSION['txt-name'] . '</p>
              <p class="card-title fw-medium"><strong>Apellidos: </strong>' . $_SESSION['txt-last-name'] . '</p>
              <p class="card-title fw-medium"><strong>Teléfono: </strong>' . $_SESSION['txt-phone'] . '</p>
              ' . displayIfDeliveryText() . '
              ' . displayIfMessage() . '
            </div>
            <div class="col-6">
              ' . displayIfDeliveryTextMount() . '
              <p class="card-title fw-medium"><strong>Total: </strong>S/.' . $cartTotal . '</p>
            </div>
          </div>
        <div class="card-body p-0">
        <hr>
          <h5 class="card-title mb-3 fw-bold fs-3">Pago</h5>
            <div class="row">
              ' . displayByPaymentMethod() . '
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
';

displayBaseWeb($content);