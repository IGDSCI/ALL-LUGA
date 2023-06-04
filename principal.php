<?php
session_start();

include_once('conexao.php');

if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
	//se os registros forem diferentes ira redirecionar para pagina de login e nao ira iniciar a sessao.
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('Location: login.php');
	exit();
}
$login = $_SESSION['login'];

if (!empty($_GET['search'])) {
	$data = $_GET['search'];

	$sql2 = "SELECT DISTINCT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
		FROM tb_produto
		LEFT JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		LEFT JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		LEFT JOIN tb_aluguel ON tb_aluguel.ID_Produto = tb_produto.ID_Produto
		WHERE Nome LIKE '%$data%' OR Descricao LIKE '%$data%'OR TipoCategoria LIKE '%$data%' and (tb_aluguel.Permissao <> 1 OR tb_aluguel.Permissao IS NULL)";
} else {
	$sql2 = "SELECT DISTINCT tb_produto.*, tb_categoria.TipoCategoria, tb_usuario.Login AS Login
		FROM tb_produto
		LEFT JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		LEFT JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		LEFT JOIN tb_aluguel ON tb_aluguel.ID_Produto = tb_produto.ID_Produto
		WHERE tb_aluguel.Permissao <> 1 OR tb_aluguel.Permissao IS NULL
		ORDER BY tb_produto.ID_Produto DESC;";
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
	<header class="cabecalho">
		<a href="principal.php"> <img id="logo" src="Images/LOGOALLLUGA.png"></a>
		<div class="pesquisa__itens">
			<input type="search" placeholder="Pesquisar..." id="pesquisar">
			<button id="botao__busca" onclick="searchData()"><img id="lupa" src="Images/lupa.png"></button>
		</div>
		<div class="botoes__container">
			<a href="locadorPerfil.php" class="botoes">Visitar Perfil</a>
			<a href="login2.php" class="botoes">Entrar como locatário</a>
		</div>
	</header>
	

	

	<?php
	// ... código anterior ...
	// Verifica se a consulta retornou resultados
	if ($result2 && $result2->num_rows > 0) {
		echo '<div class="div-container" style="max-width: 1000px;">'; // Abre a div de container antes do loop e define a largura máxima
		$count = 0; // Inicia o contador de elementos
		// Loop sobre cada linha de resultados
		while ($linha = $result2->fetch_assoc()) {
			// Exibe os dados na tabela HTML
			echo "<div class='item' id='card-content' style='width: 25%; display: inline-block; margin-right: 1%; margin-bottom: 20px;'>";
			echo "<td><img class='imagemproduto'  width=50px src=" . $linha['Foto'] . "></td>";
			echo "<td> <h1 class='nome-produto'> Nome: " . $linha['Nome'] . "</h1></td>";
			echo "<td> <h1 class='preco-produto'> Preço (diário): R$" . $linha['Preco'] . "</h1></td>";
			echo "<td> <h1  style = 'font-size: 25px;'>Proprietário: " . $linha['Login'] . "</h1></td>";
			echo "<button class='botao-comprar'><a href='telaAluguel2.php?id=" . $linha['ID_Produto'] . "&imagem=" . $linha['Foto'] . "'>Alugar</a></button>";
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
		if (event.key === "Enter") {
			searchData();
		}
	});


	function searchData() {
		window.location = 'principal.php?search=' + search.value;
	}
</script>

</html>