<?php
/* Verificar se o formulário foi submetido */
if (isset($_POST['submit'])) {
    include_once('conexao.php');

    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $confirmaSenha = md5($_POST['confirmaSenha']);
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['genero'];
    $dataNasc = $_POST['data_nascimento'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $tipoUsuario = $_POST['escolha'];

    if (empty($login) || empty($telefone) || empty($cpf)) {
        echo '<script>alert("Erro: Preencha todos os campos!")</script>';
    } else {
        $sqlVerificaLogin = $conexao->query("SELECT Login FROM tb_usuario WHERE Login='$login'");
        $linhaLogin = $sqlVerificaLogin->num_rows;
        $sqlVerificaCPF = $conexao->query("SELECT cpf FROM tb_usuario WHERE cpf='$cpf'");
        $linhaCPF = $sqlVerificaCPF->num_rows;
        $sqlVerificaTelefone = $conexao->query("SELECT Telefone FROM tb_usuario WHERE Telefone='$telefone'");
        $linhaTelefone = $sqlVerificaTelefone->num_rows;
        if ($linhaLogin >= 1) {
            $mensagem1 = true;
            echo "<script>var mensagem1 = 'Já existe um usuário cadastrado com esse Nome!';</script>";
        }

        if ($senha == $confirmaSenha) {

        } else {
            $mensagem4 = true;
            echo "<script>var mensagem4 = 'Suas senhas não coincidem!';</script>";
        }

        if ($linhaCPF >= 1) {
            $mensagem2 = true;
            echo "<script>var mensagem2 = 'Já existe um usuário cadastrado com esse CPF!';</script>";
        }
        if ($linhaTelefone >= 1) {
            $mensagem3 = true;
            echo "<script>var mensagem3 = 'Já existe um usuário cadastrado com esse Telefone!';</script>";
        }

        if ($senha == $confirmaSenha) {

        } else {
            $mensagem4 = true;
            echo "<script>var mensagem4 = 'Suas senhas não coincidem!';</script>";
        }


        if ($confirmaSenha == $senha and $linhaLogin == 0 and $linhaCPF == 0 and $linhaTelefone == 0) {

            // Insere os dados na tabela tb_usuario
            $result1 = mysqli_query($conexao, "INSERT INTO tb_usuario(Login, Senha, Telefone, cpf, ID_TipoSexo, DataNasc, cep, Estado, Cidade, ID_TipoUsu)
    VALUES ('$login', '$senha', '$telefone', '$cpf', '$sexo', '$dataNasc', '$cep', '$estado', '$cidade', '$tipoUsuario')");

            if ($result1) {
                if ($_POST['escolha'] == 2) {
                    header('Location: login.php');
                }
                if ($_POST['escolha'] == 3) {
                    header('Location: login2.php');
                }
            } else {
                echo '<script>alert("Erro")</script>';
            }
        }
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
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <style>
            .custom-toastfy{
                font-family: 'Gotham';
                src: url('../js/Gotham-Book.eot');
                src: url('../js/Gotham-Book.eot?#iefix') format('embedded-opentype'),
                    url('../js/Gotham-Book.woff2') format('woff2'),
                    url('../js/Gotham-Book.woff') format('woff'),
                    url('../js/Gotham-Book.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
                font-display: swap;
            }

            .span-required{
                display: none;
                color: red;
                font-family: 'Gotham';
                src: url('../js/Gotham-Book.eot');
                src: url('../js/Gotham-Book.eot?#iefix') format('embedded-opentype'),
                    url('../js/Gotham-Book.woff2') format('woff2'),
                    url('../js/Gotham-Book.woff') format('woff'),
                    url('../js/Gotham-Book.ttf') format('truetype');
                font-weight: normal;
                font-style: normal;
                font-display: swap;
                font-size: 16px;
            }

        </style>

    </head>

    <body>
        <div class="main-section">
                <video id="background-video" muted poster="Images/Grupo 61.jpg">
                <source src="Images/pexels-pixabay-854336-1920x1080-24fps.mp4" type="video/mp4">
                </video>
                <div class="right-container">
                    
                        <div class="right-control fade-in-image">
                            <h2>FAÇA SEU CADASTRO</h2>
                            <form id="form" method="post" action="cadastro.php">
                                <div class="form-control">
                                    <input type="text" class="input-text required" id="input-login" name="login" placeholder="Nome:" oninput="loginValidate()" required>
                                </div>
                                <span class = 'span-required'>O login deve possuir pelo menos 3 caracteres</span>
                                <div class="form-control">  
                                    <input type="password" class="input-text required" id="input-senha" name="senha" placeholder="Senha:" oninput="senhaValidate()" required>
                                </div>
                                <span class = 'span-required'>A senha deve possuir pelo menos 8 caracteres</span>
                                <div class="form-control">  
                                    <input type="password" class="input-text required" id="input-senha" name="confirmaSenha" placeholder="Confirme sua senha:" oninput="senhaConfirmaValidate()"  required>
                                </div>
                                <span class = 'span-required'>A senha deve possuir pelo menos 8 caracteres</span>
                                <div class="form-control">
                                    <input type="text" class="input-text required" id="cpf" name="cpf" placeholder="CPF:"  maxlength="14" required>
                                </div>
                                <span class = 'span-required'>Formato esperado: XXXXXXXXXXX</span>
                                <div class="form-control">
                                    <input type="text" class="input-text required" id="tel" maxlength="14" name="telefone" onkeydown="return filterNumeric(event)" placeholder="Telefone:" oninput="telefoneValidate()" required>
                                </div>
                                <span class = 'span-required'>Formato esperado: (XX) XXXX-XXXX ou (XX) XXXXX-XXXX</span>
                                <div class="form-control ">
                                    <div class="input-text radio-control">
                                        
                                        <input type="radio" id="masculino" name="genero" value="1" class="accent" required>
                                        <label for="feminino">Masculino</label>
                                        <input type="radio" id="feminino" name="genero" value="2" class="accent" required>
                                        <label for="masculino">Feminino</label>
                                        <input type="radio" id="naoInformar" name="genero" value="3" placeholder="nao" class="accent" required>
                                        <label for="naoInformar" >Não informar</label>
                                    </div>
                                </div>
                                <div class="form-control">
                                    <div class=""></div>
                                    <input type="date" name="data_nascimento" id="data_nascimento" class="input-text" required>
                                </div>
                                <span id="erro-data"></span>


                                <div class="form-control">
                                    <div class=""></div>
                                    <input type="text" class="input-text required" id="cep" name="cep" placeholder="CEP:" maxlength="9" required>
                                </div>
                                <div class="form-control">
                                    <div class=""></div>
                                    <input type="text" class="input-text required" id="cidade" name="cidade" placeholder="Cidade:" readonly required>
                                </div>
                                <div class="form-control">
                                    <div class=""></div>
                                    <input type="text" class="input-text required" id="estado" name="estado" placeholder="Estado:"  readonly required>
                                </div>

                                
                                <div class="form-control">
                                    <div class=""></div>
                                    <select name="escolha" class="input-text"  required>
                                        <option value="" >Escolha: Locador/Locatário</option>
                                        <option value="2" >Locador</option>
                                        <option value="3" >Locatário</option>
                                    </select>
                                </div>
                            <div class="register-container">
                            <a href="login2.php"><h3 class="register ">Entrar como Locatário</h3></a>
                            <a class="register2"href="login.php"><h3 class="register ">Entrar como Locador</h3></a>
                            </div>
                            <input class="input-submit" type="submit" name="submit" id="submit" value="ENVIAR">
                            
                            </form>
                    </div>
                </div>
        </div>
        <script type="text/javascript" src="js/cpf.js"></script>
        <script type="text/javascript" src="js/tel.js"></script>
        <script type="text/javascript" src="js/cep.js"></script>
        <script type="text/javascript" src="js/cepMask.js"></script>
        <script>
        if (typeof mensagem1!=='undefined') {
            Toastify({
                text: mensagem1,
                className: "custom-toastfy",
                duration: 12000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#0E4597",
            }).showToast();
        }

        if (typeof mensagem2!=='undefined') {
            Toastify({
                text: mensagem2,
                className: "custom-toastfy",
                duration: 12000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#0E4597",
            }).showToast();
        }

        if (typeof mensagem3!=='undefined') {
            Toastify({
                text: mensagem3,
                className: "custom-toastfy",
                duration: 12000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#0E4597",
            }).showToast();
        }

        if (typeof mensagem4!=='undefined') {
            Toastify({
                text: mensagem4,
                className: "custom-toastfy",
                duration: 12000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#0E4597",
            }).showToast();
        }
        


            const inputDataNascimento = document.getElementById('data_nascimento');
            const errorText = document.getElementById("erro-data");
            inputDataNascimento.addEventListener('change', function() {   
                if (!validarDataNascimento(this.value)) {
                    errorText.innerHTML = "Sua data de nascimento está em formato errado ou você é menor de 18 anos";
                    this.style.border = "2px solid red";
                    errorText.style.color = "red";
                    this.value = '';
                } else{
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
            const regexLogin = /^\w{3,}$/; 
            const regexSenha = /^.{8,}$/;
            const regexCPF = /^\d{14}$/;
            const regexTelefone = /(\(?\d{2}\)?\s)?(\d{4,5}\-\d{4})/;


            form.querySelectorAll('input, select, textarea').forEach((element) => {
                element.addEventListener('change', (event) => {
                    
                if (campos[0].value.length < 3){
                    setError(0);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                        removeError(0);
                        document.getElementById("submit").disabled = false;
                }

                if (campos[1].value.length < 8){
                    setError(1);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                        removeError(1);
                        document.getElementById("submit").disabled = false;
                }

                if (campos[2].value.length < 8){
                    setError(2);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                    document.getElementById("submit").disabled = false;
                    removeError(2);
                }

                /*if (!regexCPF.test(campos[3].value)){
                    setError(3);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                    document.getElementById("submit").disabled = false;
                    removeError(3);
                }*/
                
                /*if (!regexTelefone.test(campos[4].value)){
                    setError(4);
                    document.getElementById("submit").disabled = true;
                    return;
                } else {
                    document.getElementById("submit").disabled = false;
                    removeError(4);
                }*/


                return true;
                    
                });
            });
            


            function loginValidate(){
                if (campos[0].value.length < 3){
                    setError(0)
                    return
                } else {
                    removeError(0)
                }
            }

            function setError(index){
                campos[index].style.border = '2px solid #e63636'
                spans[index].style.display = 'block';
            }

            function removeError(index){
                campos[index].style.border = ''
                spans[index].style.display = 'none';
            }

            function senhaValidate(){
                if (campos[1].value.length < 8){
                    setError(1)
                } else {
                    removeError(1)
                }
            }

            function senhaConfirmaValidate(){
                if (campos[2].value.length < 8){
                    setError(2)
                } else {
                    removeError(2)
                }
            }

            function cpfValidate(){
                if (!regexCPF.test(campos[3].value)){
                    setError(3);
                } else {
                    removeError(3);
                }
            }

            function telefoneValidate(){
                if (!regexTelefone.test(campos[4].value)){
                    setError(4);
                } else {
                    removeError(4);
                }
            }


            function filterNumeric(event) {
                // Obtém o código da tecla pressionada
                var keyCode = event.keyCode || event.which;

                // Permite o uso da tecla Backspace (código 8)
                if (keyCode === 8) {
                    return true;
                }

                // Obtém o caractere correspondente ao código da tecla
                var char = String.fromCharCode(keyCode);

                // Verifica se o caractere é um número, espaço, parênteses ou hífen
                var pattern = /[0-9\s()-]/;

                // Permite a digitação apenas se o caractere corresponder ao padrão
                if (!pattern.test(char)) {
                    event.preventDefault();
                    return false;
                }
            }

            

            
    </script>
    </body>