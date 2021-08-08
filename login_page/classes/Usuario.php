<?php

class Usuario {

	private $pdo;
	public $msgErro = "";

	public function conectar($nome, $host, $usuario, $senha){
		global $pdo;

		try {
			$pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
		}
		catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
		
	}

	public function cadastrar($nome, $telefone, $email, $senha) {
		global $pdo;
		//verificar se email já é cadastrado.

		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");

		$sql->bindValue(":e", $email);

		$sql->execute();

		if($sql->rowCount() > 0) {

			return false; //já esta cadastrado.
		}else {

			$sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");

			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", md5($senha));

			$sql->execute();

			return true;
		}

	}

	public function logar($email, $senha) {
		global $pdo;

		//verificar se email e senha estão cadastrados

		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");

		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0) {
			//se estiver cadastrado.
			$dado = $sql->fetch();

			session_start();

			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true;//cadastrado com sucesso

		}else {

			return false;

		}
	}

}