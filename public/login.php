<?php
session_start(); // Garantir que a sessão seja iniciada no início do arquivo
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Farmácia Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1 class="header-title">Bem-vindo à Farmácia Online!</h1>
    </header>

    <div class="login-main">
        <h1>Login</h1>

        <!-- Exibe a mensagem de erro ou sucesso se existir -->
        <?php
        // Exibindo as mensagens de erro ou sucesso
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);  // Limpa a mensagem de erro
        }

        if (isset($_SESSION['success'])) {
            echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);  // Limpa a mensagem de sucesso
        }

        // Verifica se o usuário já está logado
        if (isset($_SESSION['usuario_id'])) {
            header('Location: dashboard.php');  // Se estiver logado, redireciona para o painel
            exit();
        }
        ?>

        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br><br>

            <button type="submit">Entrar</button>
        </form>

        <p>Não tem uma conta? <a href="register.php" class="transition-link">Cadastre-se aqui</a></p> <!-- Link para a página de registro -->
    </div>

    <footer class="footer">
        <!-- Pode incluir o conteúdo do footer.php aqui -->
    </footer>
</body>
</html>


