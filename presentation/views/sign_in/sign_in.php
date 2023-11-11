<?php

include '../../../data_access_objects/UserDAO.php';

session_start();
$userDAO = new UserDAO();

//if ($_POST) {
//
//    $email = $_POST['email'];
//    $password = $_POST['password'];
//    $currentUser = $userDAO->signIn($email, $password);
//
//    if (isset($currentUser['id'])) {
//        $_SESSION["id"] = $currentUser['id'];
//        // SUPONGAMOS QUE ES ADMIN SIEMPRE
//        echo 'BIENVENIDO ADMIN';
//        header('Location: ../home/home_view.php');
//    } else {
//        echo 'ERROR K NO TE SABES TU CLAVE PAPU?';
////        header('Location: sign_in_view.php');
//    }
//
//}

if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $currentUser = $userDAO->signIn($email, $password);
        if (isset($currentUser['id'])) {
            $_SESSION["id"] = $currentUser['id'];
            header('Location: ../home/home_view.php?id=' . $_SESSION["id"]);
        } else {
            echo 'ERROR K NO TE SABES TU CLAVE PAPU?';
            header('Location: sign_in_view.php');
        }
    } catch (Exception $e) {
        echo 'ERROR DE LA DB PAPOI';
        header('Location: sign_in_view.php');
    }
}
