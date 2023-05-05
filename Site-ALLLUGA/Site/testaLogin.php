<?php
    session_start();
    //print_r($_REQUEST);
    //Validação
    if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['cpf']) && !empty($_POST['escolha']))
    {
        //Acessa
        include_once('conexao.php');
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $cpf = $_POST['cpf'];
        $tipoUsuario = $_POST['escolha'];

        //print_r('Login: ' . $login);
        //print_r('<br>');
        //print_r('Senha: ' . $senha);

        $sql = "SELECT * FROM `tb_usuario` WHERE login = '$login' and senha = '$senha' and cpf = '$cpf' and ID_TipoUsu = '$tipoUsuario'";

        //conexao foi realizada no arquivo conexao.php, vai estar executando o comando do php no banco de dados.
        $result = $conexao->query($sql);

        //print_r($sql);
        //print_r($result);

        //Vai verificar se o numero de linhas do banco de dados for menor que 1, se isso ocorrer nao existe registro no banco de dados.
        // header serve para redirecionar para outro local no php.
        if(mysqli_num_rows($result) < 1){
            //print_r('Não existe registro!');
            //unset para destruir as variaveis.
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            unset($_SESSION['cpf']);
            unset($_SESSION['escolha']);
            header('Location: login.php');
        } else{
            //print_r('Existe regitro!');
            if ($_POST['escolha'] == 1){
                $_SESSION['login'] = $login;
                header('Location: sistema.php');
            }
            if ($_POST['escolha'] == 2){
                $_SESSION['login'] = $login;
                header('Location: locadorPerfil.php');
            }

        }
    }
    else
    {
        //Não acessa
        header('Location: login.php');
    }

?>