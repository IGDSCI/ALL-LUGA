<?php

    if(!empty($_GET['ID_Usuario']))
    {
        include_once('conexao.php');

        $ID_Usuario = $_GET['ID_Usuario'];

        $sqlSelect = "SELECT * FROM tb_usuario WHERE ID_Usuario=$ID_Usuario"; 
        $sqlSelectEndereco = "SELECT Cidade, Estado, Cep FROM tb_endereco WHERE ID_Endereco=$ID_Usuario";
        

        $result = $conexao->query($sqlSelect);
        $resultEndereco = $conexao->query($sqlSelectEndereco);

        if ($result->num_rows > 0)
        {
            while ($linha = mysqli_fetch_assoc($result)){
            $login = $linha['Login'];
            $senha = $linha['Senha'];
            $telefone = $linha['Telefone'];
            $cpf = $linha['cpf'];
            $sexo = $linha['ID_TipoSexo'];
            $dataNasc = $linha['DataNasc'];
            $cidade = $linha['Cidade'];
            $estado = $linha['Estado'];
            $cep = $linha['Cep'];
        }
        print_r($login);
        }
    }
    else{header('Location: sistema.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Formulário</title>
</head>
<body>
    <div class="box">
        <form action="cadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro de locador</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="login" id="login" class="inputUser" required>
                    <label for="login" class="labelInput">Login</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="password" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="masculino" name="genero" value="1"  required>
                <label for="feminino">Masculino</label>
                <br>
                <input type="radio" id="feminino" name="genero" value="2"  required>
                <label for="masculino">Feminino</label>
                <br>
                <input type="radio" id="naoInformar" name="genero" value="3"  required>
                <label for="naoInformar">Não informar</label>
                <br><br>
                <label for="data_nascimento"><b>Data de nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cep" id="cep" class="inputUser" required>
                    <label for="cep" class="labelInput">CEP</label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>