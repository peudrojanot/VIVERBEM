<?php
session_start();
include('../config/db.php'); // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitização e validação de entradas
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);

    // Validações
    if ($senha !== $confirmar_senha) {
        $_SESSION['error'] = 'As senhas não coincidem!';
        header('Location: register.html');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'E-mail inválido!';
        header('Location: register.html');
        exit;
    }

    // Verifica se o e-mail já está registrado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['error'] = 'E-mail já cadastrado!';
        header('Location: register.html');
        exit;
    }

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Insere o novo usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, endereco, tipo_usuario) VALUES (:nome, :email, :senha, :endereco, 'cliente')");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_hash);
    $stmt->bindParam(':endereco', $endereco);

    if ($stmt->execute()) {
        // Autentica o usuário automaticamente após o registro
        $_SESSION['id_usuario'] = $conn->lastInsertId();
        $_SESSION['nome'] = $nome;
        $_SESSION['success'] = 'Usuário cadastrado com sucesso!';

        // Redireciona para o painel
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['error'] = 'Erro ao cadastrar o usuário!';
        header('Location: register.html');
        exit;
    }
} else {
    header('Location: register.html');
    exit;
}
?>

