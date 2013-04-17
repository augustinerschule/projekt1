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
		parent::update();
		if(!isset($_SESSION['userid'])) {
			if(isset($_POST["user"]) && isset($_POST["pwd"])){
				$sql = "SELECT * FROM users WHERE username = '".$_POST['user']."' AND passwort = '".$_POST['pwd']."'";
				$result = $this->db->query($sql)->fetch_assoc();
				$_SESSION["userid"] = $result["id"];
				header("location:index.php");
			} 
		}
		if (!isset($_GET["stadt"]))
			$stadtindex = 0;
		else
			$stadtindex = $_GET["stadt"];
		
		$sql = "SELECT * FROM staedte WHERE userid = '".$_SESSION['userid']."'";
		$result = $this->db->query($sql);
		$stadt = array();
		while ($row = $result->fetch_assoc()["id"])
			array_push($stadt,new Stadt($row, $this->db));
			
		if (isset($_POST['build']))
			Building::getBuilding($_POST['typ'],$_POST['level'],$this->db->query("SELECT * FROM staedte WHERE name='".$stadt[$stadtindex]->name."'")->fetch_assoc()["id"]);
			
		$stadt[$stadtindex]->update();
		
		//Resourcen
		$str = "";
		
		foreach (Constants::$resources as $res)
			$str .= ucfirst("$res: ").$stadt[$stadtindex]->resources[$res]."&nbsp";
			
		$this->set("%RESOURCES%", $str);
		
		//Staedte
		$str = "<div id='l_staedte'><ul>";
		for ($i = 0; $i < count($stadt);$i++)
		{
			$str .= ($i == $stadtindex ? "<li><b>".$stadt[$i]->name."</b></li>" : "<li><a href='index.php?stadt=$i'>".$stadt[$i]->name."</a></li>");
		}
		$this->set("%TEXT%", $str."</ul></div>%TEXT%");
		
		//Gebaeude geht noch net
		$str = "<div id='l_gebaeude'><table><tr><th>Gebäude</th><th>Beschreibung</th><th>Optionen</th></tr>";
		foreach ($stadt[$stadtindex]->buildings as $building)
		{
			$str .= "<tr><td>".($building->typ < 100 ? Constants::$buildings[$building->typ] : Constants::$resources[$building->typ-100]."-Harvester").
						" (Stufe ".$building->level.")</td><td>asdasd</td><td><form method='post' name='build'><input type='hidden' name='typ' value='".$building->typ."'>
						<input type='hidden' name='level' value='".($building->level+1)."'><button type='submit'>Upgrade</button></form></td></tr>";
		}
		$this->set("%TEXT%", $str."</table></div>%TEXT%");
	}	
}