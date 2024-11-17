<?php
session_start(); // Inicia a sessão para gerenciar mensagens e autenticação

// Inclui o arquivo de conexão com o banco de dados
include('../config/db.php');

// Verifica se o usuário já está logado
if (isset($_SESSION['id_usuario'])) {
    header('Location: dashboard.php'); // Redireciona para o painel se já estiver logado
    exit;
}

// Lógica de processamento do login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtra e valida as entradas do formulário
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    // Valida o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Formato de e-mail inválido.';
        header('Location: login.html'); // Retorna para o formulário de login
        exit;
    }

    // Verifica as credenciais no banco de dados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado e se a senha é válida
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Define as variáveis de sessão
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['success'] = 'Login realizado com sucesso!';
        
        // Redireciona para o dashboard
        header('Location: dashboard.html');
        exit;
    } else {
        // Credenciais inválidas
        $_SESSION['error'] = 'E-mail ou senha incorretos.';
        header('Location: login.html'); // Retorna para o formulário de login
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processando Login</title>
</head>
<body>
    <p>Processando...</p>
</body>
</html>