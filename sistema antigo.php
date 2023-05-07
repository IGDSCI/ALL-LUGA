<?php
    session_start();

	include_once('conexao.php');
    print_r($_SESSION);
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
        //se os registros forem diferentes ira redirecionar para pagina de login e nao ira iniciar a sessao.
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $login = $_SESSION['login'];
	print_r($login);

	//select para listar os registros
	if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM tb_usuario 
		INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
		INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
		WHERE ID_Usuario LIKE '%$data%' or Login LIKE '%$data%' or Telefone LIKE '%$data%' or cpf LIKE '%$data%' or ID_TipoSexo LIKE '%$data%' or DataNasc LIKE '%$data%' or Cidade LIKE '%$data%' or Estado LIKE '%$data%' or Genero LIKE '%$data%' or Tipo LIKE '%$data%' ORDER BY ID_Usuario DESC";
    }
    else
    {
        $sql = "SELECT tb_usuario.*, tb_sexo.Genero, tb_tipo_usuario.Tipo
		FROM tb_usuario
		INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
		INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
		ORDER BY tb_usuario.ID_Usuario DESC";
    }

	if(!empty($_GET['search2']))
	{
		$data = $_GET['search2'];

		$sql2 = "SELECT * FROM tb_produto
		INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		WHERE ID_Produto LIKE '%$data%' OR Nome LIKE '%$data%' OR Descricao LIKE '%$data%' OR Preco LIKE '%$data%' OR Login LIKE '%$data%' OR TipoCategoria LIKE '%$data%' ORDER BY ID_Produto DESC";
	}
	else
	{
		$sql2 = "SELECT tb_produto.*, tb_usuario.Login, tb_categoria.TipoCategoria
		FROM tb_produto
		INNER JOIN tb_usuario ON tb_produto.Proprietario = tb_usuario.ID_Usuario
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		ORDER BY tb_produto.ID_Produto DESC";
	}

	$result = $conexao->query($sql);

	$result2 = $conexao->query($sql2);

	print_r($result);
	print_r($result2);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Sistema de Gerenciamento - Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<div class="logo">Sistema de Gerenciamento</div>
		<nav>
            <div>
                <?php
                    echo "<h1>Bem vindo <u>$login</u></h1>";
                ?>
            </div>
            <div>
                <button><a href="sair.php ">Sair</a></button>
            </div>
			<hr>
		</nav>
		<br>
		<div>
			<input type="search" placeholder="Procure aqui" id="pesquisar">
			<button onclick="searchData()">Pesquisar</button>
		</div>
	</header>
	<main>
	<table class="table">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Login</th>
			<th scope="col">Senha</th>
			<th scope="col">Telefone</th>
			<th scope="col">CPF</th>
			<th scope="col">Sexo</th>
			<th scope="col">Data de Nascimento</th>
			<th scope="col">Cidade</th>
			<th scope="col">Estado</th>
			<th scope="col">Usuário</th>
			<th scope="col">...</th>

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
						<button><a href='edita.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
						<button><a href='deleta.php?ID_Usuario=$linha[ID_Usuario]'>Excluir</a></button>
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
	<br><br>
	<div>
		<input type="search" placeholder="Procure aqui" id="pesquisar2">
		<button onclick="searchData2()">Pesquisar</button>
	</div>
	<table class="table">
		<thead>
			<tr>
			<th scope="col">#</th>
			<th scope="col">Nome</th>
			<th scope="col">Descrição</th>
			<th scope="col">Preço</th>
			<th scope="col">Proprietário</th>
			<th scope="col">Categoria</th>
			<th scope="col">...</th>

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
						<button><a href='deletaProduto.php?ID_Produto=$linha[ID_Produto]'>Excluir</a></button>
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
	</main>
	<br><br><br>
	<hr>
	<button><a href="anuncio.php">Anuncie um produto</a></button>
</body>
<script>
	var search = document.getElementById('pesquisar');

	var search2 = document.getElementById('pesquisar2');

	search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });


	function searchData()
	{
		window.location = 'sistema.php?search='+search.value;
	}

	function searchData2()
	{
		window.location = 'sistema.php?search2='+search2.value;
	}

</script>
</html>