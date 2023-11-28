<?php

require_once __DIR__ . '/../../../services/cloudinary/CloudinaryService.php';
require_once '../../../data_access_objects/CategoryDAO.php';

$name = $_POST['name'];
$photo = $_FILES['image']['tmp_name'];

$cloudinary = new CloudinaryService();
$categoryDAO = new CategoryDAO();
$secureUrl = '';

if (!empty($photo)) {
    $secureUrl = $cloudinary->uploadImage($photo, 'Categories', 200, 200);
} else {
    $secureUrl = "../../resources/images/no_image.jpg";
}

$categoryDAO->createCategory($name, $secureUrl);
header('Location: categories_view.php');