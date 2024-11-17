<?php
// Inicia a sessão
session_start();
include('../includes/header.php'); // Cabeçalho comum

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php'); // Redireciona para o login se não estiver logado
    exit();
}

// Captura o nome do usuário para exibir na página
$nome_usuario = isset($_SESSION['nome']) ? $_SESSION['nome'] : "Usuário";
?>