<?php
require_once 'building.php';
class Harvester extends Building {
	
	public $harvestedResource;
	public $harvestRate;

	function __construct($res, $level,$stadtid, $typ) {
		parent::__construct($level,$typ);
		$this->harvestedResource = $res;
		$this->harvestRate = $level*$level;
	}
	
	function update(&$stadt, $timeElapsed) {
		$stadt->resources[$this->harvestedResource] += $timeElapsed*$this->harvestRate;
	}
}
?>