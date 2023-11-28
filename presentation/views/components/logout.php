<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();

header("Location: ../initial_client/initial_client_view.php");
exit();

