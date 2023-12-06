<?php
require_once '../../../data_access_objects/RoleDAO.php';

$id = $_GET['id'];
$roleID = $_GET['role'];
$roleDAO = new RoleDAO();
$roleDAO->changeRole($id, $roleID);
//Pag anterior
header("Location: " . $_SERVER['HTTP_REFERER']);