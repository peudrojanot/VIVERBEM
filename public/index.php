<?php
include '../includes/header.php';  // Inclui o cabeçalho

// Inicia a sessão e verifica se o usuário já está logado
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');  // Se estiver logado, redireciona para o painel
    exit();
}

// Conteúdo principal
echo "<h1>Bem-vindo à Farmácia Online!</h1>";
echo "<p><a href='login.php'>Clique aqui para fazer login</a></p>";  // Link para a página de login

// Exibe produtos ou funcionalidades principais
// Aqui você pode incluir um loop para mostrar produtos ou promoções, por exemplo

include '../includes/footer.php';  // Inclui o rodapé
?>
