<?php
$host = 'localhost';
$db = 'farmacia_online';
$user = 'root'; // Usuário padrão do XAMPP
$pass = '';     // Senha padrão (geralmente vazia no XAMPP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>
