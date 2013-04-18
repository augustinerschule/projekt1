<?php
class Page {
	
	private $template;
	public $db;
	
	public $staedte = array();
	public $stadtid, $stadt;
	
	public function __construct()
	{
		$this->db = new mysqli('localhost', 'root', '', 'yolomcswaggster');		
	}
	
	public function loadTemplate($templ1,$templ2 = "")
	{
		$this->template = str_replace("%TEXT%", ($templ2 == "" ? "" : file_get_contents($templ2)), file_get_contents($templ1));
	}

	public function update()
	{
		$this->set("%DATE%",date("D, d M Y H:i:s"));
		
		$sql = "SELECT id,name FROM staedte WHERE userid = '".$_SESSION['userid']."'";
		$result = $this->db->query($sql);
		while ($row = $result->fetch_assoc())
			array_push($this->staedte,array($row['id'],$row['name']));
			
		if (!isset($_GET["stadt"]))
			$this->stadtid = $this->staedte[0][0];
		else
			$this->stadtid = $this->staedte[$_GET["stadt"]][0];
		
		$this->stadt= new Stadt($this->stadtid, $this->db);
		
		$this->stadt->update();
		
		//Resourcen
		$str = "";
		
		foreach (Constants::$resources as $res)
			$str .= ucfirst("$res: ").$this->stadt->resources[$res]." ";
			
		$this->set("%RESOURCES%", $str);
	
		//Staedte
		$str = "";
		for ($i = 0; $i < count($this->staedte);$i++)
		{
			$str .= ($this->staedte[$i][0] == $this->stadtid ? "<li><b>".$this->staedte[$i][1]."</b></li>" : "<li><a href='index.php?stadt=$i'>".$this->staedte[$i][1]."</a></li>");
		}
		$this->set("%STAEDTE%", $str);
		
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