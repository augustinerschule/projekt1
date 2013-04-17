<?php
require_once 'page.php';
class Register extends Page {

	public function __construct()
	{
		parent::__construct();
		$this->loadTemplate("./templates/register.html");
	}
	public function update() {
		parent::update();
		if(isset($_POST["user"]) && isset($_POST["pwd"])) {
			$sql = "SELECT * FROM users WHERE username = '".$_POST['user']."'";
			if ($this->db->query($sql)->num_rows == 0) {
				$sql = "INSERT INTO `users` (`id` ,`username` ,`passwort`) VALUES (NULL , '".$_POST['user']."', '".$_POST['pwd']."')";
				$this->db->query($sql);
				$sql = "INSERT INTO `staedte` (`id` ,`userid`, `name`,`holz`,`gold`,`nahrung`,`stein`,`einwohner`,`lastupdate`) 
										VALUES (NULL , '".$this->db->query("SELECT * FROM `users` WHERE username = '".$_POST['user']."'")->fetch_assoc()["id"]."',
												'yolo', 100, 100, 100, 100, 100, ".time()." ')";
				$this->db->query($sql);
				header("location:index.php");
			} else {
				$this->set("%ERROR%", "Benutzername existiert bereits");
			}
		}
		$this->set("%ERROR%", "");
	}	
}