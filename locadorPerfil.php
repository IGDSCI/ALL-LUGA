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
					<h1>LOCADOR</h1>
					<button class="sair editar"><a href="sair.php">Sair</a></button> </button>
					<button class='chamada-anuncio'><a href='principal.php'>Principal</a></button>


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
						<button class='editar'><a href='locadorEdit.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
						<button class='chamada-anuncio'><a href='anuncio.php'>Anuncie um produto</a> </td>";
						}
					} else {
						echo "Nenhum registro encontrado.";
					} ?>
				</div>
				<br><br>
				<table class="table" id="tabela2">
					<thead>
						<tr>
							<th class="tabela" scope="col">#</th>
							<th class="tabela" scope="col">Nome</th>
							<th class="tabela" scope="col">Descrição</th>
							<th class="tabela" scope="col">Preço</th>
							<th class="tabela" scope="col">Proprietário</th>
							<th class="tabela" scope="col">Categoria</th>
							<th class="tabela" scope="col">...</th>
							<th class="tabela" scope="col">Foto</th>
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
										<button class='editar'><a href='locadorEditProduto.php?ID_Produto=$linha[ID_Produto]'>Editar</a></button>
										<button class='excluir'><a href='deletaProduto.php?ID_Produto=$linha[ID_Produto]'>Excluir</a></button>
									</td>";
								echo "<td><img width=100px src=" . $linha['Foto'] . "></td>";
								echo "</tr>";
							}
						} else {
							// Se a consulta não retornou resultados, exibe uma mensagem de erro
							echo "<td colspan='8'>Nenhum registro encontrado. </td>";
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