<?php 

class database{
	private $servername = "localhost";
	private $username = "root";
	private $dbName = "chatapplication";
	private $password = "";

	public function connect(){
		try {
			$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbName;
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}

