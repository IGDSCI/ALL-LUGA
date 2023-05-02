<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['cpf']) && !empty($_POST['escolha'])) {
        include_once('conexao.php');
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $cpf = $_POST['cpf'];
        $tipoUsuario = $_POST['escolha'];

        $sql = "SELECT * FROM `tb_usuario` WHERE login = '$login' and cpf = '$cpf' and ID_TipoUsu = '$tipoUsuario'";

        $result = $conexao->query($sql);
        $usuario = $result->fetch_assoc();

        if(md5($senha) === $usuario['Senha']) {
            if ($_POST['escolha'] == 1){
                $_SESSION['login'] = $login;
                header('Location: sistema.php');
            }
            elseif ($_POST['escolha'] == 2){
                $_SESSION['login'] = $login;
                header('Location: anuncio.php');
            }
        }
        else{
            header('Location: login.php');
        }
    }
    else
    {
        header('Location: login.php');
    }
?>