<?php 
require_once 'classes/Usuario.php';

$u = new Usuario();

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
			
			<form class="form-login" method="post">
				
				

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
//verificar se clicou no botao
if (isset($_POST['nome'])) {

	$nome = addslashes($_POST['nome']);
	$telefone = addslashes($_POST['telefone']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);
	$confirmacao = addslashes($_POST['conf-senha']);

	//verificar se está vazio.

	if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmacao)) {

		$u->conectar("projeto_login", "localhost", "root", "Adm1805?");

		if($senha == $confirmacao) {

			if ($u->cadastrar($nome, $telefone, $email, $senha)) {
				?>

				<div id="msg-sucesso">
					Cadastrado com sucesso!
				</div>
				<?php
			}else {

				?>

				<div class="msg-erro">
					Email já cadastrado!
				</div>
				<?php
				
			}

		}else {

				?>

				<div class="msg-erro">
					As senhas não conferem!
				</div>
				<?php

		}

		
	}else {

		?>

		<div class="msg-erro">
			Preencha todos os campos!
		</div>
		<?php
	}
}

?>

</body>






</html> 