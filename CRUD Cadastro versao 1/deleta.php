<?php

    if(!empty($_GET['ID_Usuario']))
    {
        include_once('conexao.php');

        $ID_Usuario = $_GET['ID_Usuario'];

        $sqlSelectUsuario = "SELECT * FROM tb_usuario WHERE ID_Usuario=$ID_Usuario"; 
        $sqlSelectEndereco = "SELECT * FROM tb_endereco WHERE ID_Endereco=$ID_Usuario"; 

        $resultUsuario = $conexao->query($sqlSelectUsuario);
        $resultEndereco = $conexao->query($sqlSelectEndereco);

        if($resultUsuario->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM tb_usuario WHERE ID_Usuario=$ID_Usuario";
            $sqlDeleteEndereco = "DELETE FROM tb_endereco WHERE ID_Endereco=$ID_Usuario";
            $resultDelete = $conexao->query($sqlDelete);
            $resultDeleteEndereco = $conexao->query($sqlDeleteEndereco);
        }
    }
    header('Location: sistema.php');


?>