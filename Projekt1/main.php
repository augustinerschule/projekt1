<?php
require_once 'page.php';
class Main extends Page {

	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['userid'])){
			$this->loadTemplate("au�enlogin.php","innen.php");
		}
		else {
			$this->loadTemplate("au�ennedlogin.php");
		}
	}
	public function update() {
		parent::update();
		if(isset($_SESSION['userid'])) {
			//normale seite blabla
		}
		else {
			if(isset($_POST["username"])&& isset($_POST["password"])){
				$sql = "SELECT * FROM user WHERE username = {$_POST['username']} AND password = {$_POST['password']}";
				$result = $this->db->query($sql);
				if(mysql_num_rows($result) == 1){
					$result =  mysql_fetch_array($result);
					$_SESSION["userid"] = $result["id"];
					header("location:index.php");
				}
			}
		}
	}	
}