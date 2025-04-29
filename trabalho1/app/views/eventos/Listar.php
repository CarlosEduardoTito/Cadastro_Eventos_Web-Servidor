<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /trabalho1/public/index.php?action=login");
    exit;
}

$eventos = $_SESSION['eventos'] ?? [];
?>
<h2>Eventos</h2>
<?php foreach ($eventos as $evento): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <strong>Nome:</strong> <?= htmlspecialchars($evento['nome']) ?><br>
        <strong>Descrição:</strong> <?= htmlspecialchars($evento['descricao']) ?><br>
        <strong>Data:</strong> <?= date('d/m/Y', strtotime($evento['data'])) ?><br>
        <strong>Hora:</strong> <?= date('H:i', strtotime($evento['hora'])) ?><br>
        <strong>Localização:</strong> <?= htmlspecialchars($evento['localizacao']) ?><br>
        <strong>Ingressos disponíveis:</strong> <?= isset($evento['ingressos_disponiveis']) ? $evento['ingressos_disponiveis'] : 'N/A' ?><br>
        <a href="/trabalho1/public/index.php?action=reservar&id=<?= $evento['id'] ?>">Reservar</a>
    </div>
<?php endforeach; ?>


<form action="/trabalho1/public/index.php" method="GET" style="margin-top: 20px;">
    <input type="hidden" name="action" value="menu">
    <button type="submit">Voltar para o Menu</button>
</form>