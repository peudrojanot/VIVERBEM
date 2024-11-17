<?php
session_start(); // Inicia a sessão para gerenciar mensagens

// Inclui a conexão com o banco de dados
include('../config/db.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtra e valida os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Valida se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $_SESSION['error'] = 'As senhas não coincidem!';
        header('Location: register.html');
        exit;
    }

    // Valida o formato do email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'E-mail inválido!';
        header('Location: register.html');
        exit;
    }

    // Verifica se o email já está registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['error'] = 'E-mail já cadastrado!';
        header('Location: register.html');
        exit;
    }

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Insere o novo usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_hash);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Usuário cadastrado com sucesso! Agora você pode fazer login.';
        header('Location: login.html');
        exit;
    } else {
        $_SESSION['error'] = 'Erro ao cadastrar o usuário!';
        header('Location: register.html');
        exit;
    }
} else {
    header('Location: register.html'); // Redireciona caso acessem o script diretamente
    exit;
}

