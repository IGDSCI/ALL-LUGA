<?php
    session_start();
    if(isset($_SESSION['error'])) {
        echo '<script>alert("'.$_SESSION['error'].'");</script>';
        unset($_SESSION['error']);
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
        <link rel="stylesheet" href="Css/Login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Rubik&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    </head>

    <body>
        <div class="main-section">
            <div class="left-container">
                    <div class="index">
                        <div class="p-control">
                        <p class="">BEM VINDO</p>
                        </div>
                        <h1 class="">FAÇA SEU LOGIN</h1>
                        <div class="line-bar"></div>
                    </div>
            </div>

            <div class="right-container">
                <div class="right-control fade-in-image">
                    <h2>INFORME A SUA CONTA DE LOCADOR</h2>
                    <form method="post" action="testaLogin.php">
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <input type="text" class="input-text" id="input-login" name="login" placeholder="Nome:">
                        </div>
                        <div class="form-control">  
                            <div class="side-bar"></div>
                            <input type="password" class="input-text" id="input-senha" name="senha" placeholder="Senha:">
                        </div>
                        <div class="form-control">
                            <div class="side-bar"></div>
                            <select name="escolha" class="input-text" required >
                                <option value="2" class="input-text">Locador</option>
                                <option value="1" class="input-text">Administrador</option>
                            </select>
                        </div>
                    <a href="cadastro.php"><h3 class="register">Ainda não é membro?</h3></a>
                    <a href="login2.php"><h3 class="register">Entrar como Locatário</h3></a>
                    <input class="input-submit" type="submit" name="submit" id="submit" value="ENTRAR">
                    </form>
                </div>
            </div>
        </div>
    </body>