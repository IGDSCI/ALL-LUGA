<?php

include_once('conexao.php');

    if(isset($_POST['update']))
    {

        global $login;

        $ID_Usuario = $_POST['ID_Usuario'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $sexo = $_POST['genero'];
        $dataNasc = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $sqlUpdateUsuario = "UPDATE tb_usuario SET Login='$login', Senha='$senha', Telefone='$telefone', cpf='$cpf', ID_TipoSexo='$sexo', DataNasc='$dataNasc', Cidade='$cidade', Estado='$estado' WHERE ID_Usuario='$ID_Usuario'";

        if ($conexao->query($sqlUpdateUsuario) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro ao atualizar registro: " . $conexao->error;
        }
    }


    header('Location: locatarioPerfil.php');

    return array(
		'login' => $login);



?>