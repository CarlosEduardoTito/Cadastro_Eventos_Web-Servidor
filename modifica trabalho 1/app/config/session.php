<?php
session_start();

if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}
?>