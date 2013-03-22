<?php
class Page {
	
	private $template;
	public $db;
	
	public function __construct()
	{
		session_start();
		$this->db = new mysqli('localhost', 'root', '', 'yolomcswaggster');		
	}
	
	public function loadTemplate($templ1,$templ2 = "")
	{
		$this->template = str_replace("%TEXT%", ($templ2 == "" ? "" : file_get_contents($templ2)), file_get_contents($templ1));
	}

	public function update()
	{
		$this->set("%DATE%",date("D, d M Y H:i:s"));
	}
	
	function set($key, $value)
	{
		$this->template = str_replace($key, $value, $this->template);
	}
	
	public function show ()
	{
		echo $this->template;
	}
}