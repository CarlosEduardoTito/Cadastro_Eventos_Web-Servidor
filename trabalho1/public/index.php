<?php
session_start();

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/EventoController.php';
require_once '../app/controllers/ReservaController.php';

$auth = new AuthController();
$eventoController = new EventoController();
$reservaController = new ReservaController();

$action = $_GET['action'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Aplicação</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1>Bem-vindo</h1>
        <nav>
            <ul class="menu-left">
                <li><a href="index.php?action=menu">Menu</a></li>
            </ul>
            <ul class="menu-right">
                <li><a href="index.php?action=logout">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
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
                case 'criar_evento':
                    $eventoController->criar($_POST);
                    break;
                case 'reservar':
                    $reservaController->reservar($_SESSION['usuario']['id'], $_POST['evento_id'], $_POST['quantidade']);
                    break;
                case 'cancelar_reserva':
                    $reservaController->cancelar($_POST['reserva_id']);
                    break;
                default:
                    echo "<p>Ação não encontrada.</p>";
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
                case 'criar_evento':
                    include '../app/views/eventos/Criar.php';
                    break;
                case 'listar_eventos':
                    include '../app/views/eventos/Listar.php';
                    break;
                case 'reservar':
                    include '../app/views/reservas/Reservar.php';
                    break;
                case 'minhas_reservas':
                    include '../app/views/reservas/MinhasReservas.php';
                    break;
                case 'menu':
                    include '../app/views/partial/Menu.php';
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
    </main>
</body>
</html>
    </footer>
</body>
</html>
