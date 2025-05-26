<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../models/Evento.php';
$id = $_GET['id'] ?? null;
$evento = $id ? Evento::buscarPorId($id) : null;
if (!$evento || $evento['usuario_id'] != $_SESSION['usuario']['id']) {
    $_SESSION['erro'] = "Evento não encontrado ou não autorizado.";
    header("Location: /trabalho1/meus_eventos");
    exit;
}
?>
<h2 class="form-title">Editar Evento</h2>
<form action="/trabalho1/editar_evento" method="POST" class="form-container">
    <input type="hidden" name="id" value="<?= $evento['id'] ?>">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($evento['nome']) ?>" required class="form-input"><br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" class="form-input"><?= htmlspecialchars($evento['descricao']) ?></textarea><br>
    <label for="data">Data:</label>
    <input type="date" id="data" name="data" value="<?= $evento['data'] ?>" required class="form-input"><br>
    <label for="hora">Hora:</label>
    <input type="time" id="hora" name="hora" value="<?= $evento['hora'] ?>" required class="form-input"><br>
    <label for="localizacao">Localização:</label>
    <input type="text" id="localizacao" name="localizacao" value="<?= htmlspecialchars($evento['localizacao']) ?>" required class="form-input"><br>
    <label for="ingressos">Ingressos disponíveis:</label>
    <input type="number" id="ingressos" name="ingressos" value="<?= $evento['ingressos_disponiveis'] ?>" required class="form-input"><br>
    <button type="submit" class="form-button">Salvar</button>
</form>
<p class="form-link">
    <a href="/trabalho1/meus_eventos">Voltar</a>
</p>