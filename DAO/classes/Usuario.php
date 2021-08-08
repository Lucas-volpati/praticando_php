<?php

//Classe contem os campos de teste do banco de dados 'dbphp7' MySQL.

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario() {
		return $this->idusuario;
	}

	//Métodos getters e setters de cada elemento do banco de dados.
	public function setIdUsuario($idUsuario) {
		$this->idusuario = $idUsuario;
	}

	public function getLogin() {
		return $this->deslogin;
	}

	public function setLogin($login) {
		$this->deslogin = $login;
	}

	public function getSenha() {
		return $this->dessenha;
	}

	public function setSenha($senha) {
		$this->dessenha = $senha;
	}

	public function getDtCadastro() {
		return $this->dtcadastro;
	}

	public function setDtCadastro($dataCad) {
		$this->dtcadastro = $dataCad;
	}


	//Método que automatiza o carregamento das informações pelo ID do usuário.
	public function loadById($id) {

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

		if (isset($result)) {

			$row = $result[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setLogin($row['deslogin']);
			$this->setSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}
	//Cria um Json das informações buscadas no banco de dados.
	public function __toString(){

		return json_encode(array(

			"idusuario"=>$this->getIdUsuario(),
			"deslogin"=>$this->getLogin(),
			"dessenha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y")

		));
	}

}