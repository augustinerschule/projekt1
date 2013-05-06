<?php
require_once 'page.php';

class Main extends Page {

	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['userid'])){
			$this->loadTemplate("./templates/aussen.html","./templates/startseite.html");
		}
		else {
			$this->loadTemplate("./templates/login.html");
		}
	}
	
	public function update() {
		if(!isset($_SESSION['userid'])) {
			if(isset($_POST["user"]) && isset($_POST["pwd"])){
				$_POST['user']= $this->db->real_escape_string($_POST['user']);
				$_POST['pwd']= $this->db->real_escape_string($_POST['pwd']);
				$sql = "SELECT * FROM users WHERE username = '".$_POST['user']."' AND passwort = '".$_POST['pwd']."'";
				$result = $this->db->query($sql)->fetch_assoc();
				$_SESSION["userid"] = $result["id"];
				header("location:index.php");
			} 
		} else {
			parent::update();
			
			if (isset($_POST['build'])&& $this->stadt->buildings[$_POST['typ']]->canUpgrade()){
				$this->stadt->startBuilding($_POST['typ']);
			}
			$str = "";
			foreach ($this->stadt->buildings as $building)
			{
				$str .= "<tr><td><a href='index.php?page=view".($building->typ < 100 ? Constants::$buildings[$building->typ]."'>".Constants::$buildings[$building->typ]."</a>" : 
							"harvester&typ=".$building->typ."'>".Constants::$resources[$building->typ-100]."harvester</a>").
							" (Stufe ".$building->level.")</td><td>asdasd</td><td><div class='upgrade'><form method='post'><input type='hidden' name='typ' value='".$building->typ."'>
							<button type='submit' name='build'>Upgrade</button></form></div></td></tr>";
			}
			$this->set("%TEXT%", $str);
		}
	}	
}