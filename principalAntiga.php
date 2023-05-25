<?php
    session_start();

	include_once('conexao.php');
    
    $darkMode = isset($_SESSION['darkMode']) ? $_SESSION['darkMode'] : false;  

	if(!empty($_GET['search']))
	{
		$data = $_GET['search'];

		$sql2 = "SELECT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
        FROM tb_produto
        INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
        INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
        WHERE tb_produto.Nome LIKE '%$data%' OR tb_produto.Descricao LIKE '%$data%' OR tb_categoria.TipoCategoria LIKE '%$data%'";
	}
	else
	{
		$sql2 = "SELECT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
        FROM tb_produto
        INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
        INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		ORDER BY tb_produto.ID_Produto DESC";
	}

	$result2 = $conexao->query($sql2);
	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial - All Luga</title>
    <link rel="stylesheet" type="text/css" href="Css/style.css">
    <link href="https://googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a id="logo" href="principal.php"> <img  src="Images/LOGOALLLUGA%20.png"></a>
        <div class="search-container">
                <input type="search" placeholder="Pesquisar..." id="pesquisar">
                <button onclick="searchData()">Buscar</button>
        </div>
        <div class="signup-container">
            <a href="cadastro.php" class="signup-btn">Cadastro</a>
            <a href="login.php" class="signup-btn">Entrar como locador</a>
            <a href="login2.php" class="signup-btn">Entrar como locatário</a>
        </div>
    </header>
    <ul class="categorias">
        
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
					echo "<td> <h1 class='descricao-produto'> Proprietário: ".$linha['Login']."</h1></td>";
					echo "<button class='botao-comprar'>Alugar</button>";
					echo "</div>";
				}
				echo '</div>';
			} else {
				echo "Nenhum registro encontrado.";
			}
		?>

        

</body>

<script>
	var search = document.getElementById('pesquisar');

	search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });


	function searchData()
	{
		window.location = 'principal.php?search='+search.value;
	}

</script>

</html>
