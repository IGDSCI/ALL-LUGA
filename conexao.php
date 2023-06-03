<?php
    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = 'ghu_21032004';
    $dbName = 'allluga';

    /* mysqli O MySQLi é tanto processual quanto orientada por objeto – este último atributo foi herdado da versão mais antiga do MySQL. */
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    /*if ($conexao->connect_errno)
    {
        echo "Erro!";
    } 
    else{
        echo "Conexao efetuada com sucesso!";
    } */

?>