<?php

	session_start();

	if(!isset($_SESSION['id_usuario'])) {

		header("location: index.php");
		exit;
	}

?>

SEJA BEM VINDOOOO !

<a href="sair.php">Sair</a>