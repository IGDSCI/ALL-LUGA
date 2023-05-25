

<?php
session_start();

include_once('conexao.php');

// Verifica se os campos foram enviados pelo formulário
if (isset($_POST['valor']) && isset($_POST['dias']) && isset($_POST['produtoID']) && isset($_POST['nomeLocatario'])) {
    $valor = $_POST['valor'];
    $dias = $_POST['dias'];
    $produtoID = $_POST['produtoID'];
    $nomeLocatario = $_POST['nomeLocatario'];
    $nomeLocador = $_POST['nomeLocador'];

    // Insira o código necessário para armazenar os dados no banco de dados
    // Use as variáveis $campo1, $campo2 e $produtoID para obter os valores dos campos

    // Exemplo de inserção de dados no banco de dados
    $sql = "INSERT INTO tb_aluguel (Valor, Dias, ID_Produto, Nome_Locatario, Nome_Locador) VALUES ('$valor', '$dias', '$produtoID', '$nomeLocatario', '$nomeLocador')";
    if ($conexao->query($sql)) {
        echo "Dados do aluguel foram armazenados no banco de dados com sucesso.";
    } else {
        echo "Ocorreu um erro ao armazenar os dados do aluguel: " . $conexao->error;
    }
} else {
    echo "Dados do aluguel não foram enviados corretamente.";
}
?>