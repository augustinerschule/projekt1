<?php 
abstract class Building {
	
	public $startCost = array();
	public $level;
	public $typ;
	
	public function __construct ($level,$typ) {
		$this->level = $level;
		$this->typ = $typ;
	}

	function isUpgradeable() {
		return true;
	}

	abstract function update(&$stadt ,$timeElapsed);

	function getResourcesForLevel($level) {
		$res = array();
		//$res["asd"] = //TODO Irgendwie mehr werden
		//return 	5*$level;	
	}
	
	
	public static function getBuilding($typ,$stufe,$stadtid) {
		if ($typ >= 100) {
			require_once 'harvester.php';
			return new Harvester(Constants::$resources[$typ-100], $stufe, $stadtid, $typ);
		} 
		else {
			//return new Constants::$buildings[$typ]($stufe, $stadtid, $typ);
		}
	}
	
	public static function buildBuilding($db,$stadtid,$typ,$stufe) {
		if ($db->query("SELECT * FROM `gebaeude` WHERE `stadtid`='".$stadtid."' AND `typ`='".$typ."'")->num_rows == 0)
			$db->query("INSERT INTO `gebaeude` (`id` ,`stadtid` ,`typ` ,`stufe` ) VALUES (NULL , '".$stadtid."', '".$typ."', '1')");
		else
			$db->query("UPDATE `gebaeude` SET `stufe`='".$stufe."' WHERE `stadtid`='".$stadtid."' AND `typ`='".$typ."'");
	}
}
?>