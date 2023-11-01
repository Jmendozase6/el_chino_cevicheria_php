<?php

include '../../../data_access_objects/UserDAO.php';

$userDAO = new UserDAO();

if ($_POST) {

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $currentUser = $userDAO->signIn($email, $password);
            if (isset($currentUser['id'])) {
                header('Location: ../home/home_view.php?id=' . $currentUser['id']);
            }
        } catch (Exception $e) {
            echo '<script>history.go(-1);</script>';
        }

    }
}
