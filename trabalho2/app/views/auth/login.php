<h2 class="form-title">Login</h2>
<?php if (!empty($_SESSION['erro'])): ?>
    <p class="error-message"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>
<form action="/trabalho2/public/login" method="POST" class="form-container">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required class="form-input"><br>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required class="form-input"><br>
    <button type="submit" class="form-button">Entrar</button>
</form>
<p class="form-link">
    <a href="/trabalho2/public/cadastrar">Cadastrar-se</a>
</p>
<form action="/trabalho2/public/criar_evento" method="POST">
    <a href="/trabalho2/public/menu">Voltar para o Menu</a>
