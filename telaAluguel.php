<?php
session_start();

include_once('conexao.php');

// Verifica se o ID do produto e o caminho da imagem foram passados na URL
if (isset($_GET['id']) && isset($_GET['imagem'])) {
    $produtoId = $_GET['id'];
    $imagem = $_GET['imagem'];

    // Consulta o banco de dados para obter as informações do produto pelo ID
    $sql = "SELECT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
        FROM tb_produto
        INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
        INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		ORDER BY tb_produto.ID_Produto DESC";

    $result = $conexao->query($sql);

    if ($result && $result->num_rows > 0) {
        // Exibe as informações do produto
        $produto = $result->fetch_assoc();
        echo "<div class='detalhes-produto'>";
        echo "<h1>Detalhes do Produto:</h1>";
        echo "<img src='" . $imagem . "' alt='Imagem do Produto'>";
        echo "<p>Nome: " . $produto['Nome'] . "</p>";
        echo "<p>Descrição: " . $produto['Descricao'] . "</p>";
        echo "<p>Preço: " . $produto['Preco'] . "</p>";
        echo "<p>Categoria: " . $produto['TipoCategoria'] . "</p>";
        echo "<p>Proprietário: ".$produto['Login']."</p>";
        echo "<button id='btn-oferecer-proposta'>Oferecer proposta</button>";
        echo "</div>";
        // Aqui você pode adicionar mais informações do produto conforme necessário
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID do produto ou caminho da imagem não especificados.";
}

echo "<script>
        document.getElementById('btn-oferecer-proposta').addEventListener('click', function() {
            // Cria os elementos HTML para os inputs
            var inputNome = document.createElement('input');
            inputNome.setAttribute('type', 'text');
            inputNome.setAttribute('placeholder', 'Seu nome');

            var inputProposta = document.createElement('input');
            inputProposta.setAttribute('type', 'text');
            inputProposta.setAttribute('placeholder', 'Sua proposta');

            // Cria um botão para enviar a proposta
            var btnEnviar = document.createElement('button');
            btnEnviar.innerText = 'Enviar';
            btnEnviar.addEventListener('click', function() {
                // Aqui você pode adicionar a lógica para enviar a proposta ao servidor

                // Por exemplo, você pode recuperar os valores dos inputs
                var nome = inputNome.value;
                var proposta = inputProposta.value;

                // E fazer algo com esses valores, como exibir um alerta
                alert('Nome: ' + nome + '\\nProposta: ' + proposta);

                // Você pode redirecionar o usuário para outra página após o envio da proposta, se necessário
                // window.location.href = 'outra_pagina.php';
            });

            // Cria uma div para conter os inputs e o botão
            var divProposta = document.createElement('div');
            divProposta.appendChild(inputNome);
            divProposta.appendChild(inputProposta);
            divProposta.appendChild(btnEnviar);

            // Insere a div na página, abaixo das informações do produto
            var detalhesProduto = document.querySelector('.detalhes-produto');
            detalhesProduto.appendChild(divProposta);
        });
    </script>";
?>

