<?php
session_start();
include('../includes/header.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');  // Se não estiver logado, redireciona para o login
    exit();
}

echo "<h1>Bem-vindo, " . $_SESSION['usuario_nome'] . "!</h1>";
echo "<p>Este é seu painel de controle.</p>";
echo "<p><a href='logout.php'>Sair</a></p>";  // Link para sair

include('../includes/footer.php');
?>
