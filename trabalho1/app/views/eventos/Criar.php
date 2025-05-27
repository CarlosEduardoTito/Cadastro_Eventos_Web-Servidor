<h2 class="form-title">Cadastrar Evento</h2>
<?php if (!empty($_SESSION['erro'])): ?>
    <p class="error-message"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>
<form action="/trabalho2/criar_evento" method="POST" class="form-container">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required class="form-input"><br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" class="form-input"></textarea><br>
    <label for="data">Data:</label>
    <input type="date" id="data" name="data" required class="form-input"><br>
    <label for="hora">Hora:</label>
    <input type="time" id="hora" name="hora" required class="form-input"><br>
    <label for="localizacao">Localização:</label>
    <input type="text" id="localizacao" name="localizacao" required class="form-input"><br>
    <label for="ingressos">Ingressos disponíveis:</label>
    <input type="number" id="ingressos" name="ingressos" required class="form-input"><br>
    <button type="submit" class="form-button">Cadastrar</button>
</form>
<p class="form-link">
    <a href="/trabalho2/menu">Voltar para o Menu</a>
</p>
