<?php
session_start();
include_once('conexao.php');
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
	//se os registros forem diferentes ira redirecionar para pagina de login e nao ira iniciar a sessao.
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('Location: login.php');
}
$login = $_SESSION['login'];

//select para listar os registros
if (!empty($_GET['search'])) {
	$data = $_GET['search'];
	$sql = "SELECT * FROM tb_usuario 
		INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
		INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
		WHERE ID_Usuario LIKE '%$data%' or Login LIKE '%$data%' or Telefone LIKE '%$data%' or cpf LIKE '%$data%' or ID_TipoSexo LIKE '%$data%' or DataNasc LIKE '%$data%' or Cidade LIKE '%$data%' or Estado LIKE '%$data%' or Genero LIKE '%$data%' or Tipo LIKE '%$data%' ORDER BY ID_Usuario DESC";
} else {
	$sql = "SELECT tb_usuario.*, tb_sexo.Genero, tb_tipo_usuario.Tipo
		FROM tb_usuario
		INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
		INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
		ORDER BY tb_usuario.ID_Usuario DESC";
}

if (!empty($_GET['search2'])) {
	$data = $_GET['search2'];

	$sql2 = "SELECT * FROM tb_produto
		INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		WHERE ID_Produto LIKE '%$data%' OR Nome LIKE '%$data%' OR Descricao LIKE '%$data%' OR Preco LIKE '%$data%' OR Login LIKE '%$data%' OR TipoCategoria LIKE '%$data%' ORDER BY ID_Produto DESC";
} else {
	$sql2 = "SELECT tb_produto.*, tb_usuario.Login, tb_categoria.TipoCategoria
		FROM tb_produto
		INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		ORDER BY tb_produto.ID_Produto DESC";
}

$result = $conexao->query($sql);

$result2 = $conexao->query($sql2);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Sistema de Gerenciamento - Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Rubik&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="Css/sistem.css">
	<style>
		
		@font-face {
    font-family: 'Commuters Sans';
    src: local('js/Commuters Sans Regular'), local('Commuters-Sans-Regular'),
        url('js/CommutersSans-Regular.woff2') format('woff2'),
        url('js/CommutersSans-Regular.woff') format('woff'),
        url('js/CommutersSans-Regular.ttf') format('truetype');
    font-weight: 400;
    font-style: normal;
  }
  body {
			font-family: 'Commuters Sans';
			background-color: #f5f5f5;
			margin: 0;
			padding: 0;
		}
		header {
			padding: 20px;
			color: white;
			display: flex;
			justify-content: space-between;
			align-items: center;
			border-bottom: 2px solid #097FF5;
			font-family: 'Commuters Sans';
		}

		header h1 {
			font-size: 24px;
			margin: 0;
		}

		.button {
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			color: white;
		}

		.button.logout {
			background-color: #d32f2f;
		}

		.button.dashboard {
			background-color: #4caf50;
		}

		nav {
			background-color: #f5f5f5;
			padding: 10px 20px;
			margin-top: 20px;
		}

		nav h1 {
			font-size: 18px;
			margin: 0;
			text-align: left;
			font: normal normal normal 2.5em Commuters Sans;
			letter-spacing: 0px;
			color: #1E1E1E;
			opacity: 1;
		}

		hr {
			border: none;
			border-top: 1px solid #ddd;
			margin: 10px 0;
		}

		.search-container {
			display: flex;
			align-items: center;
			margin-bottom: 20px;
		}

		.search-container input[type="search"] {
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ddd;
			border-radius: 5px;
			flex: 1;
		}

		.table-container {
			background-color: white;
			padding: 20px;
		}

		.table-container h2 {
			font-size: 24px;
			margin: 0 0 }

		#tabela1{
			margin-top: 2%;
			margin-left: 6%;
			border-bottom: 2px solid #097FF5;
		}

		.second-header{
			margin-left: 6%;
		}

		#tabela2{
			margin-top: 2%;
			margin-left: 6%;
		}
		.header-buttons{
			display:flex;
			width:30%;
		}
		.editar{
			margin-left:5%;
		}
		.first-header{
			margin-left: 6%;
		}
	</style>
</head>

<body>
	<header>
		<div class='header-buttons'>
		<div class='chamada-anuncio'><a href='principal.php'>Principal</a></div>
		<div class="editar"><a href="sair.php">Sair</a></div>
		</div>
		
		<nav>
			<div>
				<?php
				echo "<h1>Bem vindo <u>$login</u></h1>";
				?>
			</div>
			<hr>
		</nav>
		<br>
		<div>
			
		</div>
		<br>
	</header>
	<main>
		<br>
			<div class="first-header">
				<h1 class="texto-usuario">Gerenciamento de usuários</h1>
				<input class="entrada" type="search" placeholder="Procure aqui" id="pesquisar">
				<button class="pesquisar" onclick="searchData()">Pesquisar</button>
			</div>
		<br>
		<table class="table" id="tabela1">
			<thead>
				<tr>
					<th class="tabela" scope="col">ID</th>
					<th class="tabela" scope="col">Login</th>
					<th class="tabela" scope="col">Senha</th>
					<th class="tabela" scope="col">Telefone</th>
					<th class="tabela" scope="col">CPF</th>
					<th class="tabela" scope="col">Sexo</th>
					<th class="tabela" scope="col">Data de Nascimento</th>
					<th class="tabela" scope="col">Cidade</th>
					<th class="tabela" scope="col">Estado</th>
					<th class="tabela" scope="col">Usuário</th>
					<th class="tabela" scope="col">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Verifica se a consulta retornou resultados
				if ($result && $result->num_rows > 0) {
					// Loop sobre cada linha de resultados
					while ($linha = $result->fetch_assoc()) {
						// Exibe os dados na tabela HTML
						echo "<tr>";
						echo "<td>" . $linha['ID_Usuario'] . "</td>";
						echo "<td>" . $linha['Login'] . "</td>";
						echo "<td>" . $linha['Senha'] . "</td>";
						echo "<td>" . $linha['Telefone'] . "</td>";
						echo "<td>" . $linha['cpf'] . "</td>";
						echo "<td>" . $linha['Genero'] . "</td>";
						echo "<td>" . $linha['DataNasc'] . "</td>";
						echo "<td>" . $linha['Cidade'] . "</td>";
						echo "<td>" . $linha['Estado'] . "</td>";
						echo "<td>" . $linha['Tipo'] . "</td>";
						echo "<td>
						<button class='editar' ><a href='edita.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
						<button class='excluir'><a href='deleta.php?ID_Usuario=$linha[ID_Usuario]'>Excluir</a></button>
					</td>";
						echo "</tr>";
					}
				} else {
					// Se a consulta não retornou resultados, exibe uma mensagem de erro
					echo "<tr><td  colspan='11'>Nenhum registro encontrado.</td></tr>";
				}
				?>
			</tbody>
		</table>
		<br><br>
		<hr>
		<br><br>
		<div class='second-header'>
			<h1 class="texto-produtos">Gerenciamento de produtos</h1>
			<input class="entrada" type="search" placeholder="Procure aqui" id="pesquisar2">
			<button class="pesquisar" onclick="searchData2()">Pesquisar</button>
		</div>
		<br>
		<table class="table" id="tabela2">
			<thead>
				<tr>
					<th class="tabela" scope="col">ID</th>
					<th class="tabela" scope="col">Nome</th>
					<th class="tabela" scope="col">Descrição</th>
					<th class="tabela" scope="col">Preço</th>
					<th class="tabela" scope="col">Proprietário</th>
					<th class="tabela" scope="col">Categoria</th>
					<th class="tabela" scope="col">Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Verifica se a consulta retornou resultados
				if ($result2 && $result2->num_rows > 0) {
					// Loop sobre cada linha de resultados
					while ($linha = $result2->fetch_assoc()) {
						// Exibe os dados na tabela HTML
						echo "<tr>";
						echo "<td>" . $linha['ID_Produto'] . "</td>";
						echo "<td>" . $linha['Nome'] . "</td>";
						echo "<td>" . $linha['Descricao'] . "</td>";
						echo "<td>" . $linha['Preco'] . "</td>";
						echo "<td>" . $linha['Login'] . "</td>";
						echo "<td>" . $linha['TipoCategoria'] . "</td>";
						echo "<td>
						<button class='excluir'><a href='adminDeletaProduto.php?ID_Produto=$linha[ID_Produto]'>Excluir</a></button>
					</td>";
						echo "</tr>";
					}
				} else {
					// Se a consulta não retornou resultados, exibe uma mensagem de erro
					echo "<tr><td  colspan='7'>Nenhum registro encontrado.</td></tr>";
				}
				?>
			</tbody>
		</table>
	</main>
	<br><br><br>
	<hr>

</body>

<script>
	var search = document.getElementById('pesquisar');

	var search2 = document.getElementById('pesquisar2');

	search.addEventListener("keydown", function(event) {
		if (event.key === "Enter") {
			searchData();
		}
	});


	function searchData() {
		window.location = 'sistema.php?search=' + search.value;
	}

	function searchData2() {
		window.location = 'sistema.php?search2=' + search2.value;
	}
</script>

</html>