<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.html');  // Redireciona para login se não estiver logado
    exit();
}

echo "<h1>Bem-vindo, " . $_SESSION['usuario_nome'] . "!</h1>";
echo "<p>Este é seu painel de controle.</p>";
echo "<p><a href='logout.php'>Sair</a></p>";  // Link para sair
?>
