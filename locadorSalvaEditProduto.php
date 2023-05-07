<?php

include_once('conexao.php');

    if(isset($_POST['update']))
    {

        $ID_Produto = $_POST['ID_Produto'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];

        $sqlUpdateProduto = "UPDATE tb_produto SET Nome='$nome', Descricao='$descricao', Preco='$preco', ID_TipoCat='$categoria' WHERE ID_Produto='$ID_Produto'";

        if ($conexao->query($sqlUpdateProduto) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro ao atualizar registro: " . $conexao->error;
        }
    }

    

    header('Location: locadorPerfil.php');




?>