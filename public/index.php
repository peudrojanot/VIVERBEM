<?php
include '../includes/header.php';


// Conteúdo principal
echo "<h1>Bem-vindo à Farmácia Online!</h1>";

// Exibe produtos ou funcionalidades principais
include '../includes/footer.php';
?>

echo '<div class="login-container">
        <h2>Login</h2>
        <form action="./login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>
            
            <button type="submit">Entrar</button>
        </form>
    </div>';