<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha']) && !empty($_POST['escolha'])) {
        include_once('conexao.php');
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $tipoUsuario = $_POST['escolha'];

        $sql = "SELECT * FROM `tb_usuario` WHERE login = '$login' and ID_TipoUsu = '$tipoUsuario'";

        $result = $conexao->query($sql);
        $usuario = $result->fetch_assoc();

        if(md5($senha) === $usuario['Senha']) {
            if ($_POST['escolha'] == 1){
                $_SESSION['login'] = $login;
                header('Location: sistema.php');
            }
            elseif ($_POST['escolha'] == 3){
                $_SESSION['login'] = $login;
                header('Location: locatarioPerfil.php');
            }
        }
        else{
            header('Location: login2.php');
        }
    }
    else
    {
        header('Location: login2.php');
    }
?>