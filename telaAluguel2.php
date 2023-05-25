<?php
session_start();

include_once('conexao.php');

// Verifica se o ID do produto foi fornecido na URL
if (isset($_GET['id'])) {
    $produtoID = $_GET['id'];

    // Consulta o produto com base no ID fornecido
    $sql = "SELECT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
            FROM tb_produto
            INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
            INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
            WHERE tb_produto.ID_Produto = $produtoID";
    $result = $conexao->query($sql);

    if ($result && $result->num_rows > 0) {
        // O produto foi encontrado, exiba os detalhes
        $produto = $result->fetch_assoc();

        // Aqui você pode criar o layout HTML para exibir os detalhes do produto
        // Use as informações do array $produto para preencher os campos

        // Exemplo:
        
        echo "<form action='adicionaAluguelBD.php' method='POST'>";
        echo "<img src='" . $_GET['imagem'] . "' alt='Imagem do Produto'>";
        echo "<h1>Detalhes do produto:</h1>";
        echo "<p>Nome: " . $produto['Nome'] . "</p>";
        echo "<p>Descrição: " . $produto['Descricao'] . "</p>";
        echo "<p>Preço: " . $produto['Preco'] . "</p>";
        echo "<p>Categoria: " . $produto['TipoCategoria'] . "</p>";
        echo "<p>Proprietário: ".$produto['Login']."</p>";
        echo "<input type='hidden' name='produtoID' value='" . $_GET['id'] . "'>"; // Inclua o ID do produto como um campo oculto
        echo "<input type='hidden' name='nomeLocador' value='" .$produto['Login']. "'>"; 
        echo "<input type='hidden' name='valor' value='" .$produto['Preco']. "'>";
        echo "</form>";

    } else {
        // O produto não foi encontrado, exiba uma mensagem de erro
        echo "Produto não encontrado.";
    }
} else {
    // ID do produto não foi fornecido, redirecione o usuário de volta para a página principal ou exiba uma mensagem de erro.
    header("Location: principal.php"); // Redireciona para a página principal
    exit(); // Encerra o script para evitar a execução de código adicional
}
?>