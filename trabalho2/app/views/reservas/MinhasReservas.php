<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    $_SESSION['erro'] = "Você precisa estar logado para acessar esta página.";
    header("Location: /trabalho2/public/index.php?url=login");
    exit;
}

$reservaController = new \App\Controllers\ReservaController();
$reservas = $reservaController->minhasReservas($_SESSION['usuario']['id']);
?>

<?php if (!empty($_SESSION['mensagem'])): ?>
    <p style="color:green;"><?= $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></p>
<?php endif; ?>

<h2>Minhas Reservas</h2>
<?php if (empty($reservas)): ?>
    <p>Você ainda não fez nenhuma reserva.</p>
<?php else: ?>
    <?php foreach ($reservas as $reserva): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <strong>Evento:</strong> <?= htmlspecialchars($reserva['evento']) ?><br>
            <strong>Data:</strong> <?= date('d/m/Y', strtotime($reserva['data'])) ?><br> 
            <strong>Hora:</strong> <?= htmlspecialchars($reserva['hora']) ?><br>
            <strong>Ingressos Reservados:</strong> <?= htmlspecialchars($reserva['ingressos_reservados']) ?><br>
            <form action="/trabalho2/cancelar_reserva" method="POST" style="margin-top: 10px;">
                <input type="hidden" name="reserva_id" value="<?= $reserva['id'] ?>">
                <button type="submit" style="color: red;">Cancelar Reserva</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<form action="/trabalho2/menu" method="GET" style="margin-top: 20px;">
    <button type="submit">Voltar para o Menu</button>
</form>