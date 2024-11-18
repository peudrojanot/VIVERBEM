<?php
// Inclui o cabeçalho
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrinho de Compras - Farmácia Online</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Ajuste o caminho conforme necessário -->
  </head>
  <body>
    <header>
      <h1 class="header-title">Meu Carrinho</h1>
      <div class="cart-actions">
        <a href="checkout.php" class="finalize-button">Finalizar Compra</a>
      </div>
    </header>

    <main class="cart-main">
      <table class="cart-table">
        <thead>
          <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor Unitário (R$)</th>
            <th>Valor Total (R$)</th>
          </tr>
        </thead>
        <tbody>
          <!-- Exemplo de produtos no carrinho -->
          <tr>
            <td>Produto A - Descrição</td>
            <td>2</td>
            <td>25,00</td>
            <td>50,00</td>
          </tr>
          <tr>
            <td>Produto B - Descrição</td>
            <td>1</td>
            <td>40,00</td>
            <td>40,00</td>
          </tr>
        </tbody>
      </table>

      <div class="cart-summary">
        <p><strong>Valor Total da Compra: R$ 90,00</strong></p>
        <div class="cart-buttons">
          <a href="produtos.php" class="continue-shopping-button"
            >Continuar Comprando</a
          >
          <a href="checkout.php" class="finalize-button">Finalizar Compra</a>
        </div>
      </div>
    </main>

    <footer class="footer">
      <!-- Conteúdo do rodapé -->
    </footer>
  </body>
</html>

<?php
// Inclui o rodapé
include '../includes/footer.php';
?>

