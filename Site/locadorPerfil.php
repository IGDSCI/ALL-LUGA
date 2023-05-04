<?php
    session_start();

	include_once('conexao.php');

    
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
        //se os registros forem diferentes ira redirecionar para pagina de login e nao ira iniciar a sessao.
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('Location: login.php');
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Perfil Locador</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleGustavo.css">
</head>
<body>
	<header>
	<button class="sair"><a href="sair.php ">Sair</a></button>
		<div class="logo">Perfil Locador</div>
		<nav>
            <div>
                <?php
                    echo "<h1>Bem vindo <u>$login</u></h1>";
                ?>
            </div>
			<hr>
		</nav>
		<br>
	</header>
	<main>
	<table class="table" id="tabela1">
		<h1 class="logo">Seus dados</h1>
		<thead>
			<tr>
			<th class="tabela" scope="col">#</th>
			<th class="tabela" scope="col">Login</th>
			<th class="tabela" scope="col">Senha</th>
			<th class="tabela" scope="col">Telefone</th>
			<th class="tabela"scope="col">CPF</th>
			<th class="tabela"scope="col">Sexo</th>
			<th class="tabela" scope="col">Data de Nascimento</th>
			<th class="tabela" scope="col">Cidade</th>
			<th class="tabela" scope="col">Estado</th>
			<th class="tabela" scope="col">Usuário</th>
			<th class="tabela" scope="col">...</th>

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
					echo "<td>".$linha['ID_Usuario']."</td>";
					echo "<td>".$linha['Login']."</td>";
					echo "<td>".$linha['Senha']."</td>";
					echo "<td>".$linha['Telefone']."</td>";
					echo "<td>".$linha['cpf']."</td>";
					echo "<td>".$linha['Genero']."</td>";
					echo "<td>".$linha['DataNasc']."</td>";
					echo "<td>".$linha['Cidade']."</td>";
					echo "<td>".$linha['Estado']."</td>";
					echo "<td>".$linha['Tipo']."</td>";
					echo "<td>
						<button class='editar'><a href='locadorEdit.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
					</td>";
					echo "</tr>";
					}
				} else {
					// Se a consulta não retornou resultados, exibe uma mensagem de erro
					echo "Nenhum registro encontrado.";
				}
			?>
		</tbody>
	</table>
	<br><br>
	<hr>
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
					echo "<td>".$linha['ID_Produto']."</td>";
					echo "<td>".$linha['Nome']."</td>";
					echo "<td>".$linha['Descricao']."</td>";
					echo "<td>".$linha['Preco']."</td>";
					echo "<td>".$linha['Login']."</td>";
					echo "<td>".$linha['TipoCategoria']."</td>";
					echo "<td>
						<button class='editar'><a href='locadorEditProduto.php?ID_Produto=$linha[ID_Produto]'>Editar</a></button>
						<button class='excluir'><a href='deletaProduto.php?ID_Produto=$linha[ID_Produto]'>Excluir</a></button>
					</td>";
					echo "</tr>";
					}
				} else {
					// Se a consulta não retornou resultados, exibe uma mensagem de erro
					echo "Nenhum registro encontrado.";
				}
			?>
		</tbody>
	</table>
	<br><br>
	</main>
	<button class="chamada-anuncio"><a href="anuncio.php">Anuncie um produto</a></button>
</body>
</html>