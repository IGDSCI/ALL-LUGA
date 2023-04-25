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
    $logado = $_SESSION['login'];

	$sql = "SELECT tb_usuario.*, tb_sexo.Genero, tb_endereco.Estado, tb_endereco.Cidade, tb_endereco.CEP, tb_tipo_usuario.Tipo
	FROM tb_usuario
	INNER JOIN tb_sexo ON tb_usuario.ID_TipoSexo = tb_sexo.ID_Sexo
	INNER JOIN tb_endereco ON tb_usuario.ID_Endereco = tb_endereco.ID_Endereco
	INNER JOIN tb_tipo_usuario ON tb_usuario.ID_TipoUsu = tb_tipo_usuario.ID_TipoUsu
	ORDER BY tb_usuario.ID_Usuario DESC";

	$result = $conexao->query($sql);

	print_r($result);

?>
<!DOCTYPE html>
<html>
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
                    echo "<h1>Bem vindo <u>$logado</u></h1>";
                ?>
            </div>
            <div>
                <button><a href="sair.php ">Sair</a></button>
            </div>
		</nav>
		<div class="user-profile">
			<img src="avatar.png" alt="Avatar">
			<span>Bem-vindo, João</span>
			<a href="#">Sair</a>
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
			<th scope="col">Estado</th>
			<th scope="col">Cidade</th>
			<th scope="col">CEP</th>
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
					echo "<td>".$linha['Estado']."</td>";
					echo "<td>".$linha['Cidade']."</td>";
					echo "<td>".$linha['CEP']."</td>";
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
	</main>
</body>
</html>