<!DOCTYPE html>
<html>
<head>
	<title>Formulário de Login</title>
</head>
<body>
	<nav>
		<button><a href="cadastro.php">Voltar</a></button>
	</nav>
	<h2>Login de locador</h2>
	<form method="post" action="testaLogin.php">
		<label for="login">Login:</label>
		<input type="text" name="login" id="login">
		<br><br>
		<label for="senha">Senha:</label>
		<input type="password" name="senha" id="senha">
		<br><br>
		<label for="senha">CPF:</label>
		<input type="password" name="cpf" id="cpf">
		<br><br>
		<input type="submit" value="Entrar" name="submit">
	</form>
</body>
</html>