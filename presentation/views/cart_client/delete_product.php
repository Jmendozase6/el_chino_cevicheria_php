<?php

require_once '../../../data_access_objects/ProductDAO.php';
require_once '../../../data_access_objects/CartDAO.php';

$idProduct = $_GET['id'];
$cartDAO = new CartDAO();
$cartDAO->deleteProductFromCart($idProduct);
//echo '<script>
//          setTimeout(function(){
//              history.go(-1);
//          }, 0);
//      </script>';
header("Location: " . $_SERVER['HTTP_REFERER']);