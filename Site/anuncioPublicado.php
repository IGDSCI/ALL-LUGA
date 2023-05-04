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
    <a class="linkproduto" href="#"> <div class="card-container">
    <div id="produtos">
        <div id="card-content">
        <table class="table" id="tabela1">
		<thead>
			<tr>
            <th class="tabela" scope="col">#</th>
			<th class="tabela" scope="col">Nome</th>
			<th class="tabela" scope="col">Descricao</th>
			<th class="tabela" scope="col">Preço</th>
			<th class="tabela" scope="col">Foto</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Verifica se a consulta retornou resultados
				if ($result2 && $result->num_rows > 0) {
					// Loop sobre cada linha de resultados
					while ($linha = $result2->fetch_assoc()) {
					// Exibe os dados na tabela HTML
					echo "<tr>";
					echo "<td>".$linha['ID_Produto']."</td>";
					echo "<td>".$linha['Nome']."</td>";
					echo "<td>".$linha['Descricao']."</td>";
					echo "<td>".$linha['Preco']."</td>";
					echo "<td>".$linha['Foto']."</td>";
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
        <div id="card-content">
        <table class="table" id="tabela1">
		<thead>
			<tr>
            <th class="tabela" scope="col">#</th>
			<th class="tabela" scope="col">Nome</th>
			<th class="tabela" scope="col">Descricao</th>
			<th class="tabela" scope="col">Preço</th>
			<th class="tabela" scope="col">Foto</th>
			</tr>
		</thead>
		<tbody>
			<?php
				// Verifica se a consulta retornou resultados
				if ($result2 && $result->num_rows > 0) {
					// Loop sobre cada linha de resultados
					while ($linha = $result2->fetch_assoc()) {
					// Exibe os dados na tabela HTML
					echo "<tr>";
					echo "<td>".$linha['ID_Produto']."</td>";
					echo "<td>".$linha['Nome']."</td>";
					echo "<td>".$linha['Descricao']."</td>";
					echo "<td>".$linha['Preco']."</td>";
					echo "<td>".$linha['Foto']."</td>";
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
        <div id="card-content">
            <img class="imagemproduto" src="Images/produto3.jpg">
            <h3 class="nome-produto">GTA 5</h3>
            <p class="descricao-produto">bnbhasehbfba</p>
            <div class="preco-produto">preço</div>
            <button class="botao-comprar">Comprar</button>
        </div>
        <div id="card-content">
            <img class="imagemproduto" src="Images/produto 4.jpg">
            <h3 class="nome-produto">Red Dead 1</h3>
            <p class="descricao-produto">bnbhasehbfba</p>
            <div class="preco-produto">preço</div>
            <button class="botao-comprar">Comprar</button>
        </div>
        <div id="card-content">
            <img class="imagemproduto" src="Images/produto5.jpg">
            <h3 class="nome-produto">Camisa Time</h3>
            <p class="descricao-produto">bnbhasehbfba</p>
            <div class="preco-produto">preço</div>
            <button class="botao-comprar">Comprar</button>
        </div>
    </div></a>
    <a class="linkproduto" href="#"> <div class="card-container">
        <div id="produtos">
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto1.jpg">
                <h3 class="nome-produto">Vassoura</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto2.jpg">
                <h3 class="nome-produto">Red Dead 2</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto3.jpg">
                <h3 class="nome-produto">GTA 5</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto 4.jpg">
                <h3 class="nome-produto">Red Dead 1</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto5.jpg">
                <h3 class="nome-produto">Camisa Time</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
        </div></a>
    <a class="linkproduto" href="#"> <div class="card-container">
        <div id="produtos">
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto1.jpg">
                <h3 class="nome-produto">Vassoura</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto2.jpg">
                <h3 class="nome-produto">Red Dead 2</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto3.jpg">
                <h3 class="nome-produto">GTA 5</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto 4.jpg">
                <h3 class="nome-produto">Red Dead 1</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
            <div id="card-content">
                <img class="imagemproduto" src="Images/produto5.jpg">
                <h3 class="nome-produto">Camisa Time</h3>
                <p class="descricao-produto">bnbhasehbfba</p>
                <div class="preco-produto">preço</div>
                <button class="botao-comprar">Comprar</button>
            </div>
        </div></a>



</body>
</html>
