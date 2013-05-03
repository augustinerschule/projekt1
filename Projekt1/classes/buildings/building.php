<?php 
include 'harvester.php';
include 'warehouse.php';

abstract class Building {
	
	public $startCost = array();
	public $level;
	public $upgradeTime;
	public $typ;
	public $stadt;
	public $lastUpdate = null;
	
	public function __construct (&$stadt, $typ, $level) {
		$this->level = $level;
		$this->typ = $typ;
		$this->stadt = $stadt;
		$this->upgradeTime = 10;
	}

	function canUpgrade() {
		return $this->stadt->hasResources($this->getResourcesForLevel($this->level+1));
	}

	abstract function update($timeElapsed);

	function getResourcesForLevel($level) {
		$res = array();
		$res["holz"] = 50 * $level;
		$res["gold"] = 50 * $level;
		$res["stein"] = 50 * $level;
		return $res;	
	}
	
	function upgrade($bauauf) {
		if ($bauauf["fertigum"] < time()) {
			$this->update($this->stadt, $bauauf["fertigum"]-$this->stadt->lastUpdate);
			$this->buildBuilding($this->stadt->db,$this->typ,$this->level+1,$this->stadt->stadtid);
			$this->stadt->getBuildingsFromDB();
			$this->stadt->buildings[$this->typ]->lastUpdate = $bauauf["fertigum"];
		}
	}
	
	
	public static function getBuilding(&$stadt, $typ, $stufe) {
		if ($typ >= 100) {
			return new Harvester($stadt, $typ, $stufe, Constants::$resources[$typ-100]);
		} 
		else {
			return new Constants::$buildings[$typ]($stadt, $typ, $stufe);
		}
	}
	
	public static function buildBuilding($db,$typ,$stufe,$stadtid) {
		if ($db->query("SELECT * FROM `gebaeude` WHERE `stadtid`='".$stadtid."' AND `typ`='".$typ."'")->num_rows == 0)
			$db->query("INSERT INTO `gebaeude` (`id` ,`stadtid` ,`typ` ,`stufe` ) VALUES (NULL , '".$stadtid."', '".$typ."', '1')");
		else
			$db->query("UPDATE `gebaeude` SET `stufe`='".$stufe."' WHERE `stadtid`='".$stadtid."' AND `typ`='".$typ."'");
		$db->query("DELETE FROM bauauftraege WHERE `stadtid`=".$stadtid);
	}
}
?>