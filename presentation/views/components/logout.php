<?php
session_start();
session_destroy();
header("Location: ../home_client/home_client_view.php");
exit();

