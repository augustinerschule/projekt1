<?php
require_once 'building.php';
class Residence extends Building {
	public $capacity;
	
	public function __construct (&$stadt, $typ, $level)
	{
		parent::__construct($stadt, $typ, $level);
		$this->capacity = 100 + $level * 25;
	}
	
	function update($timeElapsed) {	
	}
}
?>