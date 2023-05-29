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
            $cep = $linha['cep'];
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
        echo "Usuário cadastrado com sucesso!";
        if ($_POST['escolha'] == 2) {
            header('Location: login.php');
        }
        if ($_POST['escolha'] == 3) {
            header('Location: login2.php');
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

    <link rel="stylesheet" type="text/css" href="Css/style.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
          <style>
    @import url('https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat&family=Roboto+Condensed:wght@300&display=swap');

    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
    }

    :root {
        --cor-primaria: #0A2647;
        --cor-secundaria: #144272;
        --cor-terciaria: #205295;
        --cor-quaternaria: #2C74B3; 
        --cor-quintenaria: #d7d7d7;
    }


    .main-section {
        font-family: 'Montserrat', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-image: url(arquivos/background.jpg);
        background-size: 1920px 1080px;
        
    }

    h2 {
        text-align: center;
        color: white;
        margin: 10px
    }

    .right-container {
        width: 450px;
        height: 800px;
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 3px;
        background-image: linear-gradient(to right, var(--cor-quaternaria), var(--cor-primaria));
        margin: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 1px 1px 1px 1px black;
    }
    .right-container:hover{
        transform: scale(1.01);
    }

    .form-control {
        margin-bottom: 20px;
    }

    .input-text {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        color: black;
    }
    .input-text:hover{
        transform: scale(1.01);
    }

    .input-submit {
    font-family: 'Roboto Condensed', sans-serif;
    align-items: center;
    align-self: center;
    display: inline-block;
    padding: 10px 40px;
    border: none;
    border-radius: 4px;
    font-size: 20px;
    text-align: center;
    font-weight:bold;
    text-decoration: none;
    background-color: var(--cor-quaternaria);
    color: white;
    margin-left: 90px;
}
    .radio-control label {
        color: white;
        align-itens: center;
    }


    .input-submit:hover {
        background-color: var(--cor-primaria);
        transform: scale(1.1);
    }

        .span-required {
            display: none;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: normal;
            font-style: normal;
            font-display: swap;
            font-size: 16px;
        }
    
</style>

</head>

<html lang="pt-br">

<head>
    <title> All Luga </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="Css/style.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</head>

<body>
<header class="cabecalho">
        <a href="principal.php"> <img id="logo" src="Images/LOGOALLLUGA.png"></a>
    </header>
    <div class="main-section">
        
        <div class="left-container">

        </div>

        <div class="right-container">
            <div class="right-control fade-in-image">
                <h2>EDITE SEU PERFIL</h2>
                <form method="post" action="locadorSalvaEdit.php" id="form">
                    <div class="form-control">

                        <input type="text" class="input-text" id="input-login" name="login" value="<?php echo $login ?>" placeholder="Login:" style="opacity: .4;" readonly>
                    </div>
                    <div class="form-control">

                        <input type="password" class="input-text" id="input-senha" value="<?php echo $senha ?>" name="senha" placeholder="Senha:" style="opacity: .4;" readonly>
                    </div>
                    <div class="form-control">

                        <input type="text" class="input-text" id="cpf" value="<?php echo $cpf ?>" name="cpf" placeholder="CPF:" maxlength="14" required>
                    </div>
                    <span class='span-required'>Formato esperado: XXXXXXXXXXX</span>
                    <div class="form-control">

                        <input type="text" class="input-text required" id="tel" name="telefone" value="<?php echo $telefone ?>" placeholder="Telefone:" maxlength="14" oninput="telefoneValidate()" required>
                    </div>
                    <span class='span-required'>Formato esperado: (XX) XXXX-XXXX ou (XX) XXXXX-XXXX</span>
                    <div class="form-control">

                        <div class="input-text radio-control">

                            <input type="radio" id="masculino" name="genero" value="1" <?php echo ($sexo == 1) ? 'checked' : '' ?> required>
                            <label for="feminino">Masculino</label>
                            <input type="radio" id="feminino" name="genero" value="2" <?php echo ($sexo == 2) ? 'checked' : '' ?> required>
                            <label for="masculino">Feminino</label>
                            <input type="radio" id="naoInformar" name="genero" value="3" <?php echo ($sexo == 3) ? 'checked' : '' ?> required>
                            <label for="naoInformar">Não informar</label>
                        </div>
                    </div>
                    <div class="form-control">
                        <input type="date" name="data_nascimento" id="data_nascimento" class="input-text" value="<?php echo $dataNasc ?>" required>
                    </div>
                    <span id="erro-data"></span>
                    <div class="form-control">
                        <div class=""></div>
                        <input type="text" class="input-text required" id="cep" name="cep" placeholder="CEP:" maxlength="9" value="<?php echo $cep ?>" maxlength="9" required>
                    </div>
                    <div class="form-control">
                        <input type="text" class="input-text required" id="cidade" name="cidade" placeholder="Cidade:"   value="<?php echo $cidade ?>" readonly required>
                    </div>
                    <span class='span-required'>A cidade dever ser escrita somente com letras</span>
                    <div class="form-control">
                        <input type="text" class="input-text required" id="estado" name="estado" placeholder="Estado:" value="<?php echo $estado ?>"  readonly required>
                    </div>
                    <span class='span-required'>O estado dever ser escrito somente com letras</span>
                    <div class="form-control">
                    </div>
                    <input type="hidden" name="ID_Usuario" value="<?php echo $ID_Usuario ?>">
                    <input class="input-submit" type="submit" name="update" id="submit" value="EDITAR">
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/cpf.js"></script>
<script type="text/javascript" src="js/tel.js"></script>
<script type="text/javascript" src="js/cep.js"></script>
<script type="text/javascript" src="js/cepMask.js"></script>
<script>
    const inputDataNascimento = document.getElementById('data_nascimento');
    const errorText = document.getElementById("erro-data");
    inputDataNascimento.addEventListener('change', function() {
        if (!validarDataNascimento(this.value)) {
            errorText.innerHTML = "Sua data de nascimento está em formato errado ou você é menor de 18 anos";
            this.style.border = "2px solid red";
            errorText.style.color = "red";
            this.value = '';
        } else {
            this.style.border = ""; // removendo a borda
            errorText.style.color = ""; // removendo a cor
            errorText.innerHTML = "";
        }
    });

    function validateEscolha(select) {
        if (select.value === "") {
            select.setCustomValidity("Escolha uma opção válida.");
        } else {
            select.setCustomValidity("");
        }
    }

    function validarDataNascimento(data) {
        // Obtém a data atual
        const dataAtual = new Date();

        // Obtém a data de nascimento do input e converte para um objeto Date
        const dataNascimento = new Date(data);

        // Verifica se a data de nascimento é maior que a data atual
        if (dataNascimento > dataAtual) {
            return false;
        }

        // Calcula a idade a partir da data de nascimento
        const diffAnos = dataAtual.getFullYear() - dataNascimento.getFullYear();
        const diffMeses = dataAtual.getMonth() - dataNascimento.getMonth();
        const diffDias = dataAtual.getDate() - dataNascimento.getDate();

        // Verifica se a pessoa tem pelo menos 18 anos
        if (diffAnos < 18 || (diffAnos === 18 && diffMeses < 0) || (diffAnos === 18 && diffMeses === 0 && diffDias < 0)) {
            return false;
        }

        // A data de nascimento é válida
        return true;
    }


    const form = document.getElementById('form');
    const campos = document.querySelectorAll('.required');
    const spans = document.querySelectorAll('.span-required');
    const regexTelefone = /(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/;

    form.querySelectorAll('input, select, textarea').forEach((element) => {
        element.addEventListener('change', (event) => {

            if (!regexTelefone.test(campos[0].value)) {
                setError(0);
                document.getElementById("submit").disabled = true;
                return;
            } else {
                document.getElementById("submit").disabled = false;
                removeError(0);
            }

            return true;

        });
    });





    function setError(index) {
        campos[index].style.border = '2px solid #e63636'
        spans[index].style.display = 'block';
    }

    function removeError(index) {
        campos[index].style.border = ''
        spans[index].style.display = 'none';
    }

    // function cpfValidate() {
    //     if (!regexCPF.test(campos[0].value)) {
    //         setError(0);
    //     } else {
    //         removeError(0);
    //     }
    // }

    function telefoneValidate() {
        if (!regexTelefone.test(campos[0].value)) {
            setError(0);
        } else {
            removeError(0);
        }
    }

    function cidadeValidate() {
        if (campos[2].value.match(/^[a-zA-Zà-úÀ-Ú ]+$/)) {
            removeError(2);
        } else {
            setError(2);
        }
    }

    function estadoValidate() {
        if (campos[3].value.match(/^[a-zA-Zà-úÀ-Ú ]+$/)) {
            removeError(3);
        } else {
            setError(3);
        }
    }
</script>
</body>