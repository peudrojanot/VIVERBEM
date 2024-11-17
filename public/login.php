<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Formato de e-mail inválido.';
        header('Location: login.html');
        exit;
    }

    // Verifica as credenciais no banco de dados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe
    if (!$usuario) {
        $_SESSION['error'] = 'Usuário não encontrado!';
        header('Location: login.html');
        exit;
    }

    // Verifica a senha
    if (!password_verify($senha, $usuario['senha'])) {
        $_SESSION['error'] = 'Senha incorreta!';
        header('Location: login.html');
        exit;
    }

    // Configura a sessão
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['success'] = 'Login realizado com sucesso!';

    // Redireciona para o painel
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: login.html');
    exit;
}
?>
