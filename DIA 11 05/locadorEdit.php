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
    }
} else {
    header('Location: locadorPerfil.php');
}
?>

<?php
/* Verificar se o formulario foi submitado */
if (isset($_POST['submit'])) {
    include_once('conexao.php');

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['genero'];
    $dataNasc = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];


    //Criptografa Senha


    // Insere os dados na tabela tb_usuario
    $result1 = mysqli_query($conexao, "INSERT INTO tb_usuario(Login, Senha, Telefone, cpf, ID_TipoSexo, DataNasc, Estado, Cidade)
    VALUES ('$login', '$senha', '$telefone', '$cpf', '$sexo', '$dataNasc', '$estado', '$cidade')");

    if ($result1) {
        if ($_POST['escolha'] == 2) {
            header('Location: login.php');
            echo "<script>alert('Registro atualizado com sucesso');</script>";
        }
        if ($_POST['escolha'] == 3) {
            header('Location: login2.php');
            echo "<script>alert('Registro atualizado com sucesso');</script>";
        }
    } else {
        echo "Erro ao cadastrar usuário!";
    }
}
?>

<html lang="pt-br">

<head>
    <title> All Luga </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="Css/Cadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Rubik&display=swap" rel="stylesheet">
    

</head>

<body>
    <div class="main-section">
        <div class="left-container">

        </div>

        <div class="right-container">
            <div class="right-control fade-in-image">
                <h2>EDITE SEU PERFIL</h2>
                <form method="post" action="locadorSalvaEdit.php">
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <input type="text" class="input-text" id="input-login" name="login" value="<?php echo $login ?>" placeholder="Login:" readonly>
                    </div>
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <input type="text" class="input-text" id="input-login" value="<?php echo $cpf ?>" name="cpf" placeholder="CPF:" required>
                    </div>
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <input type="text" class="input-text" id="input-login" name="telefone" value="<?php echo $telefone ?>" placeholder="Telefone:" required>
                    </div>
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <div class="input-text">

                            <input type="radio" id="masculino" name="genero" value="1" <?php echo ($sexo == 1) ? 'checked' : '' ?> required>
                            <label for="feminino">Masculino</label>
                            <input type="radio" id="feminino" name="genero" value="2" <?php echo ($sexo == 2) ? 'checked' : '' ?> required>
                            <label for="masculino">Feminino</label>
                            <input type="radio" id="naoInformar" name="genero" value="3" <?php echo ($sexo == 3) ? 'checked' : '' ?> required>
                            <label for="naoInformar">Não informar</label>
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="input-text" value="<?php echo $dataNasc ?>" required>
                    </div>
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <input type="text" class="input-text" id="input-login" name="cidade" placeholder="Cidade:" value="<?php echo $cidade ?>" required>
                    </div>
                    <div class="form-control">
                        <div class="side-bar"></div>
                        <input type="text" class="input-text" id="input-login" name="estado" placeholder="Estado:" value="<?php echo $estado ?>" required>
                    </div>
                    <div class="form-control">
                    </div>
                    <input type="hidden" name="ID_Usuario" value="<?php echo $ID_Usuario ?>">
                    <input class="input-submit" type="submit" name="update" id="submit" value="EDITAR">
                </form>
            </div>
        </div>
    </div>
</body>