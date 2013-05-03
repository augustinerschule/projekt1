<?php
require_once 'building.php';
class School extends Building {
	public $capacity;
	
	public function __construct (&$stadt, $typ, $level)
	{
		parent::__construct($stadt, $typ, $level);
		$this->capacity = 10 + $level * 5;
	}
	
	function update($timeElapsed) {	
	}
}
?>