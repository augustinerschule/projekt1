<?php

class Stadt {
	public $buildings = array();
	public $research = array();
	public $resources = array();
	public $currentlyBuilding = array();
	public $owner;
	public $stadtid;
	public $lastUpdate;
	
	public $db;
	
	public function __construct ($stadtid,$d)
	{
		$this->db = $d;
		$this->stadtid = $stadtid;
		$this->getResourcesFromDB();
		$this->getBuildingsFromDB();
		$this->getResearchFromDB();
	}
	
	public function update() {
		$timeElapsed = time()-$this->lastUpdate;
		//bauauftraege
		$bauauf = $this->db->query("SELECT * FROM bauauftraege WHERE stadtid = '".$this->stadtid."'");
		$row = $bauauf->fetch_assoc();
		if($bauauf->num_rows != 0)
			$this->buildings[$row["typ"]]->upgrade($row); 
		foreach($this->buildings as $building)
			$building->update($timeElapsed);
			
		//forschauftraege
		
		
		
		$this->writeToDB();
	}
	
	public function hasResources($res) {
		foreach(Constants::$resources as $r)
			//if(array_key_exists($res,$r))
				if(@$this->resources[$r] < $res[$r])
					return false;
		return true;
	}
	
	public function getResourcesFromDB() {
		$res = $this->db->query("SELECT * FROM staedte WHERE id = '".$this->stadtid."'")->fetch_assoc();
		foreach(Constants::$resources as $r)
			$this->resources[$r] = $res[$r];
		$this->lastUpdate = $res["lastupdate"];
	}
	
	public function getResearchFromDB() {
		$this->research = array();
		for($i = 0;$i < count(Constants::$research);$i++)		
			$this->research[$i] = Research::getResearch($i);
		$res = $this->db->query("SELECT * FROM `forschung` WHERE `userid` = ".$_SESSION['userid']."");		
		while($row = $res->fetch_assoc())
			$this->research[$row["typ"]]->level = $row["stufe"];
	}	
	
	public function getBuildingsFromDB()
	{
		$this->buildings = array();
		for($i = 0;$i < count(Constants::$buildings);$i++)		
			$this->buildings[$i] = Building::getBuilding($this,$i,0);
			
		for($i = 0;$i < count(Constants::$resources);$i++)		
			$this->buildings[100+$i] = Building::getBuilding($this,100+$i,0);
		
		$res = $this->db->query("SELECT * FROM `gebaeude` WHERE `stadtid` = '".$this->stadtid."'");		
		while($row = $res->fetch_assoc())		
			$this->buildings[$row["typ"]] = Building::getBuilding($this,$row["typ"],$row["stufe"]);
			
	}
	
	public function startBuilding($typ) {
		echo $this->buildings[$typ]->upgradeTime;
		$this->db->query("INSERT INTO `bauauftraege` (`stadtid` ,`typ` ,`fertigum` ) VALUES ('".$this->stadtid."', '".$typ."', '".(time()+$this->buildings[$typ]->upgradeTime)."')");
	}
	
	public function startResearch($typ) {
		echo $this->research[$typ]->upgradeTime;
		$this->db->query("INSERT INTO `forschauftraege` (`stadtid` ,`typ` ,`fertigum` ) VALUES ('".$this->stadtid."', '".$typ."', '".(time()+$this->research[$typ]->upgradeTime)."')");
	}
	
	public function writeToDB()
	{	
		$sql = "UPDATE `staedte` SET ";
		foreach(Constants::$resources as $r)
			$sql.= "`$r` = '".$this->resources[$r]."',";
		$sql.= "`lastupdate` = '".time()."'";
		$this->db->query($sql." WHERE `id` = '".$this->stadtid."'");
	}
}