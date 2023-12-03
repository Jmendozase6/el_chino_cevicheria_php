<?php
require_once '../../../data_access_objects/CategoryDAO.php';

$id = $_GET['id'];
$categoryDAO = new CategoryDAO();
$categoryDAO->deleteCategory($id);
//Pag anterior
header("Location: " . $_SERVER['HTTP_REFERER']);