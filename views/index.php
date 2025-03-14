<?php
use controller\ProdutoController;

// Incluindo o arquivo de autoload ou carregando classes manualmente
require_once '../vendor/autoload.php'; // Se estiver utilizando Composer, caso contrário, ajuste conforme sua estrutura de pastas

// Instanciando o controller de Produto
$produtoController = new ProdutoController();

// Verificando se o método de envio é POST para a criação de um produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produtoController->create();
}

// Verificando se o método de envio é DELETE para a exclusão de um produto
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $produtoController->delete($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
</head>
<body>
    <h1>Gerenciamento de Produtos</h1>

    <!-- Formulário para adicionar um novo produto -->
    <h2>Cadastrar Novo Produto</h2>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" required><br><br>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" step="0.01" required><br><br>

        <button type="submit">Adicionar Produto</button>
    </form>

    <hr>

    <!-- Exibição da lista de produtos -->
    <h2>Produtos em Estoque</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibe a lista de produtos
            $produtos = $produtoController->read(); // Esse método deveria retornar os produtos, então você pode usá-lo aqui para exibir os produtos
            foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto->getId(); ?></td>
                    <td><?= $produto->getNome(); ?></td>
                    <td><?= $produto->getQuantidade(); ?></td>
                    <td><?= $produto->getValor(); ?></td>
                    <td>
                        <form method="POST" action="?id=<?= $produto->getId(); ?>" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
