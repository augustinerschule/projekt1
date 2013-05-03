<?php
require_once 'building.php';
class Harvester extends Building {
	public $harvestedResource;
	public $harvestRate;

	function __construct(&$stadt, $typ, $level, $res) {
		parent::__construct($stadt, $typ, $level);
		$this->harvestedResource = $res;
		$this->harvestRate = $level*$level;
		$this->upgradeTime = $level*5+5;
	}
	
	function update($timeElapsed) {
		if ($this->lastUpdate != null) {
			$this->stadt->resources[$this->harvestedResource] += (time()-$this->lastUpdate)*$this->harvestRate;
			echo "asdasd";
		} else {
			$this->stadt->resources[$this->harvestedResource] += $timeElapsed*$this->harvestRate;
		}
		if($this->stadt->resources[$this->harvestedResource] > $this->stadt->buildings[Constants::$ID_WAREHOUSE]->capacity) 
			$this->stadt->resources[$this->harvestedResource] = $this->stadt->buildings[Constants::$ID_WAREHOUSE]->capacity;
	}
}
?>