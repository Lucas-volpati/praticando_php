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

	<section class="cadastro">

		<div class="content-form">
			
			<form class="form-login" method="post" novalidate>

				<h1>Painel de Controle - Cadastro</h1>

				<label class="tilt">Nome Completo</label>
				<input type="text" name="nome" id="campo" required="" maxlength="30">

				<label class="tilt pin">Telefone</label>
				<input type="text" name="telefone" id="campo" required="" maxlength="30">

				<label class="tilt pin">E-mail</label>
				<input type="email" name="email" id="campo" required="" maxlength="50">

				<label class="tilt pin">Senha</label>
				<input type="password" name="senha" id="campo" required="">

				<label class="tilt pin">Confirmar Senha</label>
				<input type="password" name="conf-senha" id="campo" required="">

				<input type="submit" name="entrar" value="Cadastrar" class="btn">
				<a href="index.php"><div class="btn-back"><strong>Voltar</strong></div></a>

			</form>

		</div>
		
	</section>

<?php

$dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$filteredEmail = htmlspecialchars($dataForm["email"]);

if ($dataForm) {
	if (in_array("", $dataForm)) { //Verificando preenchimento dos dados
		echo "<p class='msg-erro'>Erro: Preencher todos os campos!</p>";
	}else if(!filter_var($filteredEmail, FILTER_VALIDATE_EMAIL)) {//Validação do e-mail
		echo "<p class='msg-erro'>Erro: E-mail inválido!</p>";
	}else if($dataForm["senha"] !== $dataForm["conf-senha"]) {//Verificação da confirmação das senhas
		echo "<p class='msg-erro'>Erro: As senhas precisam ser iguais!</p>";
	}else {
		$user->conectar("projeto_login", "localhost", "myUser", "myPasswd");

		if ($u->cadastrar($nome, $telefone, $email, $senha)) {//realizar cadastro
			echo "<p class='msg-accept'>Cadastro realizado com sucesso!</p>";
		}else {
			echo "<p class='msg-erro'>Erro: Usuário já cadastrado!</p>";
		}
	}
}


?>

</body>
</html> 