<?php 

class DBClass{
	
	private $host = "localhost";
	private $username = "root";
	private $password = "123";
	private $database = "logo";

	public $connection;

	public function getConnection(){

		$this->connection = null;

		try{

			$this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);

			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("SET NAMES utf8");

		}catch(PDOException $exception){
			echo "Error: " . $exception.getMessage();
		}

		return $this->connection;
	}
}

?>