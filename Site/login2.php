<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Formulário de login</title>
</head>
<body>
	<nav>
		<button><a href="cadastro.php">Voltar</a></button>
		<button><a href="principal.php">Home</a></button>
	</nav>
    <div class="box">
        <form method="post" action="testaLogin2.php">
            <fieldset>
                <legend><b>Login de Locatário</b></legend>
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
                <div>
                    <label for="">Escolha: </label>
                    <select name="escolha" required>
                        <option value="3">Locatário</option>
                        <option value="1">administrador</option>
                    </select>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Entrar">
            </fieldset>
        </form>
    </div>
</body>
</html>