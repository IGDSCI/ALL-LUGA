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

	if(!empty($_GET['search']))
	{
		$data = $_GET['search'];

		$sql2 = "SELECT * FROM tb_produto
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		WHERE Nome LIKE '%$data%' OR Descricao LIKE '%$data%'OR TipoCategoria LIKE '%$data%'";
	}
	else
	{
		$sql2 = "SELECT tb_produto.*, tb_categoria.TipoCategoria
		FROM tb_produto
		INNER JOIN tb_categoria ON tb_produto.ID_TipoCat = tb_categoria.ID_Categoria
		ORDER BY tb_produto.ID_Produto DESC";
	}

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
    <a class="linkproduto" href="#"> <div class="card-container">
    <div id="produtos">
        <div id="card-content">
        <table class="table" id="tabela1">
		<thead>
			<tr>
			<th class="tabela" scope="col">Nome</th>
			<th class="tabela" scope="col">Descricao</th>
			<th class="tabela" scope="col">Preço</th>
			<th class="tabela" scope="col">Foto</th>
			</tr>

            <td></td>
		</thead>
		<tbody>
			<?php
				// Verifica se a consulta retornou resultados
				if ($result2 && $result2->num_rows > 0) {
					// Loop sobre cada linha de resultados
					while ($linha = $result2->fetch_assoc()) {
					// Exibe os dados na tabela HTML
					echo "<tr>";
					echo "<td>".$linha['Nome']."</td>";
					echo "<td>".$linha['Descricao']."</td>";
					echo "<td>".$linha['Preco']."</td>";
                    echo "<td><img width=100px src=".$linha['Foto']."></td>";
					echo "</tr>";
					}
				} else {
					// Se a consulta não retornou resultados, exibe uma mensagem de erro
					echo "Nenhum registro encontrado.";
				}
			?>
		</tbody>
	</table>
        </div>
        

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
		window.location = 'anuncioPublicado.php?search='+search.value;
	}

</script>

</html>
