<?php
/* Verificar se o formulario foi submitado */
if(isset($_POST['submit']))
{
    include_once('conexao.php');

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['genero'];
    $dataNasc = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipoUsuario = $_POST['escolha'];

    //Criptografa Senha
	

    // Insere os dados na tabela tb_usuario
    $result1 = mysqli_query($conexao, "INSERT INTO tb_usuario(Login, Senha, Telefone, cpf, ID_TipoSexo, DataNasc, Estado, Cidade, ID_TipoUsu)
    VALUES ('$login', '$senha', '$telefone', '$cpf', '$sexo', '$dataNasc', '$estado', '$cidade', '$tipoUsuario')");

    if($result1) {
        echo "Usuário cadastrado com sucesso!";
        if ($_POST['escolha'] == 2){
            header('Location: login.php');
        }
        if($_POST['escolha'] == 3){
            header('Location: login2.php');
        }
        
    } else {
        echo "Erro ao cadastrar usuário!";
    }

}
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
        <link rel="stylesheet" href="Css/Cadastro.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Rubik&display=swap" rel="stylesheet">

    </head>

    <body>
        <div class="main-section">
            <div class="left-container">
                    
            </div>

            <div class="right-container">
                <div class="right-control fade-in-image">
                    <h2>FAÇA SEU CADASTRO</h2>
                    <form method="post" action="testaLogin.php">
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="login" placeholder="Login:" required>
                        </div>
                        <div class="form-control">  
                            <div class="side-bar"></div>
                            <input type="password" class="input-text" id="input-senha" name="senha" placeholder="Senha:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="cpf" placeholder="CPF:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="telefone" placeholder="Telefone:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <div class="input-text">
                                
                                <input type="radio" id="masculino" name="genero" value="1"  required>
                                <label for="feminino">Masculino</label>
                                <input type="radio" id="feminino" name="genero" value="2"  required>
                                <label for="masculino">Feminino</label>
                                <input type="radio" id="naoInformar" name="genero" value="3" placeholder="nao" required>
                                <label for="naoInformar" >Não informar</label>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="input-text" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="cidade" placeholder="Cidade:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="estado" placeholder="Estado:" required>
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <select name="escolha" class="input-text" required>
                                <option value="" >Escolha: Locador/Locatário</option>
                                <option value="2" >Locador</option>
                                <option value="1" >Locatário</option>
                            </select>
                        </div>
                    <a href="login2.php"><h3 class="register">Entrar como Locatário</h3></a>
                    <a href="cadastro.php"><h3 class="register">Entrar como Locador</h3></a>
                    <input class="input-submit" type="submit" name="submit" id="submit" value="ENTRAR">
                    </form>
                </div>
            </div>
        </div>
    </body>