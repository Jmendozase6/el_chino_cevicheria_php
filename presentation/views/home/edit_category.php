<?php

require_once __DIR__ . '/../../../services/cloudinary/CloudinaryService.php';
require_once '../../../data_access_objects/CategoryDAO.php';

$name = $_POST['name'];
$id = $_GET['id'];
$photo = $_FILES['image']['tmp_name'];
$cloudinary = new CloudinaryService();
$categoryDAO = new CategoryDAO();
$secureUrl = '';

if (!empty($photo)) {
    $secureUrl = $cloudinary->uploadImage($photo, 'Categories', 300, 300);
}

$categoryDAO->updateCategory($name, $secureUrl, $id);
header('Location: categories_view.php');