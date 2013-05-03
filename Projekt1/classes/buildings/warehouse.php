<?php
require_once 'building.php';
class Warehouse extends Building {
	public $capacity;
	
	public function __construct (&$stadt, $typ, $level)
	{
		parent::__construct($stadt, $typ, $level);
		$this->capacity = 50000+ $level * 50000;
	}
	
	function update($timeElapsed) {	
	}
}
?>