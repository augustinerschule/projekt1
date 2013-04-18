<?php
require_once 'page.php';
include './staedte/constants.php';
include './staedte/stadt.php';
include './buildings/building.php';
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
				$sql = "SELECT * FROM users WHERE username = '".$_POST['user']."' AND passwort = '".$_POST['pwd']."'";
				$result = $this->db->query($sql)->fetch_assoc();
				$_SESSION["userid"] = $result["id"];
				header("location:index.php");
			} 
		} else {
			
			parent::update();
			
			if (isset($_POST['build'])){
				Building::buildBuilding($this->db,$this->stadtid,$_POST['typ'],$_POST['level']);
				$this->stadt->getBuildingsFromDB();
			}
			//Gebaeude geht noch net
			$str = "";
			foreach ($this->stadt->buildings as $building)
			{
				$str .= "<tr><td>".($building->typ < 100 ? Constants::$buildings[$building->typ] : Constants::$resources[$building->typ-100]."-Harvester").
							" (Stufe ".$building->level.")</td><td>asdasd</td><td><div class='upgrade'><form method='post'><input type='hidden' name='typ' value='".$building->typ."'>
							<input type='hidden' name='level' value='".($building->level+1)."'><button type='submit' name='build'>Upgrade</button></form></div></td></tr>";
			}
			$this->set("%TEXT%", $str);
		}
	}	
}