<?php
session_start();

if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}

if (!isset($_SESSION['eventos'])) {
    $_SESSION['eventos'] = [];
}

if (!isset($_SESSION['reservas'])) {
    $_SESSION['reservas'] = [];
}
?>
