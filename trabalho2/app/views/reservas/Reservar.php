<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: /trabalho2/public/login");
    exit;
}
use App\Models\Evento;
$evento_id = $_GET['id'] ?? null;
$evento = $evento_id ? Evento::buscarPorId($evento_id) : null;
if (!$evento) {
    $_SESSION['erro'] = "Evento não encontrado.";
    header("Location: /trabalho2/public/eventos");
    exit;
}
?>
<h2>Reservar para: <?= htmlspecialchars($evento['nome']) ?></h2>
<form action="/trabalho2/public/reservar" method="POST">
    <input type="hidden" name="evento_id" value="<?= $evento['id'] ?>">
    Quantidade: <input type="number" name="quantidade" min="1" max="<?= $evento['ingressos_disponiveis'] ?>" required>
    <button type="submit">Reservar</button>
</form>