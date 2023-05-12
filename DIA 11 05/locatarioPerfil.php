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
            .editar{
				padding: 5px 10px;
				font-size: 14px;
				font-weight: 400;
				border: 2px solid rgb(73, 143, 71);
				border-radius: 5px;
				background-color: white;
				cursor: pointer; 
				position: relative;
				text-align: center;
				overflow: hidden;
				background-color: rgb(34, 100, 72);
			}

			.editar a{
				color: rgb(29, 179, 96);
				text-decoration: none;
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
						
                        
                        <h2 class="header-h2">Lorem ipsum dolor sit amet, consectetuer adipiscing.<br> elit, sed diam lorem Lorem.</h2>
                    </div>
                </div>

                <div class="data-container">
                    <div class="data-content">
						<?php if ($result && $result->num_rows > 0) {
								while ($linha = $result->fetch_assoc()) {
								echo "<p> Login: ".$linha['Login']."</p>";
								echo '<hr>';
								echo "<p> Telefone: ".$linha['Telefone']."</p>";
								echo '<hr>';
								echo "<p> CPF: ".$linha['cpf']."</p>";
								echo '<hr>';
								echo "<p> Gênero: ".$linha['Genero']."</p>";
								echo '<hr>';
								echo "<p> Data de nascimento: ".$linha['DataNasc']."</p>";
								echo '<hr>';
								echo "<p> Cidade: ".$linha['Cidade']."</p>";
								echo '<hr>';
								echo "<p> Estado: ".$linha['Estado']."</p>";
								echo '<hr>';
								echo "<p> Tipo: ".$linha['Tipo']."</p>";
								echo "<td>
						<button class='editar'><a href='locatarioEdit.php?ID_Usuario=$linha[ID_Usuario]'>Editar</a></button>
						<button class='editar'><a href='anuncioPublicado.php'>Anucios</a></button>
					</td>";
								}
							}else {
								echo "Nenhum registro encontrado.";
						} ?>
                    </div>
                </div>

                
            </div>
            <div class="right-container">
            
            </div>
        </div>
    </body>

</html>