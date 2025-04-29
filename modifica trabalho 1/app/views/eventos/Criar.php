<h2>Cadastrar Evento</h2>
<?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>
<form action="/trabalho1/public/index.php?action=criar_evento" method="POST">
    Nome: <input type="text" name="nome" required><br>
    Descrição: <textarea name="descricao"></textarea><br>
    Data: <input type="date" name="data" required><br>
    Hora: <input type="time" name="hora" required><br>
    Localização: <input type="text" name="localizacao" required><br>
    Ingressos disponíveis: <input type="number" name="ingressos" required><br>
    <button type="submit">Cadastrar</button>
</form>

<form action="/trabalho1/public/index.php" method="GET" style="margin-top: 20px;">
    <input type="hidden" name="action" value="menu">
    <button type="submit">Voltar para o Menu</button>
</form>