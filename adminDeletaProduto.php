<?php

    if(!empty($_GET['ID_Produto']))
    {
        include_once('conexao.php');

        $ID_Produto = $_GET['ID_Produto'];

        $sqlSelectProduto = "SELECT * FROM tb_produto WHERE ID_Produto=$ID_Produto"; 

        $resultProduto = $conexao->query($sqlSelectProduto);
    
        if($resultProduto->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM tb_produto WHERE ID_Produto=$ID_Produto";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: sistema.php');


?>