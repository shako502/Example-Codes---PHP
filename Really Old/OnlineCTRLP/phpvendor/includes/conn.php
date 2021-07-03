<?php
class Database{
	
	private $host = 'localhost';
	private $dbname = '';
	private $username = '';
	private $password = '';
	public $conn;
	
	
	public function ConnectServer(){
		$this->conn = null;
		
		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password, array(
				PDO::ATTR_PERSISTENT => true
			));
			$this->conn->exec("set names utf8");
		}
		catch(PDOException $exception) {
			echo "კავშირის შეცდომა: " . $exception->getMessage();
		}
		return $this->conn;
	}
	
}

?>