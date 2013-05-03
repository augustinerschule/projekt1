<?php 

class Research {
	public $startCost = array();
	public $level;
	public $upgradeTime;
	public $typ;
	
	public function __construct ($typ) {
		$this->level = 0;
		$this->typ = $typ;
		$this->upgradeTime = 10;
	}
	
	function canUpgrade() {
		return true;
	}
	
	public static function getResearch($typ) {
		return new Research($typ);
	}
	
	public static function buildResearch($db,$typ,$stufe,$stadtid) {
		if ($db->query("SELECT * FROM `gebaeude` WHERE `stadtid`='".$stadtid."' AND `typ`='".$typ."'")->num_rows == 0)
			$db->query("INSERT INTO `gebaeude` (`id` ,`stadtid` ,`typ` ,`stufe` ) VALUES (NULL , '".$stadtid."', '".$typ."', '1')");
		else
			$db->query("UPDATE `gebaeude` SET `stufe`='".$stufe."' WHERE `stadtid`='".$stadtid."' AND `typ`='".$typ."'");
		$db->query("DELETE FROM bauauftraege WHERE `stadtid`=".$stadtid);
	}
}
?>