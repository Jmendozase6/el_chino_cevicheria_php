<?php
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    header('Location: ../home/home_view.php?id=' . $id);
} else {
    header('Location: ../sign_in/sign_in_view.php');
}