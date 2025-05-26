<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../controllers/EventoController.php';
$controller = new EventoController();
$eventos = $controller->MeusEventos();
?>
<h2>Meus Eventos</h2>
<?php if (!empty($_SESSION['mensagem'])): ?>
    <p style="color:green;"><?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></p>
<?php endif; ?>
<?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>
<?php if (empty($eventos)): ?>
    <p>Você ainda não criou eventos.</p>
<?php else: ?>
    <?php foreach ($eventos as $evento): ?>
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <strong><?= htmlspecialchars($evento['nome']) ?></strong><br>
            <?= htmlspecialchars($evento['descricao']) ?><br>
            Data: <?= date('d/m/Y', strtotime($evento['data'])) ?><br>
            Hora: <?= date('H:i', strtotime($evento['hora'])) ?><br>
            Local: <?= htmlspecialchars($evento['localizacao']) ?><br>
            Ingressos disponíveis: <?= $evento['ingressos_disponiveis'] ?><br>
            <form action="/trabalho1/editar_evento" method="GET" style="display:inline;">
                <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                <button type="submit">Editar</button>
            </form>
            <form action="/trabalho1/excluir_evento" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                <button type="submit" onclick="return confirm('Tem certeza?')">Excluir</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<form action="/trabalho1/menu" method="GET" style="margin-top: 20px;">
    <button type="submit">Voltar para o Menu</button>
</form>