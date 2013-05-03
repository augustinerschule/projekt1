<?php
require_once 'page.php';
class Viewharvester extends Page{

	public $typ;

	public function __construct($template)
	{
		parent::__construct();
		$this->typ = $_GET['typ'];
		$this->loadTemplate("./templates/aussen.html", "./templates/harvester.html");
	}
	
	public function update()
	{
		parent::update();
		
		$str = "<h2>".(ucfirst(Constants::$resources[$this->typ - 100]))."harvester Stufe ".$this->stadt->buildings[$this->typ]->level."</h2>Upgradekosten:<table><tr>";
		
		foreach(Constants::$resources as $res);
			$str .= "<th>$res</th>";
		
		$resources = $this->stadt->buildings[$this->typ]->getResourcesForLevel($this->stadt->buildings[$this->typ]->level+1);
		
		$str .="</tr><tr>";
		foreach($resources as $res);
			$str .= "<td>$res</td>";
			
		$this->set("%TEXT%",$str."</tr></table>");
	}
	
}
?>