<?php
session_start();

require_once '../app/controllers/AuthController.php';

$auth = new AuthController();

$action = $_GET['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'login':
            $auth->login($_POST['email'], $_POST['senha']);
            break;
        case 'logout':
            $auth->logout();
            break;
        case 'cadastrar':
            $auth->cadastrar($_POST['nome'], $_POST['email'], $_POST['senha']);
            break;
        default:
            echo "Ação não encontrada.";
            break;
    }
} else {
    switch ($action) {
        case 'login':
            include '../app/views/auth/Login.php';
            break;
        case 'cadastrar':
            include '../app/views/auth/Cadastrar.php';
            break;
        case 'menu':
            include '../app/views/partials/Menu.php';
            break;
        case 'logout':
            $auth->logout();
            break;
        default:
            if (!isset($_SESSION['usuario'])) {
                header("Location: index.php?action=login");
                exit;
            } else {
                header("Location: index.php?action=menu");
                exit;
            }
    }
}
?>