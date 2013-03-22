<?php
require_once 'page.php';
class Main extends Page {

	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['userid'])){
			$this->loadTemplate("außenlogin.php","innen.php");
		}
		else {
			$this->loadTemplate("login.html");
		}
		$this->update();
		$this->show();
	}
	public function update() {
		parent::update();
		if(isset($_SESSION['userid'])) {
			//normale seite blabla
		}
		else {
			$_POST["asd"] = "asd";
			print_r($_POST);
			if(isset($_POST["user"]) && isset($_POST["pwd"])){
				echo "asd";
				$sql = "SELECT * FROM users WHERE username = {$_POST['user']} AND password = {$_POST['pwd']}";
				$result = $this->db->query($sql);
				//mysql_fetch_object($result);
					$_SESSION["userid"] = $result["id"];
					header("location:index.php");
				
			}
		}
	}	
}