<?php
class Page {
	
	private $template;
	private $db;
	
	public function __construct()
	{
		session_start();
		$this->db = new mysqli('server', 'DB-User', 'DB-Passwort', 'DB-Name');		
	}
	
	public function loadTemplate($templ1,$templ2 = "")
	{
		$this->template = str_replace("%TEXT%", file_get_contents($templ2), file_get_contents($templ1));
	}

	public function update()
	{
		set("%DATE%",date("D, d M Y H:i:s"));
	}
	
	function set($key, $value)
	{
		$this->template = str_replace($key, $value, $this->template);
	}
	
	public function show ()
	{
		echo $template;
	}
}