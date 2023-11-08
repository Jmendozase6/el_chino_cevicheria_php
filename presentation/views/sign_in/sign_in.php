<?php

include '../../../data_access_objects/UserDAO.php';

$userDAO = new UserDAO();

if ($_POST) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $currentUser = $userDAO->signIn($email, $password);
        if (isset($currentUser['id'])) {
            session_start();
            $_SESSION["id"] = $currentUser['id'];
//            header('Location: ../home/home_view.php?id=' . $currentUser['id']);
//            Go to validate_session.php
            header('Location: ../home/validate_session.php');
        } else {
            header('Location: sign_in_view.php');
        }
    } catch (Exception $e) {
        header('Location: sign_in_view.php');
    }


}
