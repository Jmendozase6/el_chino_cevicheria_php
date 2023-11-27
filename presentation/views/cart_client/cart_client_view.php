<?php
ob_start();
session_start();
error_reporting(E_ALL & ~E_DEPRECATED);

use data_transfer_objects\ProductDTO;
use MercadoPago\Item;
use MercadoPago\Preference;

require_once '../../../data_access_objects/CartDAO.php';
require_once '../../../data_access_objects/ProductDAO.php';

require_once '../../../data_transfer_objects/ProductDTO.php';

$cartDAO = new CartDAO();
$responseProductsFromCart = $cartDAO->getProductsFromCart();
$total = 0;
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
        $total += ($productsFromCartDTO[$i]->getPrice() * $responseProductsFromCart[$i]['quantity']);
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
        die("Error: " . $e->getMessage());
    }
    ob_end_flush();
}
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../styles/cart-client-style.css">
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <title>Carrito de Compras</title>
</head>
<body>

<div class="container d-flex flex-column justify-content-center align-content-center w-50 py-1 mb-3"
     style="background: #F6F6F6">
  <div class="row">
    <div class="col m-3">
      <a class="d-flex align-items-center h-100 text-decoration-none text-black col-2"
         href="../catalog_client/catalog_client_view.php"><- Atrás </a>
    </div>
      <?php if ($isAuthenticated) { ?>
        <div class="col-auto d-flex flex-column justify-content-center">
          <div class="row">
            <a href="../components/logout.php"><i class="bi bi-box-arrow-right"></i></a>
          </div>
        </div>
      <?php } ?>
  </div>
</div>

<!-- Si el carrito está vacío, muestra esta sección -->
<?php if (sizeof($responseProductsFromCart) == 0) { ?>
  <div class="container mt-5">
    <div class="d-flex justify-content-center align-items-center">
      <div class="text-center">
        <strong style="font-size: 2rem">Carrito de compras</strong> <br> <br>
        <img src="../../resources/images/empty.png" alt="Carrito Vacío"> <br> <br>
        <span>No hay productos agregados</span>
      </div>
    </div>
  </div>
<?php } else { ?>
  <!--  Si el carrito tiene productos, muestra esto-->
    <?php for ($i = 0; $i < sizeof($productsFromCartDTO); $i++) { ?>
    <!--    Lista de Productos    -->
    <div class="container d-flex flex-column justify-content-center align-content-center w-50 py-1">
      <div class="row py-1 justify-content-between">
        <div class="col-auto">
          <img src="<?= $productsFromCartDTO[$i]->getImage() ?>" alt="Producto" class="img-fluid rounded-3"
               style="height: 90px">
        </div>
        <div class="col">
          <strong><?= $productsFromCartDTO[$i]->getName() ?></strong>
          <p class="text-info-emphasis"><?= $productsFromCartDTO[$i]->getDescription() ?></p>
          <p class="text-secondary"><?= 'S/. ' . $productsFromCartDTO[$i]->getPrice() ?></p>
        </div>
        <div class="col-3 text-end">
          <strong class="align-middle m-2 fs-5"
                  id="quantity"><?= $responseProductsFromCart[$i]['quantity'] ?></strong>
          <a id="btn-increase" class="btn btn-success"
             href="change_quantity.php?id=<?= $productsFromCartDTO[$i]->getId() ?>&quantity=<?= $responseProductsFromCart[$i]['quantity'] ?>&type=D">
            <i class="bi bi-plus-lg"></i>
          </a>
          <a id="btn-decrease" class="btn btn-warning"
             href="change_quantity.php?id=<?= $productsFromCartDTO[$i]->getId() ?>&quantity=<?= $responseProductsFromCart[$i]['quantity'] ?>&type=I">
            <i class="bi bi-dash-lg"></i>
          </a>
          <a id="btn-delete" class="btn btn-danger"
             href="delete_product.php?id=<?= $productsFromCartDTO[$i]->getId() ?>">
            <i class="bi bi-trash3-fill"></i>
          </a>
        </div>
      </div>
      <hr class="border-top border-dark"/>
    </div>
    <?php } ?>
<?php } ?>
<!--  Botón de Pagar  -->
<?php if (sizeof($productsFromCartDTO) > 0) { ?>
  <div class="container d-flex flex-column justify-content-center align-content-center w-50">
    <div class="row py-1 justify-content-between">
      <div class="col-auto">
        <strong>Total</strong>
      </div>
      <div class="col-3 text-end">
        <strong>S/. <?= $total ?></strong>
      </div>
    </div>
    <div class="row py-1 justify-content-between">

      <!--    Botón de Pagos    -->
        <?php if ($isAuthenticated) { ?>
          <div class="col-auto checkout-btn"></div>
        <?php } else { ?>
          <button type="button" class="btn btn-success" data-bs-toggle="modal"
                  data-bs-target="#sign-in-modal">
            Para poder pagar, inicia sesión
          </button>

            <?php include_once '../sign_in/sign_in_view_modal.php'; ?>
        <?php } ?>

      <!--      <script>-->
      <!--          const mp = new MercadoPago("TEST-ac3fb947-48d2-4b8f-9ad8-ea130a6d8ba3", {-->
      <!--              locale: "es-PE"-->
      <!--          });-->
      <!--          // bg color: #F6F6F6-->
      <!--          mp.checkout({-->
      <!--              preference: {-->
      <!--                  id: '--><?php //= $preference->id; ?>//'
      // },
      // render: {
      // container: ".checkout-btn",
      // label: "Pagar con MP"
      // }
      // })
      //      </script>

    </div>
  </div>
<?php } ?>
</body>
</html>
