<?php
    session_start();

	include_once('conexao.php');

    $sql = "SELECT tb_usuario.*, tb_sexo.Genero, tb_tipo_usuario.Tipo
	FROM tb_usuario
	INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
	INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
	ORDER BY tb_usuario.ID_Usuario DESC";

	$sql2 = "SELECT tb_produto.*, tb_usuario.Login, tb_categoria.TipoCategoria
	FROM tb_produto
	INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
	INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
	ORDER BY tb_produto.ID_Produto DESC";

	$result = $conexao->query($sql);

	$result2 = $conexao->query($sql2);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial - All Luga</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a id="logo" href="principal.php"> <img  src="Images/LOGOALLLUGA%20.png"></a>
        <div class="search-container">
            <form>
                <input type="text" placeholder="Pesquisar...">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <div class="signup-container">
            <a href="cadastro.php" class="signup-btn">Cadastro</a>
            <a href="login.php" class="signup-btn">Entrar como locador</a>
            <a href="login2.php" class="signup-btn">Entrar como locatário</a>
        </div>
    </header>
    <ul class="categorias">
        <li>
            <a class = "nome-categoria" href="#"><img class="icone" src="Images/icone.png">Comida</a>
        </li>
        <li>
            <a class = "nome-categoria" href="#"><img class="icone" src="Images/icone2.png">Roupa</a>
        </li>
        <li>
            <a class = "nome-categoria" href="#"><img class="icone" src="Images/icone3.png">Esporte</a>
        </li>
    </ul>
        <?php
            // ... código anterior ...
            // Verifica se a consulta retornou resultados
            if ($result2 && $result2->num_rows > 0) {
                echo '<div class="div-container" style="max-width: 1000px;">'; // Abre a div de container antes do loop e define a largura máxima
                $count = 0; // Inicia o contador de elementos
                // Loop sobre cada linha de resultados
                while ($linha = $result2->fetch_assoc()) {
                    // Exibe os dados na tabela HTML
                    echo "<div class='item' id='card-content' style='width: 19%; display: inline-block; margin-right: 1%; margin-bottom: 20px;'>";
                    echo "<td><img class='imagemproduto'  width=50px src=".$linha['Foto']."></td>";
                    echo "<td> <h1 class='nome-produto'> Nome: ".$linha['Nome']."</h1></td>";
                    echo "<td> <h1 class='descricao-produto'> Descrição:".$linha['Descricao']."</h1></td>";
                    echo "<td> <h1 class='preco-produto'> Preço: ".$linha['Preco']."</h1></td>";
                    echo "<td> <h1 class='descricao-produto'> Categoria: ".$linha['TipoCategoria']."</h1></td>";
                    echo "<button class='botao-comprar'>Comprar</button>";
                    echo "</div>";
                }
                echo '</div>';
            } else {
                echo "Nenhum registro encontrado.";
            }
        ?>
</body>
</html>
