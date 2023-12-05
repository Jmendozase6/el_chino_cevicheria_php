<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
unset($_SESSION['errorMessageContactUs']);
unset($_SESSION['successMessageContactUs']);

unset($_SESSION['errorMessageComplaintsBook']);
unset($_SESSION['successMessageComplaintsBook']);