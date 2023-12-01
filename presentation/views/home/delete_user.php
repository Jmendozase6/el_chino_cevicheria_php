<?php
require_once '../../../data_access_objects/UserDAO.php';

$id = $_GET['id'];
$userDAO = new UserDAO();
$deleteUser = $userDAO->deleteUserById($id);
//Pag anterior
header("Location: " . $_SERVER['HTTP_REFERER']);