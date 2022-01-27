<?php 

require_once 'classes/Usuario.php';

$user = new Usuario();

?>
<html lang="pt-br">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="css/stilo.css">
	<link href="fontawesome/css/all.css" rel="stylesheet"> 

	<title>Tela de login</title>



</head>

<body>

	<section class="login">

		<div class="content-form">
			
			<form class="form-login" method="post" novalidate>
				
				<div class="img-login">
					
					<img src="img/user.png">

				</div>

				<h1>Painel de Controle</h1>

				<label class="tilt">Login</label>
				<input type="email" name="login" id="campo" required="">

				<label class="tilt pin">Senha</label>
				<input type="password" name="senha" id="campo" required="">


				<input type="submit" name="entrar" value="Entrar" class="btn">

				<div class="link">
					<p>Ainda não é inscrito? <a href="cadastro.php">Cadastre-se!</a></p>
				</div>


			</form>

		</div>
		
	</section>
<?php

	$formData = filter_input(INPUT_POST, FILTER_DEFAULT);

	$filteredEmail = htmlspecialchars($formData["email"], ENT_QUOTES, 'UTF-8');
	$filteredPasswd = htmlspecialchars($formData["senha"], ENT_QUOTES, 'UTF-8');

	// Validações dos dados recebidos!

	if ($formData) {
		if (in_array("", $formData)) {
			echo "<p class='msg-erro'>Erro: Preencher todos os campos!</p>";
		}else if(!filter_var($filteredEmail, FILTER_VALIDATE_EMAIL)) {
			echo "<p class='msg-erro'>Erro: E-mail inválido!</p>";
		}else {
			$user->conectar("projeto_login", "localhost", "myUser", "myPasswd");

			if ($user->logar($filteredEmail, $filteredPasswd)) {
				header("location:AreaPrivada.php");
			}else {
				echo "<p class='msg-erro'>Erro: E-mail ou senha incorretos, favor verificar!</p>";
			}
		}
	}

?>
</body>






</html> 