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
			
			<form class="form-login" method="post">
				
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
if (isset($_POST['login'])) 
{

	$email = addslashes($_POST['login']);
	$senha = addslashes($_POST['senha']);

	//verificar se está vazio.

	if (!empty($email) && !empty($senha)) {

		$user->conectar("projeto_login", "localhost", "root", "Adm1805?");

		if($user->msgErro == "") {
			if ($user->logar($email, $senha)) 
			{

				header("location:AreaPrivada.php");

			}else 
			{
				?>

					<div class="msg-erro">
						Email ou senha incorretos!
					</div>
				<?php
				
				
			}
		}else 
		{

			echo "Erro: " . $user->msgErro;
		}
	
	}else 
	{
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