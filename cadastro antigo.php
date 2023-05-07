<?php
/* Verificar se o formulario foi submitado */
if(isset($_POST['submit']))
{
    include_once('conexao.php');

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['genero'];
    $dataNasc = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipoUsuario = $_POST['escolha'];

    //Criptografa Senha
	

    // Insere os dados na tabela tb_usuario
    $result1 = mysqli_query($conexao, "INSERT INTO tb_usuario(Login, Senha, Telefone, cpf, ID_TipoSexo, DataNasc, Estado, Cidade, ID_TipoUsu)
    VALUES ('$login', '$senha', '$telefone', '$cpf', '$sexo', '$dataNasc', '$estado', '$cidade', '$tipoUsuario')");

    if($result1) {
        echo "Usuário cadastrado com sucesso!";
        if ($_POST['escolha'] == 2){
            header('Location: login.php');
        }
        if($_POST['escolha'] == 3){
            header('Location: login2.php');
        }
        
    } else {
        echo "Erro ao cadastrar usuário!";
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Formulário</title>
</head>
<body>
    <nav>
        <button>
            <a href="login.php">Ja possui uma conta de locador?</a>
        </button>
        <button>
            <a href="login2.php">Ja possui uma conta de locatário?</a>
        </button>
    </nav>
    <div class="box">
        <form action="cadastro.php" method="POST" onsubmit="return validar()">
            <fieldset>
                <legend><b>Cadastro de locador</b></legend>
                <br>
                <div class="inputBox" id="inputError">
                    <input type="text" name="login" id="login" class="inputUser" required>
                    <label for="login" class="labelInput">Login</label>
                    <p id="teste"></p>
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
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br>
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
                <br>
                <div>
                    <label for="">Escolha: </label>
                    <select name="escolha" required>
                        <option value="">Lr</option>
                        <option value="2">Locador</option>
                        <option value="3">Locatário</option>
                    </select>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
    <script>
        function validar() {
            var senha = document.getElementById("senha");
            var regexSenha = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
            if (!regexSenha.test(senha.value)) {
                alert("A senha deve ter no mínimo 8 caracteres, uma letra maiúscula e um número.");
                senha.classList.add("inputError");
                senha.focus();
                return false;
            } else {
                senha.classList.remove("inputError");
            }
            var teste = document.getElementById("teste");
            var login = document.getElementById("login");
            var regexLogin = /^(?=.*[A-Z])(?=\S{4,})/;
            if (!regexLogin.test(login.value)) {
                teste.innerHTML("sdsddsdsds")
                login.classList.add("inputError");
                login.focus();
                return false;
            } else {
                login.classList.remove("inputError");
            }
            return true;
        }    
</script>
</body>
</html>