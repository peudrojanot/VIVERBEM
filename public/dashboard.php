<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

include('../config/db.php');

// Obtém os dados do usuário logado
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
$stmt->bindParam(':id', $_SESSION['id_usuario']);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Exibe o nome e tipo do usuário
$nome_usuario = $usuario['nome'];
$tipo_usuario = $usuario['tipo_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de Controle</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>
    <p>Você está logado como: <?php echo htmlspecialchars($tipo_usuario); ?></p>
    <a href="logout.php">Sair</a>
</body>
</html>
