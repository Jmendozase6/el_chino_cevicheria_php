<?php
include '../landing/base_landing_view.php';
$products = [
  [
    'name' => 'CEVICHE MIXTO',
    'description' => 'FUENTE',
    'price' => '23',
    'image' => '../../resources/images/about_us_02.png',
  ],
  [
    'name' => 'CEVICHE MIXTO 2',
    'description' => 'PERSONAL',
    'price' => '34',
    'image' => '../../resources/images/bg-test.jpg',
  ],
  [
    'name' => 'CEVICHE MIXTO 3',
    'description' => 'FUENTE',
    'price' => '43',
    'image' => '../../resources/images/image_product.png',
  ],
];


//mobile
function displayProducts($products): string
{
  $content = '';
  foreach ($products as $product) {
    $content .= '
     <div class="col-4 d-flex justify-content-center align-content-center ">
                <img class="mb-2 rounded-1 img-product" src="' . $product['image'] . '" alt="Producto">
     </div>
            <div class="col-4 d-flex flex-column justify-content-start p-0">
               <h6 class="name-product">' . $product['name'] . '</h6>
                <h6 class="name-type">' . $product['description'] . '</h6>
                <h6 class="name-price">S/.' . $product['price'] . '</h6>
            </div>
            <div class="col-4 p-0 d-flex align-items-center">
                <div class="content-btn d-flex">
                    <button class="btn text-black btn-sm p-1">-</button>
                    <p class="m-0 p-2">1</p>
                    <button class="btn text-black btn-sm p-1">+</button>
                </div>
            </div>
            <hr>
    ';
  }
  return $content;
}

//desktop
function displayProductsD($products): string
{
  $content = '';
  foreach ($products as $product) {
    $content .= '
     <div class="col-4 d-flex justify-content-center align-content-center">
                <img class="mb-2 rounded-1 img-product" src="' . $product['image'] . '" alt="Producto">
     </div>
            <div class="col-4 d-flex flex-column justify-content-start gap-1 p-0">
               <h6 class="name-product">' . $product['name'] . '</h6>
                <h6 class="name-type">' . $product['description'] . '</h6>
                <h6 class="name-price">S/.' . $product['price'] . '</h6>
            </div>
            <div class="col-4 p-0 d-flex align-items-center">
                <div class="content-btn d-flex">
                    <button class="btn text-black btn-sm p-1">-</button>
                    <p class="m-0 p-2">1</p>
                    <button class="btn text-black btn-sm p-1">+</button>
                </div>
            </div>
            <hr>
    ';
  }
  return $content;
}


$content = '
<!--mobile-->
<div class="wrapper-cart">
    <div class="container">
        <div class="row">
            <h1 class="pt-3 pb-5 text-center fw-bold cart-title">Carrito de compras</h1>
            ' . displayProducts($products) . '
        </div>
    </div>
</div>
<div class="wrapper-payment-card">
    <div class="container payment-card">
        <div class="row p-4">
            <div class="col d-flex justify-content-between py-3">
                <h6 class="text-card">Delivery</h6>
                <h6 class="text-card">S/ 2.00</h6>
            </div>
            <hr class="p-1">
            <div class="col d-flex justify-content-between">
                <h5 class="text-card-t">Total</h5>
                <h5 class="text-card-t text-card-t-modified">S/ 71.00</h5>
            </div>
        </div>
        <div class="pb-4 d-flex justify-content-center">
            <button class="btn">Proceder con el pago</button>
        </div>
    </div>
</div>
<!--desktop-->
<div class="wrapper-cart-desktop">
    <h1 class="pt-3 pb-5 text-center fw-bold">Carrito de compras</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    ' . displayProductsD($products) . '
                </div>
            </div>
            <div class="col-lg-5">
                <div class="container payment-card">
                    <div class="row p-4">
                        <div class="col d-flex justify-content-between py-3">
                            <h6 class="text-card">Delivery</h6>
                            <h6 class="text-card">S/ 2.00</h6>

                        </div>
                        <hr class="p-1">
                        <div class="col d-flex justify-content-between">
                            <h5 class="text-card-t">Total:</h5>
                            <h5 class="text-card-t text-card-t-modified">S/ 71.00</h5>
                        </div>
                    </div>
                    <div class=" pb-4 d-flex justify-content-center">
                        <button class="btn">Proceder con el pago</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

';
displayBaseWeb($content);

?>
