<?php
session_start();

include_once('conexao.php');

if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('Location: login.php');
	exit();
}

$idAluguel = $_GET['id'];

// Atualiza o campo "aceitado" para true no banco de dados
$sql = "UPDATE tb_aluguel SET Permissao = true WHERE ID_aluguel = '$idAluguel'";
$conexao->query($sql);

// Redireciona de volta para a página anterior
header('Location: locadorPerfil.php');
exit();
?>