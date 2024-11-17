<?php
session_start();
include('../config/db.php');  // Incluindo o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];  // Recebe o nome do formulário
    $email = $_POST['email'];  // Recebe o email do formulário
    $senha = $_POST['senha'];  // Recebe a senha do formulário
    $confirmar_senha = $_POST['confirmar_senha'];  // Recebe a confirmação da senha

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $_SESSION['error'] = 'As senhas não coincidem!';
        header('Location: register.html');  // Redireciona de volta para o formulário de cadastro
        exit();
    }

    // Verifica se o email já está registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['error'] = 'Email já cadastrado!';
        header('Location: register.html');  // Redireciona de volta para o formulário de cadastro
        exit();
    }

    // Criptografa a senha antes de salvar no banco de dados
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Insere o novo usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_hash);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Usuário cadastrado com sucesso!';
        header('Location: login.html');  // Redireciona para a página de login
        exit();
    } else {
        $_SESSION['error'] = 'Erro ao cadastrar o usuário!';
        header('Location: register.html');  // Redireciona de volta para o formulário de cadastro
        exit();
    }
}
?>
