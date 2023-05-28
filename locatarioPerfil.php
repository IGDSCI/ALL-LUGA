<?php
session_start();

include_once('conexao.php');


if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
	//se os registros forem diferentes ira redirecionar para pagina de login e nao ira iniciar a sessao.
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('Location: login2.php');
}
$login = $_SESSION['login'];


$sql = "SELECT tb_usuario.*, tb_sexo.Genero, tb_tipo_usuario.Tipo
	FROM tb_usuario
	INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
	INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
    WHERE Login = '$login'
	ORDER BY tb_usuario.ID_Usuario DESC";

$sql2 = "SELECT tb_produto.*, tb_usuario.Login, tb_categoria.TipoCategoria
	FROM tb_produto
	INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
	INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
	WHERE Login = '$login'
	ORDER BY tb_produto.ID_Produto DESC";

$result = $conexao->query($sql);

$result2 = $conexao->query($sql2);




?>
<html lang="pt-br">

<head>
	<title> All Luga </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="Estilo/perfilLocatario.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Rubik&display=swap" rel="stylesheet">
	<style>
		.btn-control{
			display: flex;
		}
		.editar a {
			padding-top: 0 auto;
		text-align: left;
		text-decoration: underline;
		font: normal normal normal 12px/14px Commuters Sans;
		letter-spacing: 0px;
		color: #0E4597;
		text-transform: uppercase;
		opacity: 1;
		text-decoration: none;
		font: normal normal normal 0.9em "Rubik";
		margin-right:1em;
		}
		button{
			background: none;
			color: inherit;
			border: none;
			padding: 0;
			font: inherit;
			cursor: pointer;
			outline: inherit;
			margin-bottom: 0.5%;
			margin-left:2%;
		}
		.editar a:hover{
			border-bottom: 1px solid #000000;
			color: #000000;
			transition: 1s ease;
		}
		
		.table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		.table th,
		.table td {
			padding: 12px;
			text-align: center;
			border: 1px solid #e0e0e0;
		}

		.table th {
			background-color: #0E4597;
			color: white;
			font-weight: bold;
		}

		.table td {
			background-color: #f9f9f9;
			color: #333;
		}

		.table .editar,
		.table .excluir,
		.table .chamada-anuncio {
			padding: 8px 16px;
			font-size: 14px;
			font-weight: 600;
			border-radius: 5px;
			cursor: pointer;
			text-align: center;
			overflow: hidden;
			transition: background-color 0.3s;
		}

		.table .editar a,
		.table .excluir a,
		.table .chamada-anuncio a {
			color: white;
			text-decoration: none;
		}

		.table .editar {
			background-color: #0E4597;
		}

		.table .excluir {
			background-color: #d32f2f;
		}

		.table .chamada-anuncio {
			background-color: #4caf50;
		}

		.table .foto {
			width: 100px;
		}

		.table .foto img {
			max-width: 100%;
			height: auto;
		}

		
	</style>

</head>

<body>
	<div class="main-container">
		<div class="left-container fade-in-content">
			<div class="header">
				<div class="profile-picture">
					<img src="Images/pexels-pixabay-39866.png" alt="">
				</div>

				<div class="header-content">
					<h1>LOCATÁRIO</h1>
					<div class="btn-control">
						<div class="sair editar"><a href="sair.php">Sair</a></div>
						<div class='chamada-anuncio editar'><a href='principal2.php'>Principal</a></div>
					</div>


					<h2 class="header-h2">Lorem ipsum dolor sit amet, consectetuer adipiscing.<br> elit, sed diam lorem Lorem.</h2>
				</div>
			</div>

			<div class="data-container">
				<div class="data-content">
					<?php if ($result && $result->num_rows > 0) {
						while ($linha = $result->fetch_assoc()) {
							echo "<p> Nome: " . $linha['Login'] . "</p>";
							echo '<hr>';
							echo "<p> Telefone: " . $linha['Telefone'] . "</p>";
							echo '<hr>';
							echo "<p> CPF: " . $linha['cpf'] . "</p>";
							echo '<hr>';
							echo "<p> Gênero: " . $linha['Genero'] . "</p>";
							echo '<hr>';
							echo "<p> Data de nascimento: " . $linha['DataNasc'] . "</p>";
							echo '<hr>';
							echo "<p> CEP: " . $linha['cep'] . "</p>";
							echo '<hr>';
							echo "<p> Cidade: " . $linha['Cidade'] . "</p>";
							echo '<hr>';
							echo "<p> Estado: " . $linha['Estado'] . "</p>";
							echo '<hr>';
							echo "<p> Tipo: " . $linha['Tipo'] . "</p>";
							echo "<td>
						<button class='editar'><a href='locatarioEdit.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
					</td>";
						}
					} else {
						echo "Nenhum registro encontrado.";
					} ?>
				</div>
			</div>
			<br>


			<div>
			<table class="table" id="tabela2">
					<thead>
						<tr>
							<th class="tabela" scope="col">Nome</th>
							<th class="tabela" scope="col">Preço</th>
							<th class="tabela" scope="col">Descrição</th>
							<th class="tabela" scope="col">Proprietário</th>
							<th class="tabela" scope="col">Foto</th>
						</tr>
					</thead>
					<tbody>
				<?php
				
				// Consulta SQL para recuperar os dados da tb_aluguel
				$sql3 = "SELECT tb_produto.*, tb_aluguel.Nome_Locador AS Nome_Locador FROM tb_produto
						INNER JOIN tb_aluguel ON tb_aluguel.ID_Produto = tb_produto.ID_Produto
						INNER JOIN tb_usuario ON tb_aluguel.Nome_Locatario = tb_usuario.Login
						WHERE tb_aluguel.Nome_Locatario = '$login' AND tb_aluguel.Permissao = 1";
				$resultado3 = $conexao->query($sql3);

				// Verifica se a consulta retornou resultados
				if ($resultado3 && $resultado3->num_rows > 0) {
					// Loop sobre cada linha de resultados
					while ($linha = $resultado3->fetch_assoc()) {
						// Exibe os dados na tabela HTML
						echo "<tr>";
						echo "<td>" . $linha['Nome'] . "</td>";
						echo "<td>" . $linha['Preco'] . "</td>";
						echo "<td>" . $linha['Descricao'] . "</td>";
						echo "<td>" . $linha['Nome_Locador']. "</td>";
						echo "<td><img width=100px src=" . $linha['Foto'] . "></td>";
						echo "</tr>";
					}
				} else {
					// Se a consulta não retornou resultados, exibe uma mensagem de erro
					echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
				}
				?>
			</tbody>
			</table>
			</div>


		</div>
		<div class="right-container">

		</div>
	</div>
</body>

</html>