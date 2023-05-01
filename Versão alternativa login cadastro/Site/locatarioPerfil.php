<?php
    session_start();

	include_once('conexao.php');

    
    if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
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

	$result = $conexao->query($sql);

	

	
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
	<button class="sair"><a href="sair.php ">Sair</a></button>
		<div class="logo">Sistema de Gerenciamento</div>
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
						<button class='editar'><a href='locatarioEdit.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
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
	</main>
	<button class="chamada-anuncio"><a href="anuncio.php">Anuncie um produto</a></button>
</body>
</html>