<?php
require_once 'page.php';

class School extends Page {

	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['userid'])){
			$this->loadTemplate("./templates/aussen.html","./templates/schule.html");
		}
		else {
			$this->loadTemplate("./templates/login.html");
		}
	}
	
	public function update() {
		parent::update();
		
		if (isset($_POST['research']) && $stadt->research[$_POST['typ']]->canUpgrade()){
			$this->stadt->startBuilding($_POST['typ']);
		}
		$str = "";
		for($i = 0;$i < count(Constants::$research);$i++) {		
			
			$str .= "<tr><td>".Constants::$research[$i].
						" (Stufe ".$this->stadt->research[$i]->level.")</td><td>asdasd</td><td><div class='upgrade'><form method='post' action='index.php?page=school'>
						<input type='hidden' name='typ' value=$i><button type='submit' name='research'>Upgrade</button></form></div></td></tr>";
		}
		$this->set("%TEXT%", $str);
	}	
}