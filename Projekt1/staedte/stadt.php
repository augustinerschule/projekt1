<?php

class Stadt {
	public $buildings = array();
	public $resources = array();
	public $currentlyBuilding = array();
	public $owner;
	public $name;
	public $stadtid;
	public $lastUpdate;
	
	private $db;
	
	public function __construct ($stadtid,$d)
	{
		$this->db = $d;
		$this->stadtid = $stadtid;
		$this->name = $this->db->query("SELECT * FROM staedte WHERE id = '".$this->stadtid."'")->fetch_assoc()["name"];
		$this->getResourcesFromDB();
		$this->getBuildingsFromDB();
	}
	
	public function update() {
		$timeElapsed = time()-$this->lastUpdate;
		foreach($this->buildings as $building)		
			$building->update($this,$timeElapsed);
		$this->writeToDB();
	}
	
	public function getResourcesFromDB()
	{
		$res = $this->db->query("SELECT * FROM staedte WHERE id = '".$this->stadtid."'")->fetch_assoc();
		foreach(Constants::$resources as $r)
			$this->resources[$r] = $res[$r];
		$this->lastUpdate = $res["lastupdate"];
	}
	
	public function getBuildingsFromDB()
	{
		for($i = 0;$i < count(Constants::$buildings);$i++)		
			$this->buildings[$i] = Building::getBuilding($i,0,$this->stadtid);
			
		for($i = 0;$i < count(Constants::$resources);$i++)		
			$this->buildings[100+$i] = Building::getBuilding(100+$i,0,$this->stadtid);
		
		$res = $this->db->query("SELECT * FROM gebaeude WHERE id = '".$this->stadtid."'");		
		while($row = $res->fetch_assoc())		
			$this->buildings[$row["typ"]] = Building::getBuilding($row["typ"],$row["stufe"],$this->stadtid);
			
	}
	/*
	public function getBuildProgresses () {
		$res = $this->db->query("SELECT * FROM ambauen WHERE stadtid = '".$this->stadtid."'");
		while($row = $res->fetch_assoc()) {
			array_push($this->currentlyBuilding
		}		
	}*/
	
	public function writeToDB()
	{	
		$sql = "UPDATE `staedte` SET ";
		foreach(Constants::$resources as $r)
			$sql.= "`$r` = '".$this->resources[$r]."',";
		$sql.= "`lastupdate` = '".time()."'";
		$this->db->query($sql." WHERE `id` = '".$this->stadtid."'");
	}
}