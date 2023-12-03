<?php

require_once __DIR__ . '/../../../services/cloudinary/CloudinaryService.php';
require_once '../../../data_access_objects/ProductDAO.php';

$idCategory = $_POST['id_category'];
$name = $_POST['name'];
$description = $_POST['description'];
$photo = $_FILES['image']['tmp_name'];
$price = $_POST['price'];
$discount = $_POST['discount'];

$cloudinary = new CloudinaryService();
$productDAO = new ProductDAO();
$secureUrl = '';

if (!empty($photo)) {
    $secureUrl = $cloudinary->uploadImage($photo, 'Products', 500, 500);
} else {
    $secureUrl = "../../resources/images/no_image.jpg";
}

//$categoryDAO->createCategory($name, $secureUrl);
$productDAO->createProduct($idCategory, $name, $description, $secureUrl, $price, $discount);
header('Location: products_admin_view.php');