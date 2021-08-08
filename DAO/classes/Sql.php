<?php

class Sql extends PDO {

	private $conn;

	//Definimos no construtor que ao instanciar a classe 'Sql' a conexão com o banco de dados é feita automaticamente.
	
	public function __construct() {

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "Adm1805?"); 


	}


	private function setParam($statement, $key, $value) {

		$statement->bindParam($key, $value);
	}


	private function setParams($statement, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statement, $key, $value);
		}
	}

	//Método que cria o comando a ser inserido no banco de dados.
	public function query($rowQuery, $params = array()) {

		$stmt = $this->conn->prepare($rowQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	//Método que chama o 'SELECT' no banco de dados onde em $rowQuery é informado o comando de fato 'SELECT * FROM...' e em $params são passados os parametros do 'WHERE', ex ':ID'.
	public function select($rowQuery, $params = array()):array {

		$stmt = $this->query($rowQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);


	}


}