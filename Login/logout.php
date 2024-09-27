<?php
session_start();  // Inicia a sessão

// Limpa todas as variáveis de sessão
$_SESSION = array();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login
header("Location: ../index.php");
exit();
?>
