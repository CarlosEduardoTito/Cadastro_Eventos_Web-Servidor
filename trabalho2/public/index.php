<?php
session_start();

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/EventoController.php';
require_once '../app/controllers/ReservaController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$auth = new AuthController();
$eventoController = new EventoController();
$reservaController = new ReservaController();

$url = $_GET['url'] ?? '';
$segments = explode('/', trim($url, '/'));

ob_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($segments[0]) {
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
        case 'editar_evento':
            $eventoController->editar($_POST['id'], $_POST);
            break;
        case 'excluir_evento':
            $eventoController->excluir($_POST['id']);
            break;
        default:
            echo "<p>Ação não encontrada.</p>";
            break;
    }
} else {
    switch ($segments[0]) {
        case 'login':
            include '../app/views/auth/Login.php';
            break;
        case 'cadastrar':
            include '../app/views/auth/Cadastrar.php';
            break;
        case 'criar_evento':
            include '../app/views/eventos/Criar.php';
            break;
        case 'eventos':
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
        case 'meus_eventos':
            include '../app/views/eventos/MeusEventos.php';
            break;
        case 'editar_evento':
            include '../app/views/eventos/Editar.php';
            break;
        default:
            if (!isset($_SESSION['usuario'])) {
                header("Location: /trabalho2/login");
                exit;
            } else {
                header("Location: /trabalho2/menu");
                exit;
            }
    }
}

$content = ob_get_clean();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <link rel="stylesheet" href="/trabalho2/public/styles.css">
</head>
<body>
<header>
        <h1>Bem-vindo</h1>
        <nav>
            <ul class="menu-left">
                <li><a href="/trabalho2/menu">Menu</a></li>
            </ul>
            <ul class="menu-right">
                <li><a href="/trabalho2/logout">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
</body>
</html>