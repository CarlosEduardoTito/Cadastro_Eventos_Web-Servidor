<h2>Cadastrar</h2>
<?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
<?php endif; ?>
<form action="/trabalho1/public/index.php?action=cadastrar" method="POST">
    Nome: <input type="text" name="nome" required><br>
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button type="submit">Cadastrar</button>
</form>
<a href="/trabalho1/public/index.php?action=login">Voltar para Login</a>