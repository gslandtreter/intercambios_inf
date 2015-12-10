<?php

header('Content-Type: text/html; charset=utf-8');

$config = include("config.php");

session_start();

class DAO {

private $dbConnection;


	public function Connect() {

		global $config;

		if($this->dbConnection)
			$this->Close();

		$this->dbConnection = new mysqli($config["dbHost"], $config["dbUser"], $config["dbPass"], $config["dbBase"]);

		// Check connection
		if ($this->dbConnection->connect_error) {
		    die("mySQL Connection failed: " . $this->dbConnection->connect_error);
		}


		$this->dbConnection->query("SET NAMES 'utf8'");
		$this->dbConnection->query('SET character_set_connection=utf8');
		$this->dbConnection->query('SET character_set_client=utf8');
		$this->dbConnection->query('SET character_set_results=utf8');
	}

	public function Close() {

		if($this->dbConnection)
			$this->dbConnection->close();


		$this->dbConnection = null;
	}

	public function QuerySelect($query) {

		if(!$this->dbConnection)
			$this->Connect();

		$result = $this->dbConnection->query($query);
		return $result;

	}

	public function PrepareStatement($query) {
		return $this->dbConnection->prepare($query);
	}

	public function ExecuteStatement($stmt) {
		return $stmt->execute();
	}

}

class Authentication {


	public function IsLoggedIn() {
		return isset($_SESSION['id']);
	}

	public function SendToLoginPage() {

		header("Location: login.php");
		die();

		//$this->Login("gslandtreter");
	}

	public function SendToIndex() {

		header("Location: index.php");
		die();
	}

	public function Login($userName) {

		if($this->IsLoggedIn()) {
			return;
		}

		$token = md5(uniqid(rand(), true));

		$_SESSION['id'] = $token;
		$_SESSION['userName'] = $userName;

	}

	public function Logout() {

		if(!$this->IsLoggedIn())
			return;

		unset($_SESSION['id']);
	}

	public function GetUserName() {

		if(!$this->IsLoggedIn())
			return null;

		return $_SESSION['userName'];
	}

	public function GetUserPermissions($userName) {

		if($userName == null)
			return null;

		$DAO = new DAO();
		$DAO->Connect();

	    $stmt = $DAO->PrepareStatement("select permissions from users where username = ?");
	    $stmt->bind_param("s", $userName);

	    $DAO->ExecuteStatement($stmt);

	    $stmt->bind_result($permissions);
	    $stmt->fetch();

	    return $permissions;
	}

}

?>