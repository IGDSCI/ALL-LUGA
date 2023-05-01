<?php

    if(!empty($_GET['ID_Usuario']))
    {
        include_once('conexao.php');

        $ID_Usuario = $_GET['ID_Usuario'];

        $sqlSelectUsuario = "SELECT * FROM tb_usuario WHERE ID_Usuario=$ID_Usuario"; 

        $resultUsuario = $conexao->query($sqlSelectUsuario);
    
        if($resultUsuario->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM tb_usuario WHERE ID_Usuario=$ID_Usuario";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: sistema.php');


?>