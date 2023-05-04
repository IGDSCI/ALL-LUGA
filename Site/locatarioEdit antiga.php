<?php

if (!empty($_GET['ID_Usuario'])) {
    include_once('conexao.php');

    $ID_Usuario = $_GET['ID_Usuario'];

    $sqlSelect = "SELECT * FROM tb_usuario WHERE ID_Usuario=$ID_Usuario";

    $result = $conexao->query($sqlSelect);
    
    if ($result->num_rows > 0) {
        while ($linha = mysqli_fetch_assoc($result)) {
            $login = $linha['Login'];
            $senha = $linha['Senha'];
            $telefone = $linha['Telefone'];
            $cpf = $linha['cpf'];
            $sexo = $linha['ID_TipoSexo'];
            $dataNasc = $linha['DataNasc'];
            $cidade = $linha['Cidade'];
            $estado = $linha['Estado'];
        }
        print_r($login);
    }
} else {
    header('Location: locatarioPerfil.php');

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Formulário</title>
</head>
<body>
    <div class="box">
        <form action="locatarioSalvaEdit.php" method="POST">
            <fieldset>
                <legend><b>Cadastro de locador</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="login" id="login" class="inputUser" value="<?php echo $login?>" readonly>
                    <label for="login" class="labelInput">Login</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" value="<?php echo $senha?>" readonly>
                    <label for="password" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo $telefone?>"required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" value="<?php echo $cpf?>"required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="masculino" name="genero" value="1" <?php echo ($sexo == 1) ? 'checked' : '' ?> required>
                <label for="feminino">Masculino</label>
                <br>
                <input type="radio" id="feminino" name="genero" value="2" <?php echo ($sexo == 2) ? 'checked' : '' ?> required>
                <label for="masculino">Feminino</label>
                <br>
                <input type="radio" id="naoInformar" name="genero" value="3" <?php echo ($sexo == 3) ? 'checked' : '' ?> required>
                <label for="naoInformar">Não informar</label>
                <br><br>
                <label for="data_nascimento"><b>Data de nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $dataNasc?>"required>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" value="<?php echo $cidade?>"required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" value="<?php echo $estado?>"required>
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <br><br>
                <br><br>
                <input type="hidden" name="ID_Usuario" value="<?php echo $ID_Usuario?>">
                <input type="submit" name="update" id="update">
            </fieldset>
        </form>
    </div>
</body>
</html>