<form action="proc_redefine_senha.php" method="post">
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <input type="password" name="nova_senha" placeholder="Nova Senha" required>
    <button type="submit">Redefinir Senha</button>
</form>
