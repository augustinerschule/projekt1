<?php
require_once 'page.php';
class Main extends Page {

	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['userid'])){
			$this->loadTemplate("außen.html","startseite.html");
		}
		else {
			$this->loadTemplate("login.html");
		}
	}
	public function update() {
		parent::update();
		if(!isset($_SESSION['userid'])) {
			if(isset($_POST["user"]) && isset($_POST["pwd"])){
				$sql = "SELECT * FROM users WHERE username = '".$_POST['user']."' AND password = '".$_POST['pwd']."'";
				$result = $this->db->query($sql)->fetch_assoc();
				$_SESSION["userid"] = $result["ID"];
				header("location:index.php");
			} 
		}
	}	
}