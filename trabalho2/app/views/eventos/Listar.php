<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /trabalho2/public/login");
    exit;
}

use App\Models\Evento;
$eventos = Evento::listarTodos();
?>
<h2>Eventos</h2>
<?php if (empty($eventos)): ?>
    <p>Não há eventos cadastrados.</p>
<?php else: ?>
    <?php foreach ($eventos as $evento): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <strong><?= htmlspecialchars($evento['nome']) ?></strong><br>
            <?= htmlspecialchars($evento['descricao']) ?><br>
            Data: <?= date('d/m/Y', strtotime($evento['data'])) ?><br>
            Hora: <?= date('H:i', strtotime($evento['hora'])) ?><br>
            Local: <?= htmlspecialchars($evento['localizacao']) ?><br>
            Ingressos disponíveis: <?= $evento['ingressos_disponiveis'] ?><br>
            <a href="/trabalho2/public/reservar?id=<?= $evento['id'] ?>">Reservar</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<form action="/trabalho2/public/menu" method="GET" style="margin-top: 20px;">
    <button type="submit">Voltar para o Menu</button>
</form>