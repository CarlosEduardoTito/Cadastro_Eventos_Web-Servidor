<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    $_SESSION['erro'] = "Você precisa estar logado para reservar ingressos.";
    header("Location: /trabalho1/public/index.php?action=login");
    exit;
}

if (!isset($_SESSION['eventos'])) {
    $_SESSION['eventos'] = [];
}

$evento_id = $_GET['id'] ?? null;
$evento = null;

foreach ($_SESSION['eventos'] as $event) {
    if ($event['id'] == $evento_id) {
        $evento = $event;
        break;
    }
}

if (!$evento) {
    $_SESSION['erro'] = "Evento não encontrado.";
    header("Location: /trabalho1/public/index.php?action=listar_eventos");
    exit;
}
?>
<h2>Reservar Assentos para: <?= htmlspecialchars($evento['nome']) ?></h2>
<form action="/trabalho1/public/index.php?action=reservar" method="POST">
    <input type="hidden" name="evento_id" value="<?= $evento['id'] ?>">
    Quantidade: <input type="number" name="quantidade" required max="<?= $evento['ingressos_disponiveis'] ?>"><br>
    <button type="submit">Confirmar Reserva</button>
</form>