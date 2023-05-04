<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Formulário de Login</title>
</head>
<body>
	<nav>
		<button><a href="cadastro.php">Voltar</a></button>
		<button><a href="principal.php">Home</a></button>
	</nav>
	<h2>Login de locatário</h2>
	<form method="post" action="testaLogin2.php">
		<label for="login">Login:</label>
		<input type="text" name="login" id="login">
		<br><br>
		<label for="senha">Senha:</label>
		<input type="password" name="senha" id="senha">
		<br><br>
		<label for="senha">CPF:</label>
		<input type="password" name="cpf" id="cpf">
		<br><br>
		<label for="escolha">Escolha: </label>
        <select name="escolha" required>
            <option value="3">Locatário</option>
			<option value="1">Administrador</option>
        </select>
		<br><br>
		<input type="submit" value="Entrar" name="submit">
		<br><br>
	</form>
</body>
</html>